@extends('layouts.app')

@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Missions</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Tableau de bord</a></li>
                        <li class="breadcrumb-item active">Missions</li>
                    </ul>
                </div>
                <div class="col-auto float-end ms-auto">
                    <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_overtime"><i
                            class="fa-solid fa-plus"></i> Ajout de mission</a>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if ($message = Session::get('success'))
            <div class="alert alert-primary alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif


        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table leave-employee-table mb-0 datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Agence</th>
                                <th>Debut</th>
                                <th>Fin</th>
                                <th>Frais</th>
                                <th>Description</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($missions as $mission)
                                <tr>
                                    <td>1</td>
                                    <td>{{ $mission->agence }}</td>
                                    <td>{{ $mission->date_debut }}</td>
                                    <td>{{ $mission->date_fin }}</td>
                                    <td>{{ $mission->frais_mission }}</td>
                                    <td>{{ $mission->description }}</td>
                                    <td>
                                        @if ($mission->etat == 0)
                                            <span class="badge bg-inverse-secondary">EN COURS</span>
                                        @else
                                            <span class="badge bg-inverse-danger">ACCEPTER</span>
                                        @endif
                                    </td>


                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div id="add_overtime" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter une mission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="{{ route('mission.add') }}">
                        @csrf
                        <div class="input-block mb-3">
                            <label class="col-form-label">Frais <span class="text-danger">*</span></label>
                            <input type="number" name="frais_mission" class="form-control">  
                        </div>
                        <div class="input-block mb-3">
                            <label class="col-form-label">Agence <span class="text-danger">*</span></label>
                            <input type="text" name="agence" class="form-control">  
                        </div>

                        <div class="input-block mb-3">
                            <label class="col-form-label">Description <span class="text-danger">*</span></label>
                            <textarea rows="4" class="form-control" name="description"></textarea>
                        </div>
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
