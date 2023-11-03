<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Demande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class DemandeController extends Controller
{
    public function demandeList()
    {
        $demandes = Demande::all();
        return view('document.listdoc')->with(compact('demandes'));
    }

    public function demandeAdd(Request $request)
    {
        //validation
        $rules = [
            'type_doc' => 'required',
            'description' => 'required',
        ];

        $customMessages = [
            'type_doc.required' => 'Veuillez selectionner le type d\'absence',
            'description.required' => 'Veuillez entrez le motif',
        ];

        $this->validate($request, $rules, $customMessages);
        try {
            // Insertion dans la bdd
            $user = Auth::user();

            $demande = new Demande();
            $demande->type_doc = $request->type_doc;
            $demande->description = $request->description;
            $demande->user_id = $user->id;
            $demande->save();

            // Envoie d'email a la responsable RH
            $email = User::select('email')->join("services", 'services.id', '=', 'users.service_id')->where('rh', 'OUI')->value('email');

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
                    "body" => "Notification de demande de document",
                    'email' => $email,
                    'type' => $data['type_doc'],
                    'civilite' => $civilite_respo,
                    'name' => $nom_respo,
                    'prenom' => $prenom_respo,
                );

                Mail::send('emails.missionsrespo', $data, function ($message) use ($email) {
                    $message->to($email)
                        ->subject('MISSION');
                    $message->from('associecourtage@gmail.com', 'ACCESS CREDIT');
                });
            }

            return back()->with('success', 'Demande envoye avec succes');
        } catch (\Exception $exception) {
            //     die("Impossible de se connecter à la base de données.  Veuillez vérifier votre configuration. erreur:" . $exception);
            return back()->with('erreur', 'Impossible de se connecter à la base de données.  Veuillez vérifier votre configuration');
        }
    }

    public function demandeUpdate(Request $request, $id)
    {
        try {
            $demandes = Demande::find($id);
            $demandes->etat = 1;
            $demandes->save();

            return back()->with('success', 'Demande modifie avec succes');
            
        } catch (\Exception $exception) {
            //     die("Impossible de se connecter à la base de données.  Veuillez vérifier votre configuration. erreur:" . $exception);
            return back()->with('erreur', 'Impossible de se connecter à la base de données.  Veuillez vérifier votre configuration');
        }
    }
}
