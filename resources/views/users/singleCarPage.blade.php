@extends('layouts.main')

@section('content')



<single-car-page :single_car ="{{json_encode($single_car)}}"></single-car-page>




@endsection
