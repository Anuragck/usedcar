<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Used Car Showroom Management System</title>
	<meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
	<link rel="icon" href="{{asset('assets/img/favicon.ico')  }}" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
	<script>
		WebFont.load({
			google: {"families":["Open+Sans:300,400,600,700"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"], urls: ['../assets/css/fonts.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->

    {{-- <link href="{{ asset('assets/datatables/dataTables.bootstrap4.min.css') }}"  rel="stylesheet"> --}}


	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/azzara.css') }}">
    <link href="{{ asset('assets/css/vue-select.css') }}" rel="stylesheet" type="text/css">
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet"> --}}

	{{-- <!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}"> --}}


 <!--user Additional CSS Files -->
 {{-- <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}"> --}}
 <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
 <link rel="stylesheet" href="{{ asset('assets/css/owl.css') }}">

 <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css" rel="stylesheet">
	


 
</head>
<body>
    <section id="app">

