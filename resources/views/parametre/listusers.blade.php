@extends('layouts.app')

@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Utilisateurs</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Tableau de bord</a></li>
                        <li class="breadcrumb-item active">Utilisateurs</li>
                    </ul>
                </div>
                <div class="col-auto float-end ms-auto">
                    <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_user"><i
                            class="fa-solid fa-plus"></i> Ajouter utilisateur</a>
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
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Email</th>
                                <th>Poste</th>
                                <th>Service</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>
                                        {{ $user->name }}
                                    </td>
                                    <td>
                                        {{ $user->prenom }}
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->poste }}</td>
                                    <td>
                                        <span class="badge bg-inverse-danger">{{ $user->nom_service }}</span>
                                    </td>
                                    <td class="text-end">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown"
                                                aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#edit_user"><i class="fa-solid fa-pencil m-r-5"></i>
                                                    Modifier</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="add_user" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter utilisateur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="{{ route('user.add') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12" style="text-align: center;">
                                <label>Selectionner civilité</label>
                            </div>
                            <div class="col-sm-12" style="text-align: center;">
                                <input type="radio" id="homme" name="civilite" value="M." required>
                                <label for="homme">M.</label>
                                <input type="radio" id="femme" name="civilite" value="Mme">
                                <label for="femme">Mme</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Nom <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="name" id="name">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Prénom<span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="prenom" id="prenom">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <input class="form-control" type="email" name="email" id="email">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Fonction <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="poste" id="poste">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Mot de passe</label>
                                    <input class="form-control" type="password" name="password" id="password">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Confirmer Mot de passe</label>
                                    <input class="form-control" type="password" name="password_confirmation"
                                        id="password_confirmation">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Service</label>
                                    <select class="form-control" name="service">
                                        <option value="null">Selectionner le service</option>
                                        @foreach ($services as $service)
                                            <option value="{{ $service->id }}">{{ $service->nom_service }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Rôle</label>
                                    <select class="form-control" name="role">
                                        <option value="null">Selectionnez un rôle</option>
                                        <option value="ADMIN">ADMIN</option>
                                        <option value="USER">USER</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="debut">Date d'embauche</label>
                                        <input class="form-control" type="date" id="debut"
                                            name="date_debut_embauche" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="d-block">Ce collaborateur est il responsable?</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input respooui" type="radio" name="respo"
                                            id="gender_male" value="OUI">
                                        <label class="form-check-label" for="gender_male">Oui</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input responon" type="radio" name="respo"
                                            id="gender_female" value="NON">
                                        <label class="form-check-label" for="gender_female">Non</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="d-block">Ce collaborateur appatient il au service RH?</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input collabooui" type="radio" name="rh"
                                            id="gender_male" value="OUI">
                                        <label class="form-check-label" for="gender_male">Oui</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input collabonon" type="radio" name="rh"
                                            id="gender_female" value="NON">
                                        <label class="form-check-label" for="gender_female">Non</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn btn_add">Créer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <div id="edit_user" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">First Name <span class="text-danger">*</span></label>
                                    <input class="form-control" value="John" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Last Name</label>
                                    <input class="form-control" value="Doe" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Username <span class="text-danger">*</span></label>
                                    <input class="form-control" value="johndoe" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                    <input class="form-control" value="johndoe@example.com" type="email">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Password</label>
                                    <input class="form-control" type="password">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Confirm Password</label>
                                    <input class="form-control" type="password">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Phone </label>
                                    <input class="form-control" value="9876543210" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Role</label>
                                    <select class="select">
                                        <option>Admin</option>
                                        <option>Client</option>
                                        <option selected="">Employee</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Company</label>
                                    <select class="select">
                                        <option>Global Technologies</option>
                                        <option>Delta Infotech</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Employee ID <span class="text-danger">*</span></label>
                                    <input type="text" value="FT-0001" class="form-control floating">
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive m-t-15">
                            <table class="table table-striped custom-table">
                                <thead>
                                    <tr>
                                        <th>Module Permission</th>
                                        <th class="text-center">Read</th>
                                        <th class="text-center">Write</th>
                                        <th class="text-center">Create</th>
                                        <th class="text-center">Delete</th>
                                        <th class="text-center">Import</th>
                                        <th class="text-center">Export</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Employee</td>
                                        <td class="text-center">
                                            <label class="custom_check">
                                                <input type="checkbox" checked="">
                                                <span class="checkmark"></span>
                                            </label>
                                        </td>
                                        <td class="text-center">
                                            <label class="custom_check">
                                                <input type="checkbox" checked="">
                                                <span class="checkmark"></span>
                                            </label>
                                        </td>
                                        <td class="text-center">
                                            <label class="custom_check">
                                                <input type="checkbox" checked="">
                                                <span class="checkmark"></span>
                                            </label>
                                        </td>
                                        <td class="text-center">
                                            <label class="custom_check">
                                                <input type="checkbox" checked="">
                                                <span class="checkmark"></span>
                                            </label>
                                        </td>
                                        <td class="text-center">
                                            <label class="custom_check">
                                                <input type="checkbox" checked="">
                                                <span class="checkmark"></span>
                                            </label>
                                        </td>
                                        <td class="text-center">
                                            <label class="custom_check">
                                                <input type="checkbox" checked="">
                                                <span class="checkmark"></span>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Holidays</td>
                                        <td class="text-center">
                                            <label class="custom_check">
                                                <input type="checkbox" checked="">
                                                <span class="checkmark"></span>
                                            </label>
                                        </td>
                                        <td class="text-center">
                                            <label class="custom_check">
                                                <input type="checkbox" checked="">
                                                <span class="checkmark"></span>
                                            </label>
                                        </td>
                                        <td class="text-center">
                                            <label class="custom_check">
                                                <input type="checkbox" checked="">
                                                <span class="checkmark"></span>
                                            </label>
                                        </td>
                                        <td class="text-center">
                                            <label class="custom_check">
                                                <input type="checkbox" checked="">
                                                <span class="checkmark"></span>
                                            </label>
                                        </td>
                                        <td class="text-center">
                                            <label class="custom_check">
                                                <input type="checkbox" checked="">
                                                <span class="checkmark"></span>
                                            </label>
                                        </td>
                                        <td class="text-center">
                                            <label class="custom_check">
                                                <input type="checkbox" checked="">
                                                <span class="checkmark"></span>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Leaves</td>
                                        <td class="text-center">
                                            <label class="custom_check">
                                                <input type="checkbox" checked="">
                                                <span class="checkmark"></span>
                                            </label>
                                        </td>
                                        <td class="text-center">
                                            <label class="custom_check">
                                                <input type="checkbox" checked="">
                                                <span class="checkmark"></span>
                                            </label>
                                        </td>
                                        <td class="text-center">
                                            <label class="custom_check">
                                                <input type="checkbox" checked="">
                                                <span class="checkmark"></span>
                                            </label>
                                        </td>
                                        <td class="text-center">
                                            <label class="custom_check">
                                                <input type="checkbox" checked="">
                                                <span class="checkmark"></span>
                                            </label>
                                        </td>
                                        <td class="text-center">
                                            <label class="custom_check">
                                                <input type="checkbox" checked="">
                                                <span class="checkmark"></span>
                                            </label>
                                        </td>
                                        <td class="text-center">
                                            <label class="custom_check">
                                                <input type="checkbox" checked="">
                                                <span class="checkmark"></span>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Events</td>
                                        <td class="text-center">
                                            <label class="custom_check">
                                                <input type="checkbox" checked="">
                                                <span class="checkmark"></span>
                                            </label>
                                        </td>
                                        <td class="text-center">
                                            <label class="custom_check">
                                                <input type="checkbox" checked="">
                                                <span class="checkmark"></span>
                                            </label>
                                        </td>
                                        <td class="text-center">
                                            <label class="custom_check">
                                                <input type="checkbox" checked="">
                                                <span class="checkmark"></span>
                                            </label>
                                        </td>
                                        <td class="text-center">
                                            <label class="custom_check">
                                                <input type="checkbox" checked="">
                                                <span class="checkmark"></span>
                                            </label>
                                        </td>
                                        <td class="text-center">
                                            <label class="custom_check">
                                                <input type="checkbox" checked="">
                                                <span class="checkmark"></span>
                                            </label>
                                        </td>
                                        <td class="text-center">
                                            <label class="custom_check">
                                                <input type="checkbox" checked="">
                                                <span class="checkmark"></span>
                                            </label>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
