<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        // Insertion dans la bdd
        $user = Auth::user();

        $demande = new Demande();
        $demande->type_doc = $request->type_doc;
        $demande->description = $request->description;
        $demande->user_id = $user->id;
        $demande->save();

        return back()->with('success', 'Demande envoye avec succes');
    }

    public function demandeUpdate(Request $request, $id)
    {
        $demandes = Demande::find($id);
        $demandes->etat = 1;
        $demandes->save();

        return back()->with('success', 'Demande modifie avec succes');
    }
}
