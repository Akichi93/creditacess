@extends('layouts.app')

@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Detail du collaborateur</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Tableau de bord</a></li>
                        <li class="breadcrumb-item active">Details du collaborateur</li>
                    </ul>
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

    
    @if ($message = Session::get('danger'))
        <div class="alert alert-primary alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif

        <div class="card mb-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="profile-view">

                            <div class="profile-basic">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="profile-info-left">
                                            <h3 class="user-name m-t-0 mb-0">{{ $users['name'] }} {{ $users['prenom'] }}
                                            </h3>
                                            <div class="staff-id">{{ $users->poste }}</div>
                                            <div class="small doj text-muted">Date de debut :
                                                {{ $users->date_debut_embauche }}
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <ul class="personal-info">
                                            <li>
                                                <div class="title">Contact:</div>
                                                <div class="text"><a href="">{{ $users->phone }}</a></div>
                                            </li>
                                            <li>
                                                <div class="title">Email:</div>
                                                <div class="text">{{ $users->email }}</a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="title">Adresse:</div>
                                                <div class="text">{{ $users->adresse }}</div>
                                            </li>

                                            <li>
                                                <div class="title">Type de contrat:</div>
                                                <div class="text">{{ $users->type_contrat }}</div>
                                            </li>
                                            <li>
                                                <div class="title">Sexe:</div>
                                                <div class="text"></div>

                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="pro-edit"><a data-bs-target="#profile_info--{{ $users->id }}"
                                    data-bs-toggle="modal" class="edit-icon" href="#"><i
                                        class="fa-solid fa-pencil"></i></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card tab-box">
            <div class="row user-tabs">
                <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
                    <ul class="nav nav-tabs nav-tabs-bottom">
                        <li class="nav-item"><a href="#emp_profile" data-bs-toggle="tab"
                                class="nav-link active">Document</a></li>
                        <li class="nav-item"><a href="#emp_projects" data-bs-toggle="tab" class="nav-link">Contrats</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="tab-content">
          
            <div id="emp_profile" class="pro-overview tab-pane fade show active">
                <div class="row">
                    <div class="col-md-12 d-flex">
                        <div class="card profile-box flex-fill">
                            <div class="card-body">
                                <h3 class="card-title">Televerser les documents <a href="#" class="edit-icon"
                                        data-bs-toggle="modal"
                                        data-bs-target="#personal_info_modal--{{ $users->id }}"><i
                                            class="fa-solid fa-plus"></i></a></h3>
                                <div class="row">
                                    @foreach ($files as $file)
                                        <div class="col-md-3 col-sm-4 col-lg-4 col-xl-3">
                                            <div class="uploaded-box">
                                                <div class="uploaded-img">
                                                    <a href="{{ asset('fichier/documents/' . $file->file) }}">
                                                        <i class="fa fa-file" aria-hidden="true"
                                                            style="font-size:150px"></i></a>
                                                </div>
                                                <div class="uploaded-img-name">
                                                    {{ $file->titre }}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach



                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="tab-pane fade" id="emp_projects">
                <div class="row">
                    <h3 class="card-title">Contrats <a href="#" class="edit-icon" data-bs-toggle="modal"
                            data-bs-target="#contrat--{{ $users->id }}"><i class="fa-solid fa-plus"></i></a></h3>
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table datatable">
                                <thead>
                                    <tr>
                                        <th>Type de contrat</th>
                                        <th>Date de début</th>
                                        <th>Date de fin</th>
                                        <th>Salaire</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contrats as $contrat)
                                    <tr>
                                        <td>{{ $contrat->type_contrat }}</td>
                                        <td>{{ $contrat->date_debut }}</td>
                                        <td>{{ $contrat->date_fin }}</td>
                                        <td>{{ $contrat->salaire }}</td>
                                       
                                    </tr>
                                    @endforeach
                              
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <div id="personal_info_modal--{{ $users->id }}" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Televerser</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="{{ route('upload.doc', $users->id) }}"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Titre</label>
                                    <input type="text" class="form-control" name="titre">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Document</label>
                                    <input type="file" name="file" class="form-control">
                                </div>
                            </div>


                        </div>
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn">Televerser</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="profile_info--{{ $users->id }}" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modification</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="{{ route('user.update', $users->id) }}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">Nom</label>
                                            <input type="text" class="form-control" value="{{ $users->name }}"
                                                name="name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">Prenom</label>
                                            <input type="text" class="form-control" name="prenom"
                                                value="{{ $users->prenom }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">Contact</label>

                                            <input class="form-control" type="text" value="{{ $users->phone }}"
                                                name="phone">

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">Adresse</label>
                                            <input type="text" class="form-control" name="adresse"
                                                value="{{ $users->adresse }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">Date d'embauche</label>
                                            <input type="date" class="form-control" name="date_debut_embauche"
                                                value="{{ $users->date_debut_embauche }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn">Modifier</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="contrat--{{ $users->id }}" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter contrat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="{{ route('user.contrat', $users->id) }}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Type de contrat</label>
                                    <select class="select form-control" name="type_contrat">
                                        <option value="null">Selectionnez uun contrat</option>
                                        <option value="STAGE">STAGE</option>
                                        <option value="CDD">CDD</option>
                                        <option value="CDI">CDI</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Date de début</label>
                                    <input class="form-control" type="date" name="date_debut">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Date de fin</label>
                                    <input class="form-control" type="date" name="date_fin">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Salaire <span class="text-danger">*</span></label>
                                    <input class="form-control" type="number" name="salaire">
                                </div>
                            </div>
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
