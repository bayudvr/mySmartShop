@extends('layouts.app')

@section('title','Profile')

@section('content')

    @include('layouts.sidebar')

    <div class="main-content" id="panel">
        @include('layouts.header')

        <div class="header pb-6 d-flex align-items-center" style="min-height: 500px; background-image: url(./assets/vendor/img/theme/img-1-1000x600.jpg); background-size: cover; background-position: center top;">
                
            <span class="mask bg-gradient-default opacity-8"></span>
            <div class="container-fluid d-flex align-items-center">
                <div class="row">
                    <div class="col-lg-7 col-md-10">
                        <h1 class="display-2 text-white" id="welcome_message"></h1>
                        <p class="text-white mt-0 mb-5">This is your profile page. You can edit your account here. Don't forget to change you password regurarly to make it more secure (>_<). </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid mt--6">
            <div class="row">
                <div class="col-xl-4 order-xl-2">
                    <div class="card card-profile" id="admin_profiles"></div>
                </div>
                <div class="col-xl-8 order-xl-1">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">Edit profile </h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" id="admin_profile_data"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.modal')
@endsection

@push('styles')

@endpush

@push('scripts')

    @include('customs.profile-js')

@endpush