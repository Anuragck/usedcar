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
    <!-- Page Content -->
    <div class="page-heading about-heading header-text" style="background-image: url(assets/img/heading-6-1920x500.jpg);">

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-content">

                        <h2>Cars</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="products">
        <div class="hd text-dark text-center mb-4">Find Your Dream Car With Us</div>
<all-cars-page></all-cars-page>
    </div>
    </div>
@endsection
