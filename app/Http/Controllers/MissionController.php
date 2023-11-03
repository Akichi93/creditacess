<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Respo;
use App\Models\Mission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MissionController extends Controller
{
    public function missionList()
    {
        $missions = Mission::all();
        return view('mission.listmission')->with(compact('missions'));
    }

    public function missionAdd(Request $request)
    {
        //validation
        $rules = [
            'agence' => 'required',
            'frais_mission' => 'required',
            'description' => 'required',
        ];

        $customMessages = [
            'agence.required' => 'Veuillez entrez le nom de l\'agence',
            'frais_mission.required' => 'Veuillez entrez le montant des frais',
            'description.required' => 'Veuillez entrez la description',
        ];

        $this->validate($request, $rules, $customMessages);


        $user = Auth::user();

        //Recuperer l'id du reponsable
        $respoId = Respo::select('id')->where('service_id', Auth::user()->service_id)->value('id');

        //Verifier si la personne qui fait la demande est un reponsable
        $userId = Respo::where('user_id', Auth::user()->id)->get();

        if ($userId == null) {
            $etat = 0;
        } else {
            $etat = 1;
        }

        $conge = new Mission();
        $conge->frais_mission = $request->frais_mission;
        $conge->agence = $request->agence;
        $conge->date_debut = $request->date_debut;
        $conge->date_fin = $request->date_fin;
        $conge->description = $request->description;
        $conge->respo_id = $respoId;
        $conge->user_id = $user->id;
        $conge->etat = $etat;
        $conge->save();

        // Envoie de mail
        if ($userId == null) {
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
                    "body" => "Notification de demande de mission",
                    'email' => $email,
                    'date_debut' => $data['date_debut'],
                    'date_fin' => $data['date_fin'],
                    'frais' => $data['frais_mission'],
                    'civilite' => $civilite_respo,
                    'name' => $nom_respo,
                    'prenom' => $prenom_respo,
                );

                Mail::send('emails.missionsrespo', $data, function ($message) use ($email) {
                    $message->to($email)
                        ->subject('MISSION');
                    $message->from('associecourtage@gmail.com', 'ACCESS CREDIT');
                });

                Mail::send('emails.missionsrespo', $data, function ($message) use ($email) {
                    $message->to('billybillesakichi@outlook.fr')
                        ->subject('MISSION');
                    $message->from('associecourtage@gmail.com', 'ACCESS CREDIT');
                });
            }
        } else {
            $email_rh = User::select('email')->join("services", 'services.id', '=', 'users.service_id')->where('rh', 'OUI')->value('email');

            if ($email_rh == null) {
                $email_respo = User::select('email')->join("respos", 'respos.users.id', '=', 'users.id')->where('respos.user_id', $respoId)->value('email');
                // envoi de mail au responsable
                if ($request->isMethod('post')) {
                    $data = $request->all();
                    $data = array(
                        "body" => "Notification de demande de congé",
                        'email' => $email_respo,
                        'date_debut' => $data['date_debut'],
                        'date_fin' => $data['date_fin'],
                        'frais' => $data['frais_mission'],
                        'civilite' => Auth::user()->civilite,
                        'name' => Auth::user()->name,
                        'prenom' => Auth::user()->prenom,
                    );

                    Mail::send('emails.missionscollaborateur', $data, function ($message) use ($email_respo) {
                        $message->to($email_respo)
                            ->subject('MISSION');
                        $message->from('associecourtage@gmail.com', 'ACCESS CREDIT');
                    });

                    Mail::send('emails.missionscollaborateur', $data, function ($message) use ($email_respo) {
                        $message->to('billybillesakichi@outlook.fr')
                            ->subject('MISSION');
                        $message->from('associecourtage@gmail.com', 'ACCESS CREDIT');
                    });
                }
                return back()->with('danger', 'Veuillez contacter l\'administration');
            } else {
                $email_respo = User::select('email')->join("respos", 'respos.users.id', '=', 'users.id')->where('respos.user_id', $respoId)->value('email');
                $email_rh = User::select('email')->join("services", 'services.id', '=', 'users.service_id')->where('rh', 'OUI')->value('email');
                // envoi de mail au responsable
                if ($request->isMethod('post')) {
                    $data = $request->all();
                    $data = array(
                        "body" => "Notification de demande de congé",
                        'email' => $email_respo,
                        'date_debut' => $data['date_debut'],
                        'date_fin' => $data['date_fin'],
                        'frais' => $data['frais_mission'],
                        'civilite' => Auth::user()->civilite,
                        'name' => Auth::user()->name,
                        'prenom' => Auth::user()->prenom,
                    );

                    Mail::send('emails.missionscollaborateur', $data, function ($message) use ($email_respo) {
                        $message->to($email_respo)
                            ->subject('MISSION');
                        $message->from('associecourtage@gmail.com', 'ACCESS CREDIT');
                    });

                    Mail::send('emails.missionscollaborateur', $data, function ($message) use ($email_rh) {
                        $message->to($email_rh)
                            ->subject('MISSION');
                        $message->from('associecourtage@gmail.com', 'ACCESS CREDIT');
                    });

                    Mail::send('emails.missionscollaborateur', $data, function ($message) use ($email_respo) {
                        $message->to('billybillesakichi@outlook.fr')
                            ->subject('MISSION');
                        $message->from('associecourtage@gmail.com', 'ACCESS CREDIT');
                    });
                }
            }
        }

        return back()->with('success', 'Mission ajouté avec succes');
    }

    public function missionAll()
    {
        $missions = Mission::join("users", 'users.id', '=', 'missions.user_id')->get();
        return view('rh.validationmission')->with(compact('missions'));
    }

    public function missionRespo()
    {
        $respo = Respo::join("users", 'users.id', '=', 'respos.user_id')->where('user_id', Auth::user()->id)->value('respos.id');
        $missions = Mission::join("users", 'users.id', '=', 'missions.user_id')->where('respo_id', $respo)->get();
        return view('mission.validation')->with(compact('missions'));
    }

    public function validateRh(Request $request, $id)
    {
        //validation
        $rules = [
            'etat' => 'required',
        ];

        $customMessages = [
            'etat.required' => 'Veuillez entrez le nom de l\'agence',
        ];

        $this->validate($request, $rules, $customMessages);

        $missions = Mission::find($id);
        $missions->etat = $request->etat;
        $missions->save();

        return back()->with('success', 'Mission validé avec succes');
    }

    public function validateRespo(Request $request, $id)
    {
        //validation
        $rules = [
            'etat' => 'required',
        ];

        $customMessages = [
            'etat.required' => 'Veuillez entrez le nom de l\'agence',
        ];

        $this->validate($request, $rules, $customMessages);
        
        $missions = Mission::find($id);
        $missions->etat = $request->etat;
        $missions->save();

        return back()->with('success', 'Mission validé avec succes');
    }
}
