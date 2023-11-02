<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Respo;
use App\Models\Contrat;
use App\Models\Service;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
        $user->role = $request->role;
        $user->date_debut_embauche = $request->date_debut_embauche;
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

        //Envoie d'email

        $data = $request->all();

        //Envoi du mot de passe par email
        $email = $data['email'];
        $name = $data['name'];
        $data =
            array(
                "body" => "Notification de création de compte",
                'email' => $email,
                'name' => $name,
                'password' => $request->password
            );

        Mail::send('emails.users', $data, function ($message) use ($email) {
            $message->to($email)
                ->subject('Compte ACCESS CREDIT');
            $message->from('associecourtage@gmail.com', 'ACCESS CREDIT');
        });




        return back()->with('success', 'Collaborateur crée avec succès');
    }

    public function personnel()
    {
        $users = User::all();
        return view('rh.personnel')->with(compact('users'));
    }

    public function details($id)
    {
        $ids = Crypt::decrypt($id);
        $users = User::join("services", 'services.id', '=', 'users.service_id')->where('users.id', $ids)->first();
        $files = Document::where('user_id', $ids)->get();
        $contrats = Contrat::where('user_id', $ids)->get();
        return view('rh.details')->with(compact('users', 'files','contrats'));
    }

    public function uploadDoc(Request $request, $id)
    {

        $rules = [
            'titre' => 'required',
            'file' => 'required|max:10000|mimes:doc,docx,pdf',
        ];

        $customMessages = [
            'titre.required' => 'Veuillez entrer le nom du document',
            'file.required' => 'Fichier requis pour la suite',
        ];
        $this->validate($request, $rules, $customMessages);

        // dd()
        if ($request->hasfile('file')) {
            $filename = $request->file('file')->getClientOriginalName();
            $extension = $request->file('file')->getClientOriginalExtension();
            $size = $request->file('file')->getSize();
            $request->file('file')->move(public_path() . '/fichier/documents/', $filename);

            // Envoi dans la bdd
            $annonce = new Document();
            $annonce->titre = $request->titre;
            $annonce->file = $filename;
            $annonce->user_id = $id;
            $annonce->save();

            //redirection
            return back()->with('success', 'Fichier ajouté avec succès');
        }
    }

    public function updateUser(Request $request, $id)
    {
        $rules = [
            'name' => 'required',
            'prenom' => 'required',
            'phone' => 'required|numeric|digits:10',
            'adresse' => 'required',
            'date_debut_embauche' => 'required',
        ];

        $customMessages = [
            'name.required' => 'Entrez le nom',
            'prenom.required' => 'Entrez le prenom',
            'phone.required' => 'Entrez le contact',
            'phone.digits' => 'Entrez un contact de 10 chiffres',
            'adresse.required' => 'Entrez l\'adresse',
            'date_debut_embauche.required' => 'Entrez la date d\'embauche',
        ];
        $this->validate($request, $rules, $customMessages);


        User::where('id', $id)->update(['name' => $request->name, 'prenom' => $request->prenom, 'phone' => $request->phone, 'adresse' => $request->adresse, 'date_debut_embauche' => $request->date_debut_embauche]);


        return back()->with('success', 'Info collaborateur modifié avec succès');
    }

    public function contratUser(Request $request, $id)
    {
        $rules = [
            'type_contrat' => 'required',
            'date_debut' => 'required',
            'salaire' => 'required',
        ];

        $customMessages = [
            'type_contrat.required' => 'Entrez le nom',
            'date_debut.required' => 'Entrez la date de début',
            'salaire.required' => 'Entrez le salaire',
        ];
        $this->validate($request, $rules, $customMessages);

        if ($request->type_contrat == null) {
            return back()->with('danger', 'Veuillez selectionnez un type de contrat');
        }

        // Verifier si le collaborateur à un contrat en cours
        $verify = Contrat::where('user_id', $id)->value('type_contrat');

        if ($verify == "STAGE" || $verify == "CDD") {
            $date = Contrat::select('date_fin')->where('user_id', $id)->latest();

            $now = date('d-m-y');

            if ($date < $now) {
                $id = Contrat::select('id')->where('id', $id)->latest()->first();


                Contrat::where('id',$id)->update(['date_fin' => $now]);

                // Inserer contrat dans la Bdd
                $contrat = new Contrat();
                $contrat->type_contrat = $request->type_contrat;
                $contrat->date_debut = $request->date_debut;
                $contrat->date_fin = $request->date_fin;
                $contrat->salaire = $request->salaire;
                $contrat->user_id = $id;
                $contrat->save();

                return back()->with('success', 'Nouveau contrat ajouter');
            } else {
                // Inserer contrat dans la Bdd
                $contrat = new Contrat();
                $contrat->type_contrat = $request->type_contrat;
                $contrat->date_debut = $request->date_debut;
                $contrat->date_fin = $request->date_fin;
                $contrat->salaire = $request->salaire;
                $contrat->user_id = $id;
                $contrat->save();

                return back()->with('success', 'Nouveau contrat ajouter');
            }
        } elseif ($verify == "CDI") {
            return back()->with('danger', 'Vous ne pouvez pas aujouter un nouveau contrat à ce utilisateur');
        } elseif ($verify == null) {
            // // Inserer contrat dans la Bdd
            $contrat = new Contrat();
            $contrat->type_contrat = $request->type_contrat;
            $contrat->date_debut = $request->date_debut;
            $contrat->date_fin = $request->date_fin;
            $contrat->salaire = $request->salaire;
            $contrat->user_id = $id;
            $contrat->save();

            return back()->with('success', 'Nouveau contrat ajouter');
        }
    }
}
