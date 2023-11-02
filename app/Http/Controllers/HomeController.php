<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Conge;
use App\Models\Demande;
use App\Models\Mission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $conges = Conge::where('user_id', Auth::user()->id)->count();
        $demandes = Demande::where('user_id', Auth::user()->id)->count();
        $missions = Mission::where('user_id', Auth::user()->id)->count();

        $civilite = User::select('civilite as name', DB::raw("COUNT(id) as y"))
            ->groupBy('civilite')
            ->get();

        $tbjson = json_encode($civilite, true);

        // Utilisateur par pôle
    

        $services = DB::table('users')
            ->select('nom_service as name', DB::raw("COUNT(services.id) as y"))
            ->join('services', 'services.id', '=', 'users.service_id')
            ->groupby('services.nom_service')
            ->get()
            ->toArray();

        $json = json_encode($services, true);


        return view('home', compact('conges', 'demandes', 'missions', 'tbjson','json'));
    }
}
