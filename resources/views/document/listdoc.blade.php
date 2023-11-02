@extends('layouts.app')

@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Demandes</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Tableau de bord</a></li>
                        <li class="breadcrumb-item active">Demandes</li>
                    </ul>
                </div>
                <div class="col-auto float-end ms-auto">
                    <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_overtime"><i
                            class="fa-solid fa-plus"></i> Demande de document</a>
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
                                <th>Type de document</th>
                                <th>Description</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($demandes as $demande)
                                <tr>
                                    <td>1</td>
                                    <td>{{ $demande->type_doc }}</td>
                                    <td>{{ $demande->description }}</td>
                                    <td>
                                        @if ($demande->etat == 0)
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
                    <h5 class="modal-title">Demande de document</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="{{ route('demande.add') }}">
                        @csrf
                        <div class="input-block mb-3">
                            <label class="col-form-label">Type de document <span class="text-danger">*</span></label>
                            <select class="form-control" name="type_doc">
                                <option value="null">Selectionnez le type</option>
                                <option value="CERTIFICAT DE TRAVAIL">CERTIFICAT DE TRAVAIL</option>
                                <option value="FICHE DE POSTE">FICHE DE POSTE</option>
                                <option value="BULETTIN DE SALAIRE">BULETTIN DE SALAIRE</option>
                            </select>
                        </div>

                        <div class="input-block mb-3">
                            <label class="col-form-label">Description <span class="text-danger">*</span></label>
                            <textarea rows="4" class="form-control" name="description"></textarea>
                        </div>
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn">Demander</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
