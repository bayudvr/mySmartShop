@extends('layouts.app')

@section('title','Businesses')

@section('content')

    @include('layouts.sidebar')

    <div class="main-content" id="panel">
        @include('layouts.header')

        <div class="header bg-primary pb-6">
            <div class="container-fluid">
                <div class="header-body">
                    <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7">
                            <h6 class="h2 text-white d-inline-block mb-0">{{ $title }}</h6>
                            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-lg-6 col-5 text-right">
                            <a href="#" class="btn btn-sm btn-neutral" onClick="showForm('form/business/add')">Add New</a>
                            <a href="#" class="btn btn-sm btn-neutral" onClick="get_business()">Refresh</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="container-fluid mt--6">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header bg-transparent border-0">
                            <div class="table-responsive" id="data"></div>
                        </div>
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
    @include('customs.business-js')
@endpush