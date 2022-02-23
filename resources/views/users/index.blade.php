@extends('layouts.main')

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
                        <h2></h2>
                    </div>
                </div>
                <div class="banner-item-03">
                    <div class="text-content">
                        <h4></h4>
                        <h2></h2>
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


    <div class="best-features">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading">
                        <center>
                            <h2><b>POPULAR BRANDS</h2></b>
                            Most Reliable Pre-Owned Cars
                        </center>
                    </div>
                </div>
                <div class="col">
                    <div class="row d-flex justify-content-center">
                        <div class="brand-carousel section-padding owl-carousel">
                            <div class="single-logo"><img alt="" src="assets\img\logo1.png"></div>
                            <div class="single-logo"><img alt="" src="assets\img\logo2.png"></div>
                            <div class="single-logo"><img alt="" src="assets\img\logo3.png"></div>
                            <div class="single-logo"><img alt="" src="assets\img\logo4.png"></div>
                            <div class="single-logo"><img alt="" src="assets\img\logo5.png"></div>
                            <div class="single-logo"><img alt="" src="assets\img\logo8.png"></div>
                            <div class="single-logo"><img alt="" src="assets\img\logo7.png"></div>
                            <div class="single-logo"><img alt="" src="assets\img\logo9.png"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





    </div>
@endsection
