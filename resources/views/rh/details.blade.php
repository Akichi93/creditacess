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

    <div class="card mb-0">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="profile-view">
                       
                        <div class="profile-basic">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="profile-info-left">
                                        <h3 class="user-name m-t-0 mb-0">{{  $users->name }} {{ $users->prenom }}</h3>
                                        <div class="staff-id">{{  $users->poste}}</div>
                                        <div class="small doj text-muted">Date de debut : {{  $users->date_debut}}</div>
                                        
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <ul class="personal-info">
                                        <li>
                                            <div class="title">Contact:</div>
                                            <div class="text"><a href="">9876543210</a></div>
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
                                    data-bs-toggle="modal" data-bs-target="#personal_info_modal"><i
                                        class="fa-solid fa-plus"></i></a></h3>
                            <ul class="personal-info">
                                <li>
                                    <div class="title">Passport No.</div>
                                    <div class="text">9876543210</div>
                                </li>
                                <li>
                                    <div class="title">Passport Exp Date.</div>
                                    <div class="text">9876543210</div>
                                </li>
                                <li>
                                    <div class="title">Tel</div>
                                    <div class="text"><a href="">9876543210</a></div>
                                </li>
                                <li>
                                    <div class="title">Nationality</div>
                                    <div class="text">Indian</div>
                                </li>
                                <li>
                                    <div class="title">Religion</div>
                                    <div class="text">Christian</div>
                                </li>
                                <li>
                                    <div class="title">Marital status</div>
                                    <div class="text">Married</div>
                                </li>
                                <li>
                                    <div class="title">Employment of spouse</div>
                                    <div class="text">No</div>
                                </li>
                                <li>
                                    <div class="title">No. of children</div>
                                    <div class="text">2</div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
               
            </div>
          
        </div>


        




    </div>
</div>


<div id="personal_info_modal" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Televerser</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Document</label>
                                <input type="file" class="form-control">
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


@endsection
