<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Respo;
use App\Models\Contrat;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    public function userList()
    {
        $users = User::join("services", 'services.id', '=', 'users.service_id')->get();
        $services = Service::all();
        return view('parametre.listusers')->with(compact('users', 'services'));
    }

    public function userAdd(Request $request)
    {
        // dd($request->all());
        $rules = [
            'name' => 'required|max:30',
            'prenom' => 'required',
            'email' => 'required|unique:users|email|max:255',
            'poste' => 'required|',
            'password' => 'required|between:8,255|confirmed',
            'password_confirmation' => 'required'
        ];

        $customMessages = [
            'name.required' => 'Veuillez entrer le nom de l\'utilisateur',
            'name.max' => 'Le nom d\'utilisateur ne dois pas depasser 30 caractères',
            'prenom.required' => 'Veuillez entrer le prenom de l\'utilisateur',
            'poste.required' => 'Veuillez entrer le prenom de l\'utilisateur',
            'email.required' => 'Veuillez entre l\'email ',
            'password.required' => 'Veuillez entrez un mot de passe ',
            'password.min' => 'Veuillez entrez un mot de passe d\'au moins 8 caractères',
            'password.regex' => 'Le mot de passe doit contenir des majuscules miniscules et symboles',
            'password_confirmation.required' => 'La confirmation du mot de passe est requis',
        ];

        $this->validate($request, $rules, $customMessages);


        // Insertion utilisateur de la bdd
        if ($request->service == null) {
            return back()->with('error', 'Veuillez selectionnez un service');
        }


        $user = new User;
        $user->name = $request->name;
        $user->prenom = $request->prenom;
        $user->email = $request->email;
        $user->poste = $request->poste;
        $user->civilite = $request->civilite;
        $user->service = $request->service;
        $user->service_id = $request->service;
        $user->respo = $request->respo;
        $user->rh = $request->rh;
        $user->password = Hash::make($request->password);
        $user->save();

        // Insertion du reponsable de la bdd
        if ($request->service != null) {
            $id = $user->id;
            if ($request->respo == "OUI") {
                // Insert Responsable d'un service
                $respo = new Respo();
                $respo->user_id = $id;
                $respo->service_id = $request->service;
                $respo->save();
            }
        }


        
        // Inserer contrat dans la Bdd
        $contrat = new Contrat();
        $contrat->type_contrat = $request->type_contrat;
        $contrat->date_debut = $request->date_debut;
        $contrat->date_fin = $request->date_fin;
        $contrat->user_id = $user->id;
        // $contrat->duree = $request->civilite;     
        $contrat->save();



        return back()->with('success', 'Collaborateur crée avec succès');
    }

    public function personnel(){
        $users = User::all();
        return view('rh.personnel')->with(compact('users'));
    }

    public function details($id){
        $ids = Crypt::decrypt($id);
        $users = User::join("services", 'services.id', '=', 'users.service_id')->where('users.id', $ids)->first();
        return view('rh.details')->with(compact('users'));
    }
}
