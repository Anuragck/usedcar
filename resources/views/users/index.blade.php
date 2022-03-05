@extends('layouts.main')
 <!--
  Start Preloader
  ==================================== -->
  <div id="preloader">
    <div class='preloader'>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
  <!--
  End Preloader
  ==================================== -->
@section('content')
    <div class="">

        <!-- Page Content -->
        <!-- Banner Starts Here -->
        <div class="banner header-text">
            <div class="owl-banner owl-carousel">
                <div class="banner-item-01">
                    <div class="text-content">
                        <h4>Find Your Dream Car Today!</h4>
                        <h2>AFFORDABLE & LIKE NEW</h2>
                    </div>
                </div>
                <div class="banner-item-02">
                    <div class="text-content">
                        <h4></h4>
                        <h2>Let Us Find What You’re Looking For</h2>
                    </div>
                </div>
                <div class="banner-item-03">
                    <div class="text-content">
                        <h4></h4>
                        <h2>Eye it – try it – buy it!</h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- Banner Ends Here -->

        <div class="latest-products">
            <index-page-cars></index-page-cars>
            {{-- <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-heading">
                            <h2>Featured Cars</h2>
                            <a href="\allCarsPage">view more <i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="product-item">
                            <div class="zoom">
                                <a href="/CarsPages/MaruthiBaleno"><img src="assets/img/product2.jpg" alt=""></a>
                                <div class="down-content">
                                    <a href="/CarsPages/MaruthiBaleno">
                                        <h4>2018 Maruti Baleno</h4>
                                    </a>
                                    <h5>1.2 Alpha</h5>
                                    <h6><small><del> ₹ 8,32,000</del></small> ₹ 8,18,000</h6>

                                    <p>83.1bhp &nbsp;/&nbsp; Petrol &nbsp;/&nbsp; 2018 &nbsp;/&nbsp; Used vehicle</p>

                                    <small>
                                        <strong title="Author"><i class="fa fa-dashboard"></i> 17,380 Kms</strong>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <strong title="Author"><i class="fa fa-cube"></i> 1197
                                            cc</strong>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <strong title="Views"><i class="fa fa-cog"></i> Manual</strong>
                                    </small>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div> --}}
        </div>

    </div>

    <div class="container mb-5 pb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading mt-5 pt-5 text-center">
                    <h2><b>Why Dream Cars</h2></b>
                </div>
            </div>
        </div>
    </div>

            <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-xl-3">
                        <div class="card bg-c-blue order-card">
                            <div class="card-block">
                                <h6 class="m-b-20"></h6>
                                <h2 class="text-right"><i class="fa fa-car f-left"></i><span></span></h2>
                                <p class="m-b-0"><span class="f-right">Best Price For Your Car</span></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-xl-3">
                        <div class="card bg-c-green order-card">
                            <div class="card-block">
                                <h6 class="m-b-20"></h6>
                                <h2 class="text-right"><i class="fa fa-bolt f-left"></i><span></span></h2>
                                <p class="m-b-0"><span class="f-right">Instant Payment</span></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-xl-3">
                        <div class="card bg-c-yellow order-card">
                            <div class="card-block">
                                <h6 class="m-b-20"></h6>
                                <h2 class="text-right"><i class="fa fa-thumbs-up f-left"></i><span></span></h2>
                                <p class="m-b-0"><span class="f-right">100% Genuine Customers</span></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-xl-3">
                        <div class="card bg-c-pink order-card">
                            <div class="card-block">
                                <h6 class="m-b-20"></h6>
                                <h2 class="text-right"><i class="fa fa-exchange f-left"></i><span></span></h2>
                                <p class="m-b-0"><span class="f-right">Free RC Transfer</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




            <div class="best-features">
                <div class="container ">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-heading text-center mt-5 pt-5">

                                <h2><b>Popular Brands</h2></b>

                            </div>
                        </div>
                        <div class="col  text-center  ml-5 pl-4">
                            <div class="row d-flex justify-content-center">
                                <div class="brand-carousel section-padding owl-carousel">
                                    <div class="single-logo w-50"><img alt="" src="assets\img\logo1.png"></div>
                                    <div class="single-logo w-50"><img alt="" src="assets\img\logo2.png"></div>
                                    <div class="single-logo w-50"><img alt="" src="assets\img\logo3.png"></div>
                                    <div class="single-logo w-50"><img alt="" src="assets\img\logo4.png"></div>
                                    <div class="single-logo w-50"><img alt="" src="assets\img\logo5.png"></div>
                                    <div class="single-logo w-50"><img alt="" src="assets\img\logo8.png"></div>
                                    <div class="single-logo w-50"><img alt="" src="assets\img\logo7.png"></div>
                                    <div class="single-logo w-50"><img alt="" src="assets\img\logo9.png"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="happy-clients">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="section-heading text-center mt-5 pt-5">

                                <h2><b>Happy Clients</h2></b>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="owl-clients owl-carousel text-center">
                                <div class="service-item">
                                    <div class="icon ">
                                        <img src="{{ asset('assets/img/testimonials/now-her-dream-comes-true-car.jpg') }}"
                                            class="testimonial-image service-item-img">
                                    </div>
                                    <div class="down-content">
                                        <h4>Mohan Tyagi - Hundai Creta</h4>
                                        <p class="n-m"><em>"
                                                "Dream Cars has the coolest website, choose a car - pay a small deposit -
                                                and car is delivered at home! return it in 7 days if there is some problem.
                                                Dream Cars is going places because of free RC transfer."</em></p>
                                    </div>
                                </div>

                                <div class="service-item">
                                    <div class="icon">
                                        <img src="{{ asset('assets/img/testimonials/shutterstock_121369252.jpg') }}"
                                            alt="" class="testimonial-image">
                                    </div>
                                    <div class="down-content">
                                        <h4>Jane Smith - Mahindra Thar</h4>
                                        <p class="n-m"><em>"The entire car buying experience with Dream Cars was
                                                mindblowing! Loved the 360 view on website through which I could see the
                                                features, interiors, even small scratches and dents - just like in real.
                                                "</em></p>
                                    </div>
                                </div>

                                <div class="service-item">
                                    <div class="icon">
                                        <img src="{{ asset('assets/img/testimonials/Used-Cars-For-Sale-Durham-NC-Couple-with-Kays.jpg') }}"
                                            alt="" class="testimonial-image">
                                    </div>
                                    <div class="down-content">
                                        <h4>Antony Davis - Maruthi Brezza</h4>
                                        <p class="n-m"><em>"The entire car buying experience with Dream Cars was
                                                mindblowing! Loved the 360 view on website through which I could see the
                                                features, interiors, even small scratches and dents - just like in
                                                real."</em></p>
                                    </div>
                                </div>

                                <div class="service-item">
                                    <div class="icon">
                                        <img src="{{ asset('assets/img/testimonials/shutterstock_121369252.jpg') }}"
                                            alt="" class="testimonial-image">
                                    </div>
                                    <div class="down-content">
                                        <h4>Ajay - Jeep Compass</h4>
                                        <p class="n-m"><em>"The entire car buying experience with Dream Cars was
                                                mindblowing! Loved the 360 view on website through which I could see the
                                                features, interiors, even small scratches and dents - just like in
                                                real."</em></p>
                                    </div>
                                </div>

                                <div class="service-item">
                                    <div class="icon">
                                        <img src="{{ asset('assets/img/testimonials/now-her-dream-comes-true-car.jpg') }}"
                                            alt="" class="testimonial-image">
                                    </div>
                                    <div class="down-content">
                                        <h4>Akarsh - Mahindra XVU500</h4>
                                        <p class="n-m"><em>"The entire car buying experience with Dream Cars was
                                                mindblowing! Loved the 360 view on website through which I could see the
                                                features, interiors, even small scratches and dents - just like in
                                                real."</em></p>
                                    </div>
                                </div>

                                <div class="service-item">
                                    <div class="icon">
                                        <img src="{{ asset('assets/img/testimonials/shutterstock_121369252.jpg') }}"
                                            alt="" class="testimonial-image">
                                    </div>
                                    <div class="down-content">
                                        <h4>Antony - VolksWagon Polo</h4>
                                        <p class="n-m"><em>"The entire car buying experience with Dream Cars was
                                                mindblowing! Loved the 360 view on website through which I could see the
                                                features, interiors, even small scratches and dents - just like in
                                                real."</em></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

</div>

    @endsection
