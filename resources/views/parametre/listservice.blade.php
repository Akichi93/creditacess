@extends('layouts.app')

@section('content')

    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Services</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin-dashboard.html">Tableau de bord</a></li>
                        <li class="breadcrumb-item active">Services</li>
                    </ul>
                </div>
                <div class="col-auto float-end ms-auto">
                    <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_department"><i
                            class="fa-solid fa-plus"></i> Ajouter service</a>
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
                <div>
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="width-thirty">#</th>
                                <th>Nom du service</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($services as $service)
                                <tr>

                                    <td>6</td>
                                    <td>{{ $service->nom_service }}</td>
                                    <td>
                                        <a href="#" data-bs-toggle="modal"
                                            data-bs-target="#edit_department--{{ $service->id }}"><i
                                                class="fa-solid fa-pencil m-r-5"></i> Modifier</a>


                </div>
                </td>
                <div id="edit_department--{{ $service->id }}" class="modal custom-modal fade" role="dialog">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Modifier service</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form role="form" method="POST" action="{{ route('service.update', $service->id) }}">
                                    {{ csrf_field() }}
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Nom du service <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control" name="nom_service" value="{{ $service->nom_service }}"
                                            type="text">
                                    </div>
                                    <div class="submit-section">
                                        <button type="submit" class="btn btn-primary submit-btn">Modifier</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                </tr>
                @endforeach
                </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>

    <div id="add_department" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="{{ route('service.add') }}">
                        @csrf
                        <div class="input-block mb-3">
                            <label class="col-form-label">Nom du service <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="nom_service"
                                placeholder="Entrer le nom du sevice">
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
