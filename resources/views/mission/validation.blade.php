@extends('layouts.app')

@section('content')
    @php
        use App\Models\User;
    @endphp
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Validations des missions</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Tableau de bord</a></li>
                        <li class="breadcrumb-item active">Missions</li>
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

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Agence</th>
                                <th>Collaborateur</th>
                                <th>Date de debut</th>
                                <th>Date de fin</th>
                                <th>Frais</th>
                                <th class="text-center">Etat</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($missions as $conge)
                                <tr>
                                    <td>{{ $conge->type_conge }}</td>
                                    <td>
                                        @php
                                            $demande = User::where('id', $conge->user_id)->get();
                                            $array = json_decode(json_encode($demande), true);
                                            $ar = $array[0];
                                            $name = $ar['name'];
                                            $prenom = $ar['prenom'];

                                        @endphp
                                        {{ $name }} {{ $prenom }}</td>
                                    <td>{{ $conge->date_debut }}</td>
                                    <td>{{ $conge->date_fin }}</td>
                                    <td>{{ $conge->duree }} jour(s)</td>
                                    <td>{{ $conge->date_retour }}</td>
                                    <td>{{ $conge->motif }}</td>
                                    <td class="text-center">
                                        @if ($conge->etat == 0)
                                            <span class="badge bg-inverse-secondary">EN COURS</span>
                                        @elseif($conge->etat == 1)
                                            <span class="badge bg-inverse-warning">ACCEPTER</span>
                                        @elseif($conge->etat == 2)
                                            <span class="badge bg-inverse-success">VALIDER</span>
                                        @elseif($conge->etat == 3)
                                            <span class="badge bg-inverse-danger">REFUSER</span>
                                        @endif
                                    </td>
                                    <td>


                                        @if ($conge->etat == 0)
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#view_approve--{{ $conge->id }}"><i
                                                    class="fa fa-eye m-r-5"></i>
                                            </a>
                                        @else
                                            Pas d'action
                                        @endif
                                        <div class="modal custom-modal fade" id="view_approve--{{ $conge->id }}"
                                            role="dialog">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="form-header">
                                                            <h3> Validation</h3>
                                                        </div>
                                                        <form role="form" method="POST"
                                                            action="{{ route('conge.validaterespo', $conge->id) }}">
                                                            {{ csrf_field() }}

                                                            <div class="form-group">
                                                                <label>Validation <span class="text-danger">*</span></label>
                                                                <select class="form-control" name="etat">
                                                                    <option>Selectionner validation</option>
                                                                    <option value="1">ACCEPTER</option>
                                                                    <option value="3">REFUSER</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Motif <span class="text-danger">*</span></label>
                                                                <textarea rows="4" class="form-control" name="motif_etat"></textarea>
                                                            </div>
                                                            <div class="submit-section">
                                                                <button
                                                                    class="btn btn-primary submit-btn">Enregistrer</button>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
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



@endsection
