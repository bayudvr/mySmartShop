@extends('layouts.app')

@section('title','MSS | Sign Up Form')

@section('body_class','bg-default')

@section('content')
    <div class="main-content">
        <div class="header bg-gradient-primary py-7 py-lg-8">
            <div class="separator separator-bottom separator-skew zindex-100">
                <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div>
        </div>

        <div class="container mt--8 pb-5">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-9">
                    <div class="card bg-secondary border-0 mb-0">
                        <div class="card-header bg-transparent pb-5">
                            <h1>MSS | Sign Up Page</h1>
                        </div>
                        <div class="card-body px-lg-5 py-lg-5">
                            <form method="POST" id="signupForm">
                                @csrf
                                <nav class="mb-3">
                                    <div class="nav nav-pills justify-content-center" id="signupTabs" role="tablist">
                                        <a href="#" data-target="#tab1" class="nav-item nav-link active" id="tab1btn" data-toggle="tab" role="tab" aria-controls="tab1" aria-selected="true">1. Profile</a>
                                        <a href="#" data-target="#tab2" class="nav-item nav-link" id="tab2btn" data-toggle="tab" role="tab" aria-controls="tab2" aria-selected="false">2. Business Info</a>
                                        <a href="#" data-target="#tab3" class="nav-item nav-link" id="tab3btn" data-toggle="tab" role="tab" aria-controls="tab3" aria-selected="false">3. Choose Package</a>
                                    </div>
                                </nav>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="tab-content" id="tab-content">
                                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1btn">
                                                <div class="form-group">
                                                    <div class="input-group input-group-merge input-group-alternative">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                                                        </div>
                                                        <input class="form-control" placeholder="Username" type="text" name="MAUSR_USERNAME" autofocus>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group input-group-merge input-group-alternative">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                                        </div>
                                                        <input class="form-control" placeholder="Email" type="text" name="MAUSR_EMAIL" autofocus>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group input-group-merge input-group-alternative">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                                        </div>
                                                        <input class="form-control" placeholder="Password" type="password" name="MAUSR_PASSWORD">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group input-group-merge input-group-alternative">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="ni ni-check-bold"></i></span>
                                                        </div>
                                                        <input class="form-control" placeholder="Confirm Password" type="password" name="confirm_password">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group input-group-merge input-group-alternative">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                                        </div>
                                                        <input class="form-control" placeholder="Fullname" type="text" name="MAUSR_FULLNAME">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group input-group-merge input-group-alternative">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                                        </div>
                                                        <input class="form-control" placeholder="Date of Birth" type="date" name="MAUSPRO_DOB">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group input-group-merge input-group-alternative">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="ni ni-building"></i></span>
                                                        </div>
                                                        <input class="form-control" placeholder="City of Birth" type="text" name="MAUSPRO_COB">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group input-group-merge input-group-alternative">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="ni ni-square-pin"></i></span>
                                                        </div>
                                                        <input class="form-control" placeholder="Nation of Birth" type="text" name="MAUSPRO_NOB">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group input-group-merge input-group-alternative">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="ni ni-image"></i></span>
                                                        </div>
                                                        <input class="form-control" placeholder="Confirm Password" accept="image/*" type="file" name="MAUSPRO_PHOTO">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2btn">
                                                <div class="form-group">
                                                    <div class="input-group input-group-merge input-group-alternative">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="ni ni-shop"></i></span>
                                                        </div>
                                                        <input class="form-control" placeholder="Business Name" type="text" name="MABUS_NAME">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group input-group-merge input-group-alternative">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="ni ni-align-left-2"></i></span>
                                                        </div>
                                                        <textarea class="form-control" placeholder="Business Description" rows="5" name="MABUS_DESC"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group input-group-merge input-group-alternative">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="ni ni-badge"></i></span>
                                                        </div>
                                                        <input class="form-control" placeholder="Business Contact" type="text" name="MABUS_CONTACT">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group input-group-merge input-group-alternative">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="ni ni-pin-3"></i></span>
                                                        </div>
                                                        <input class="form-control" placeholder="Business Address" type="text" name="MABUS_ADDRESS">
                                                    </div>
                                                </div>                   
                                            </div>
                                            <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3btn">
                                                <div class="form-group">
                                                    <div class="input-group input-group-merge input-group-alternative">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="ni ni-folder-17"></i></span>
                                                        </div>
                                                        <select name="package" id="package" class="form-control selectpicker" data-live-search="true">
                                                            <option value="" selected>Choose Package</option>
                                                            @foreach($packages as $package)

                                                            <option value="{{ $package['MAPACK_CODE'] }}">{{ $package['MAPACK_NAME'] }} | Rp. {{ number_format($package['MAPACK_PRICE']) }}/Month</option>

                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group input-group-merge input-group-alternative">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                                        </div>
                                                        <select name="length" id="length" class="form-control selectpicker">
                                                            <option value="" selected>Select Duration</option>
                                                            <option value="2">2 Months</option>
                                                            <option value="6">6 Months</option>
                                                            <option value="12">1 Year</option>
                                                            <option value="24">2 Years</option>
                                                        </select>
                                                    </div>
                                                </div>                                        
                                                <div class="form-group">
                                                    <div class="input-group input-group-merge input-group-alternative">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="ni ni-credit-card"></i></span>
                                                        </div>
                                                        <select name="TRPACK_PAYMENT_METHOD" id="TRPACK_PAYMENT_METHOD" class="form-control selectpicker">
                                                            <option value="" selected>Choose Payment Method</option>
                                                            <option value="1">OVO Wallet</option>
                                                            <option value="2">GO Pay Balance</option>
                                                            <option value="3">Bank Transfer</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" id="regisBtn" class="btn btn-lg btn-primary my-4">Register Now</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <p>Already Have an account? click <a href="./">here</a> to log in</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
@endpush

@push('scripts')
    @include('customs.signup-js')
@endpush