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



<single-car-page :single_car ="{{json_encode($single_car)}}"></single-car-page>




@endsection
