<?php

namespace App\Http\Controllers;

use App\Models\Conge;
use App\Models\Respo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DateTime;

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
        $userId = Respo::where('user_id', Auth::user()->id)->get();

        if ($userId == null) {
            $etat = 0;
        } else {
            $etat = 1;
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


        if ($userId == null) {
            // Envoie d'email a la responsable RH
            // dd($userId);
        } else {
        }
        // envoi de mail
        // if ($request->isMethod('post')) {
        //     $data = $request->all();

        //     $name = $request->respo;

        //     $a = DB::table('respos')
        //         ->select('*')
        //         ->join("users", 'respos.user_id', '=', 'users.id')
        //         ->where('respos.id_respo', $name)
        //         ->get();

        //     $array = json_decode(json_encode($a), true);
        //     $ar = $array[0];
        //     $to_email = $ar['email'];
        //     $r_civil = $ar['civilite'];
        //     $r_name = $ar['name'];
        //     $r_prenom = $ar['prenom'];

        //     $b = DB::table('users')
        //         ->select('*')
        //         ->where('id',$user->id)
        //         ->get();

        //     $barray = json_decode(json_encode($b), true);
        //     $br = $barray[0];
        //     $civil = $br['civilite'];
        //     $name = $br['name'];
        //     $prenom = $br['prenom'];



        //     $data = array(
        //         "body" => "Notification",
        //         'motif' => $data['motif'],
        //         'date_debut' => $data['date_debut'],
        //         'date_fin' => $data['date_fin'],
        //         'r_civil' => $r_civil,
        //         'r_name' => $r_name,
        //         'r_prenom' => $r_prenom,
        //         'civil' => $civil,
        //         'name' => $name,
        //         'prenom' => $prenom,
        //     );

        //     Mail::send('emails.conge', $data, function ($message) use ($to_email) {
        //         $message->to($to_email)
        //             ->subject('Notification');
        //         $message->from('info@aroapartners.com', 'Aroapartners');
        //     });

        // Mail::send('emails.congerh', $data, function ($message) use ($to_email) {
        //     $message->to('vanessa.bogui@aroapartners.com')
        //         ->subject('Notification');
        //     $message->from('info@aroapartners.com', 'Aroapartners');
        // });
        // }
        if ($request->type == "PERMISSION") {
            return back()->with('success', 'Permission démandé avec succes');
        }
        if ($request->type == "CONGE") {
            return back()->with('success', 'Congé démandé avec succes');
        }
    }

    public function congeAll()
    {
        $conges = Conge::all();
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
        $conges = Conge::find($id);
        $conges->etat = $request->etat;
        $conges->motif_etat = $request->motif_etat;
        $conges->save();


        return back()->with('success', 'Validation avec succes');
    }

    public function validateRh(Request $request, $id)
    {
        $conges = Conge::find($id);
        $conges->etat = $request->etat;
        // $conges->motif_etat = $request->motif_etat;
        $conges->save();


        return back()->with('success', 'Validation avec succes');
    }
}
