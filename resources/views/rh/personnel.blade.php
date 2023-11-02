@extends('layouts.app')

@section('content')

<div class="content container-fluid">

    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Gestion du personnel</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="admin-dashboard.html">Tableau </a></li>
                    <li class="breadcrumb-item active">Gestion du personnel</li>
                </ul>
            </div>
           
        </div>
    </div>


    

    <div class="row staff-grid-row">
        @foreach($users as $user)
        <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
            
            <div class="profile-widget">
                <div class="profile-img">
                    <a href="{{route('users.details', encrypt($user->id))}}" class="avatar"><img src="assets/img/profiles/avatar-08.jpg"
                            alt="User Image"></a>
                </div>
              
               
                <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="{{route('users.details', encrypt($user->id))}}">{{ $user->name }} {{ $user->prenom }}</a>
                </h4>
                <div class="small text-muted">{{ $user->poste }}</div>
            </div>
           

        </div>
        @endforeach
    </div>
</div>

@endsection
