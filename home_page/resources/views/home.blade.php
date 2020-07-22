@extends('layouts.app')

@section('title', 'My Smart Shop')

@section('content')

    <div class="fancy-hero-area bg-img bg-overlay animated-img" style="background-image: url(./storage/images/bg.jpg);" id="top">
        <div class="container h-100">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="fancy-hero-content text-center">
                        <!-- Video Overview -->
                        <div class="video-overview">
                            <a href="https://www.youtube.com/watch?v=UaZMDd4wImU" class="video--play--btn"><i class="fa fa-play" aria-hidden="true"></i> Watch The Overview</a>
                        </div>
                        <h2>Point On Sales, Inventory Management, Monthly Sales Recomendations</h2>
                        <a href="#about" class="btn fancy-btn fancy-active">About Us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="fancy-top-features-area bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="fancy-top-features-content">
                        <div class="row no-gutters">
                            <div class="col-12 col-md-4">
                                <div class="single-top-feature">
                                    <h5><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Reliability</h5>
                                    <p>We will help your business even more profitable.</p>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="single-top-feature">
                                    <h5><i class="fa fa-clock-o" aria-hidden="true"></i> Expertise</h5>
                                    <p>Our Algorithm is based on Management and Economics Expertises.</p>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="single-top-feature">
                                    <h5><i class="fa fa-diamond" aria-hidden="true"></i> Quality</h5>
                                    <p>We only asure you to give our best services.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="fancy-about-us-area bg-gray" id="about">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="about-us-text">
                        <h2>We Are A Support System That Helps To Improve Your Business</h2>
                        <p>Although we still developing, but by your inputs, our systems will be more efficient and accurate</p>
                        <p>My Smart Shop is designed to helps you, for you.</p>
                    </div>
                </div>

                <div class="col-12 col-lg-6 col-xl-5 ml-xl-auto">
                    <div class="about-us-thumb wow fadeInUp" data-wow-delay="0.5s">
                        <img src="{{ asset('storage/images/about.jpg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="fancy-services-area bg-img bg-overlay section-padding-100-70" style="background-image: url(./storage/images/discuss.jpeg)" id="features">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading heading-white text-center">
                        <h2>Our Features</h2>
                        <p>We Are A Support System For Your Business</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Single Service -->
                <div class="col-12 col-md-4">
                    <div class="single-service-area text-center wow fadeInUp" data-wow-delay="0.5s">
                        <i class="ti-desktop"></i>
                        <h5>Point On Sales</h5>
                        <p>A Well-Known System, but we provide our own.</p>
                    </div>
                </div>
                <!-- Single Service -->
                <div class="col-12 col-md-4">
                    <div class="single-service-area text-center wow fadeInUp" data-wow-delay="1s">
                        <i class="ti-package"></i>
                        <h5>Inventory Management</h5>
                        <p>The Fancy that recognize the talent and effort of the best web designers, developers and agencies in the world.</p>
                    </div>
                </div>
                <!-- Single Service -->
                <div class="col-12 col-md-4">
                    <div class="single-service-area text-center wow fadeInUp" data-wow-delay="1.5s">
                        <i class="ti-vector"></i>
                        <h5>Monthly Sales Recomendations</h5>
                        <p>An Algorithm that prepared to helps you to decide you sales strategies.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="fancy-testimonials-area section-padding-100" id="team">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="testimonials-slides owl-carousel">
                        <!-- Single Testimonial -->
                        <div class="single-testimonial d-md-flex align-items-center">
                            <!-- Testimonial Thumb -->
                            <div class="testimonial-thumbnail">
                                <img src="{{ asset('storage/images/ceo.jpeg') }}" alt="">
                            </div>
                            <!-- Content -->
                            <div class="testimonilas-content">
                                <span class="playfair-font quote">“</span>
                                <h5>To me making something is a fun way to live life. And seeing these days, a lot of customer need tech every now and then. And I'm one of the person who willingly heard they stories about what they needs, and discuss it together for solution and make it real.</h5>
                                <h6>Muhammad Bayu Devara - <span>CEO AravedTech</span></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="fancy-cta-area bg-img bg-overlay section-padding-100" style="background-image: url(./storage/images/ready.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="cta-content text-center">
                        <h2>Ready To Discuss Your Business?</h2>
                        <p>There are many ways to contact us. You may drop us a line, give us a call or send an email, choose what suits you the most.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="fancy-testimonials-area section-padding-100 bg-img bg-overlay" id="subscription">
        <div class="container">
            <div class="col-lg-12 col-md-12">
                <div class="center">
                    @foreach($package as $p)
                    <div class="card border-primary bg-light m-3 p-3">
                        <div class="card-body">
                            <h3 class="card-title">{{ $p['MAPACK_NAME'] }}</h3>
                            <h5 class="card-text">Rp. {{ number_format($p['MAPACK_PRICE']) }}/month</h5>
                            <ul class="list-unstyled">
                                <li>
                                    <i class="fa fa-check text-success"></i> <span class="badge badge-success">Max Businesses {{ $p['MAPACK_MAX_BUSINESS'] }}</span>
                                </li>
                                <li>
                                    <i class="fa fa-check text-success"></i> <span class="badge badge-success">Max Employees {{ $p['MAPACK_MAX_EMPLOYEE'] }}</span>
                                </li>
                            </ul>
                            <p class="m-2">{{ $p['MAPACK_DESC'] }}</p>
                            <center>
                                <button class="btn btn-info btn-lg m-3" style="border-radius:30px;">
                                    <i class="fa fa-info"></i> See more
                                </button>
                            </center>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <footer class="fancy-footer-area fancy-bg-dark" id="contact">
        <div class="footer-content section-padding-80-50">
            <div class="container">
                <div class="row">
                    <!-- Footer Widget -->
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="single-footer-widget">
                            <h6>Twitter Feed</h6>
                            <div class="single-tweet">
                                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i> With the popularity of podcast shows growing with each year, you might consider starting it yourself as well. <br>https://buff.ly/2zttoJb </a>
                                <span>About 20 hours ago</span>
                            </div>
                        </div>
                    </div>
                    <!-- Footer Widget -->
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="single-footer-widget">
                            <h6>Link Categories</h6>
                            <nav>
                                <ul>
                                    <li><a href="#top"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Home</a></li>
                                    <li><a href="#about"><i class="fa fa-angle-double-right" aria-hidden="true"></i> About</a></li>
                                    <li><a href="#features"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Features</a></li>
                                    <li><a href="#team"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Teams</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <!-- Footer Widget -->
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="single-footer-widget">
                            <h6>Contact Us</h6>
                            <p>1 (800) 686-6688 <br>info.deercreative@gmail.com
                            </p>
                            <p>40 Baria Sreet 133/2 <br>NewYork City, US</p>
                            <p>Open hours: 8.00-18.00 Mon-Fri</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

@endsection

@push('styles')
@endpush

@push('scripts')
    @include('customs.custom-js')
@endpush