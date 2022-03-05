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
<div class="div">

        <div class="page-heading contact-heading header-text"
            style="background-image: url(assets/img/heading-4-1920x500.jpg);">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-content">

                            <h2>ABOUT US</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="best-features about-features mb-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="hd text-center text-dark">About Dream Cars</div><br><br>
                    </div>
                    <div class="col-md-6">
                        <div class="right-image">
                            <img src="{{ asset('assets/img/about-1-570x350.jpg') }}" alt="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="left-content">
                            {{-- <b><h4>About Dream Cars</h4></b> --}}
                            <p class="text-justify">Our Dream Cars for pre-owned cars, has grown in both size and stature.
                                Being among the major organized player in the market, the brand has expanded its pan India
                                reach via a network of over now become the marketplace of choice for pre-owned car buyers
                                and sellers, catering to their diverse needs across the country.</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class='container-fluid mx-auto  mb-5 col-12 mt-5 pt-5' style="text-align: center">


            <div class="hd text-dark">Accelerating Your Dream</div><br><br>
            <div class="row mt-3" style="justify-content: center">
                <div class="card col-md-3 col-12">
                    <div class="card-content">
                        <div class="card-body"> <img
                                src="https://img.icons8.com/color/100/000000/verified-account.png" />
                            <div class="shadow"></div>
                            <div class="card-title"> Verified </div>
                            <div class="card-subtitle">
                                <p class="text-justify"> <small class="text-muted ">At Your Car, we know that there are
                                        a lot of fake advertisements on the internet, that is why we go the extra mile to
                                        make sure that every person selling his car on our site is a genuine
                                        seller..</small> </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card col-md-3 col-12 ml-5">
                    <div class="card-content">
                        <div class="card-body"> <img
                                src="https://img.icons8.com/external-phatplus-lineal-color-phatplus/100/000000/external-user-contact-us-phatplus-lineal-color-phatplus.png" />
                            <div class="card-title"> Reliablle </div>
                            <div class="card-subtitle">
                                <p> <small class="text-muted"> We make it our mission to ensure all car listings are
                                        real and up to date. To make our site a safe community, we take your complaints
                                        seriously and investigate any fraudulent activity immediately..</small> </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card col-md-3 col-12 ml-5">
                    <div class="card-content">
                        <div class="card-body"> <img src="https://img.icons8.com/stickers/100/000000/trust.png" />
                            <div class="card-title"> Faithful </div>
                            <div class="card-subtitle">
                                <p> <small class="text-muted"> Buying a car is an important decision in your life, that
                                        is why here at Your Car we ensure that all cars available on our site come from
                                        people and dealerships who we are proud to work with.</small> </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="best-features mt-5 pt-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">

                        <div class="hd text-dark text-center">Why Should You Choose Us</div>

                        <div class="">

                            <ul class="featured-list mt-5 mb-5 pt-3">
                                <li><a href="">High-quality & reliable pre-owned cars, digitally evaluated on 376
                                        checkpoints.</a></li>
                                <li><a href="">Fair & transparent prices on pre-owned cars from multiple brands.</a></li>
                                <li><a href="">Exemplary services & convenient processes for both the buyers & sellers.</a>
                                </li>
                                <li><a href=""> Competitive freight options available to every client.</a></li>
                            </ul>

                        </div>

                    </div>
                </div>
            </div>
        </div>



    </div>


    {{-- <footer>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="inner-content">

            </div>
          </div>
        </div>
      </div>
    </footer> --}}
@endsection
