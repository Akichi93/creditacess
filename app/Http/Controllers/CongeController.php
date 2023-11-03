<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\User;
use App\Models\Conge;
use App\Models\Respo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CongeController extends Controller
{
    public function congeList()
    {
        $conges = Conge::where('user_id', Auth::user()->id)->get();
        return view('conges.listconges')->with(compact('conges'));
    }

    public function congeAdd(Request $request)
    {
        //validation
        $rules = [
            'type' => 'required',
            'date_debut' => 'date_format:Y-m-d',
            'date_fin' => 'date_format:Y-m-d|after_or_equal:date_debut',
            'motif' => 'required',
        ];

        $customMessages = [
            'type.required' => 'Veuillez selectionner le type d\'absence',
            'date_debut.date_format' => 'Veuillez selectionnez la date debut',
            'date_fin.date_format' => 'Veuillez selectionnez la date debut',
            'date_fin.after_or_equal' => 'La date de fin doit être supérieur ou égal à celle de debut',
            'motif.required' => 'Veuillez entrez le motif',
        ];

        $this->validate($request, $rules, $customMessages);
        try {
            // Nombre de jour
            $ddate = $request->date_debut;
            $fdate = $request->date_fin;

            $debut_jour = intval(date('d', strtotime($ddate)));
            $debut_mois = intval(date('m', strtotime($ddate)));
            $debut_annee = intval(date('Y', strtotime($ddate)));

            $fin_jour = intval(date('d', strtotime($fdate)));
            $fin_mois = intval(date('m', strtotime($fdate)));
            $fin_annee = intval(date('Y', strtotime($fdate)));

            $debut_date = mktime(0, 0, 0, $debut_mois, $debut_jour, $debut_annee);
            $fin_date = mktime(0, 0, 0, $fin_mois, $fin_jour, $fin_annee);
            $ind = 0;
            $j = 0;

            for ($i = $debut_date; $i <= $fin_date; $i += 86400) {

                $ind += 1;
                $jour = date("l", $i);
                $day = date("d-m", $i);
                if ($jour == 'Saturday' || $jour == 'Sunday' || $day == "01-01" || $day == "01-05" || $day == "07-08" || $day == "15-08" || $day == "01-11" || $day == "15-11" || $day == "25-12") {
                    $j += 1;
                }
            }



            $jourouvre = $ind - $j;

            $datetime1 = new DateTime($ddate);
            $datetime2 = new DateTime($fdate);
            $interval = $datetime1->diff($datetime2);
            $days = $interval->format('%a');
            $newDateAjout = date("Y-m-d", strtotime($fdate . " + 1 day"));

            //Recuperer l'id du reponsable
            $respoId = Respo::select('id')->where('service_id', Auth::user()->service_id)->value('id');

            //Verifier si la personne qui fait la demande est un reponsable
            $userId = Respo::where('user_id', Auth::user()->id)->value('id');

            if ($userId == null) {
                $etat = 0;
            } else {
                $etat = 1;
            }

            // Verification

            if($jourouvre > 30){
                return back()->with('danger', 'Vous ne pouvez pas demander plus de 30 jours');
            }



            // Insertion dans la bdd
            $user = Auth::user();

            $conge = new Conge();
            $conge->type_conge = $request->type;
            $conge->date_debut = $request->date_debut;
            $conge->date_fin = $request->date_fin;
            $conge->motif = $request->motif;
            $conge->respo_id = $respoId;
            $conge->user_id = $user->id;
            $conge->duree = $jourouvre;
            $conge->etat = $etat;
            $conge->date_retour = $newDateAjout;
            $conge->save();

            $now = date('Y-m-d');

            // dd($userId);
            if ($userId != null) {
                // Envoie d'email a la responsable RH
                $email = User::select('email')->join("services", 'services.id', '=', 'users.service_id')->where('rh', 'OUI')->value('email');
                if ($email == null) {
                    return back()->with('danger', 'Veuillez contacter l\'administration');
                }

                $b = User::select('*')
                    ->where('id', $user->id)
                    ->get();
                $array = json_decode(json_encode($b), true);
                $ar = $array[0];
                $civilite_respo = $ar['civilite'];
                $nom_respo = $ar['name'];
                $prenom_respo = $ar['prenom'];

                // envoi de mail à la RH
                if ($request->isMethod('post')) {
                    $data = $request->all();
                    $data = array(
                        "body" => "Notification de demande de congé",
                        'email' => $email,
                        'date_debut' => $data['date_debut'],
                        'date_fin' => $data['date_fin'],
                        'type' => $data['type'],
                        'civilite' => $civilite_respo,
                        'name' => $nom_respo,
                        'prenom' => $prenom_respo,
                    );

                    Mail::send('emails.congesrespo', $data, function ($message) use ($email) {
                        $message->to($email)
                            ->subject('CONGE');
                        $message->from('associecourtage@gmail.com', 'ACCESS CREDIT');
                    });
                }
            } else {
                $email_rh = User::select('email')->join("services", 'services.id', '=', 'users.service_id')->where('rh', 'OUI')->value('email');

                if ($email_rh == null) {
                    $email_respo = User::select('email')->join("respos", 'respos.user_id', '=', 'users.id')->where('respos.user_id', $respoId)->value('email');
                    // envoi de mail au responsable
                    if ($request->isMethod('post')) {
                        $data = $request->all();
                        $data = array(
                            "body" => "Notification de demande de congé",
                            'email' => $email_respo,
                            'date_debut' => $data['date_debut'],
                            'date_fin' => $data['date_fin'],
                            'type' => $data['type'],
                            'civilite' => Auth::user()->civilite,
                            'name' => Auth::user()->name,
                            'prenom' => Auth::user()->prenom,
                        );

                        Mail::send('emails.congescollaborateur', $data, function ($message) use ($email_respo) {
                            $message->to($email_respo)
                                ->subject('CONGE');
                            $message->from('associecourtage@gmail.com', 'ACCESS CREDIT');
                        });
                    }
                    return back()->with('danger', 'Veuillez contacter l\'administration');
                } else {
                    $email_respo = User::select('email')->join("respos", 'respos.user_id', '=', 'users.id')->where('respos.id', $respoId)->value('email');
                    // dd($email_respo);
                    $email_rh = User::select('email')->join("services", 'services.id', '=', 'users.service_id')->where('rh', 'OUI')->value('email');
                    // envoi de mail au responsable
                    if ($request->isMethod('post')) {
                        $data = $request->all();
                        $data = array(
                            "body" => "Notification de demande de congé",
                            'email' => $email_respo,
                            'date_debut' => $data['date_debut'],
                            'date_fin' => $data['date_fin'],
                            'type' => $data['type'],
                            'civilite' => Auth::user()->civilite,
                            'name' => Auth::user()->name,
                            'prenom' => Auth::user()->prenom,
                        );

                        Mail::send('emails.congescollaborateur', $data, function ($message) use ($email_respo) {
                            $message->to($email_respo)
                                ->subject('CONGE');
                            $message->from('associecourtage@gmail.com', 'ACCESS CREDIT');
                        });

                        Mail::send('emails.congescollaborateur', $data, function ($message) use ($email_rh) {
                            $message->to($email_rh)
                                ->subject('CONGE');
                            $message->from('associecourtage@gmail.com', 'ACCESS CREDIT');
                        });
                    }
                }
            }

            if ($request->type == "PERMISSION") {
                return back()->with('success', 'Permission démandé avec succes');
            }
            if ($request->type == "CONGE") {
                return back()->with('success', 'Congé démandé avec succes');
            }
        } catch (\Exception $exception) {
            //     die("Impossible de se connecter à la base de données.  Veuillez vérifier votre configuration. erreur:" . $exception);
            return back()->with('erreur', 'Impossible de se connecter à la base de données.  Veuillez vérifier votre configuration');
        }
    }

    public function congeAll()
    {
        $conges = Conge::join("users", 'users.id', '=', 'conges.user_id')->get();
        return view('rh.validationconge')->with(compact('conges'));
    }

    public function congeRespo()
    {
        $respo = Respo::join("users", 'users.id', '=', 'respos.user_id')->where('user_id', Auth::user()->id)->value('respos.id');
        $conges = Conge::join("users", 'users.id', '=', 'conges.user_id')->where('respo_id', $respo)->get();
        return view('conges.validation')->with(compact('conges'));
    }

    public function validateRepo(Request $request, $id)
    {
        try {
            $conges = Conge::find($id);
            $conges->etat = $request->etat;
            $conges->motif_etat = $request->motif_etat;
            $conges->save();


            if ($request->isMethod('post')) {
                $data = $request->all();
                $email = Conge::select('email')->join("users", 'users.id', '=', 'conges.user_id')->where('conges.id', $id)->value('email');
                $data = array(
                    "body" => "Validation du responsable",
                    'type' => $data['etat'],
                );

                Mail::send('emails.congescollaborateur', $data, function ($message) use ($email) {
                    $message->to($email)
                        ->subject('CONGE');
                    $message->from('associecourtage@gmail.com', 'ACCESS CREDIT');
                });
            }


            return back()->with('success', 'Validation avec succes');
        } catch (\Exception $exception) {
            //     die("Impossible de se connecter à la base de données.  Veuillez vérifier votre configuration. erreur:" . $exception);
            return back()->with('erreur', 'Impossible de se connecter à la base de données.  Veuillez vérifier votre configuration');
        }
    }

    public function validateRh(Request $request, $id)
    {
        try {

            $conges = Conge::find($id);
            $conges->etat = $request->etat;
            // $conges->motif_etat = $request->motif_etat;
            $conges->save();

            $email = Conge::select('email')->join("users", 'users.id', '=', 'conges.user_id')->where('conges.id', $id)->value('email');

            if ($request->isMethod('post')) {
                $data = $request->all();
                $data = array(
                    "body" => "Validation des ressources humaines",
                    'type' => $data['etat'],
                );

                Mail::send('emails.congescollaborateur', $data, function ($message) use ($email) {
                    $message->to($email)
                        ->subject('CONGE');
                    $message->from('associecourtage@gmail.com', 'ACCESS CREDIT');
                });
            }

            return back()->with('success', 'Validation avec succes');
        } catch (\Exception $exception) {
            //     die("Impossible de se connecter à la base de données.  Veuillez vérifier votre configuration. erreur:" . $exception);
            return back()->with('erreur', 'Impossible de se connecter à la base de données.  Veuillez vérifier votre configuration');
        }
    }
}
