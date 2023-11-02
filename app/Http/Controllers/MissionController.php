<?php

namespace App\Http\Controllers;

use App\Models\Respo;
use App\Models\Mission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // $conge->date_debut = $request->date_debut;
        // $conge->date_fin = $request->date_fin;
        // $conge->description = $request->description;
        $conge->respo_id = $respoId;
        $conge->user_id = $user->id;
        $conge->etat = $etat;
        $conge->save();

        return back()->with('success', 'Mission ajouté avec succes');
    }

    public function missionAll(){
        $missions = Mission::join("users", 'users.id', '=', 'mission.user_id')->get();
        return view('rh.validationmission')->with(compact('missions'));
    }

    public function missionRespo(){
        $respo = Respo::join("users", 'users.id', '=', 'respos.user_id')->where('user_id', Auth::user()->id)->value('respos.id');
        $missions = Mission::join("users", 'users.id', '=', 'mission.user_id')->where('respo_id', $respo)->get();
        return view('mission.validation')->with(compact('missions'));
    }
}
