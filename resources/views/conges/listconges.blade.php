@extends('layouts.app')

@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Conges</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Tableau de bord</a></li>
                        <li class="breadcrumb-item active">Conges</li>
                    </ul>
                </div>
                <div class="col-auto float-end ms-auto">
                    <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_leave"><i
                            class="fa-solid fa-plus"></i> Ajouter conge</a>
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
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>De</th>
                                <th>A</th>
                                <th>Nombre de jour</th>
                                <th>Date de retour</th>
                                <th>Motif</th>
                                <th class="text-center">Etat</th>
                                
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($conges as $conge)
                                <tr>
                                    <td>{{ $conge->type_conge }}</td>
                                    <td>{{ $conge->date_debut }}</td>
                                    <td>{{ $conge->date_fin }}</td>
                                    <td>{{ $conge->duree  }} jour(s)</td>
                                    <td>{{ $conge->date_retour  }}</td>
                                    <td>{{ $conge->motif }}</td>
                                    <td class="text-center">
                                        @if ($conge->etat == 0)
                                            <div class="action-label">
                                                <a class="btn btn-white btn-sm btn-rounded" href="javascript:void(0);">
                                                    <i class="fa fa-dot-circle-o text-dark"></i> EN COURS
                                                </a>
                                            </div>
                                        @elseif($conge->etat == 1)
                                            <div class="action-label">
                                                <a class="btn btn-white btn-sm btn-rounded" href="javascript:void(0);">
                                                    <i class="fa fa-dot-circle-o text-success"></i> ACCEPTER
                                                </a>
                                            </div>
                                        @elseif($conge->etat == 2)
                                            <div class="action-label">
                                                <a class="btn btn-white btn-sm btn-rounded" href="javascript:void(0);">
                                                    <i class="fa fa-dot-circle-o text-success"></i> VALIDER
                                                </a>
                                            </div>
                                        @elseif($conge->etat == 3)
                                            <div class="action-label">
                                                <a class="btn btn-white btn-sm btn-rounded" href="javascript:void(0);">
                                                    <i class="fa fa-dot-circle-o text-danger"></i> REFUSER
                                                </a>
                                            </div>
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


    <div id="add_leave" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter conge</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="{{ route('conge.add') }}">
                        @csrf
                        <div class="input-block mb-3">
                            <label class="col-form-label">Type <span class="text-danger">*</span></label>
                            <select class="form-control" name="type">
                                <option value="null">Selectionnez type</option>
                                <option value="PERMISSION">PERMISSION</option>
                                <option value="CONGE">CONGE</option>
                            </select>
                        </div>
                        <div class="input-block mb-3">
                            <label class="col-form-label">De <span class="text-danger">*</span></label>
                            <input class="form-control" type="date" name="date_debut">
                        </div>
                        <div class="input-block mb-3">
                            <label class="col-form-label">A <span class="text-danger">*</span></label>
                            <input class="form-control" type="date" name="date_fin">
                        </div>

                        <div class="input-block mb-3">
                            <label class="col-form-label">Motif <span class="text-danger">*</span></label>
                            <textarea rows="4" class="form-control" name="motif"></textarea>
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
