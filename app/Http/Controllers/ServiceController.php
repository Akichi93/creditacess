<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function serviceList()
    {
        $services = Service::all();
        return view('parametre.listservice')->with(compact('services'));
    }

    public function serviceAdd(Request $request)
    {
        //validation
        $rules = [
            'nom_service' => 'required',
        ];

        $customMessages = [
            'nom_service.required' => 'Veuillez entrer le nom du service',
        ];

        $this->validate($request, $rules, $customMessages);

        // Envoi dans la bdd
        $service = new service();
        $service->nom_service = $request->nom_service;
        $service->save();

        //redirection
        return back()->with('success', 'Service enregistré avec succes');
    }

    public function serviceUpdate(Request $request, $id)
    {
        $services = Service::find($id);
        $services->nom_service = $request->nom_service;
        $services->save();

        return back()->with('success', 'Service enregistré avec succes');
    }
}
