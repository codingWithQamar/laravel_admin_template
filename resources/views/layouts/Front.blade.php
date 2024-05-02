@php
// $settings = $helpers->getSettings();
	$meta_title = config('app.name').' | '.$pageName;
	$meta_description = config('app.name').' | '.$pageName;
@endphp
<!DOCTYPE html>
	<html lang="en">
	<head>
		<!-- Meta Tag -->
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<meta name="description" content="{{ $meta_description }}">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>{{ $meta_title }}</title>

		<link rel="canonical" href="{{ URL::current() }}" />
{{--
		<meta property="fb:app_id" content="{{ config('app.FACEBOOK_APP_ID') }}" />
		<meta property="og:title" content="{{ $meta_title }}" />
		<meta property="og:type" content="article" />
		<meta property="og:url" content="{{ URL::current() }}" />
		<meta property="og:image" content="{{ asset('uploads/'.$settings->logo) }}" />
		<meta property="og:image:secure_url" content="{{ asset('uploads/'.$settings->logo) }}" />
		<meta property="og:description" content="{{ $meta_description }}" />
		<!-- sample twitter meta -->
		<meta name="twitter:card" content="summary_large_image">
		<meta name="twitter:title" content="{{ $meta_title }}">
		<meta name="twitter:description" content="{{ $meta_description }}">
		<meta name="twitter:creator" content="@creator_username">
		<meta name="twitter:image" content="{{ asset('uploads/'.$settings->logo) }}">
		<meta name="twitter:domain" content="{{ url('/') }}">
--}}
		<!-- MDB icon -->
		<link rel="icon" href="{{ asset('Frontend/assets/img/mdb-favicon.ico') }}" type="image/x-icon" />
		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
		<!-- Google Fonts Roboto -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
		<!-- MDB -->
		<link rel="stylesheet" href="{{ asset('Frontend/assets/css/mdb.min.css') }}" />
		<!-- MDB UI Kit -->
		<link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.min.css" rel="stylesheet" />
		<!-- Main Style -->
		<link rel="stylesheet" href="{{ asset('Frontend/assets/css/style.css') }}" />
		<!-- SweetAlert -->
		<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.1/dist/sweetalert2.min.css" rel="stylesheet">
		<!-- Custom styles -->
		{{ $inPageCss }}

	</head>
	<body>
		<x-nav />
		{{$slot}}
		<!-- Scripts -->
		<script>
		const baseUrl = "{{ url('/') }}";
		</script>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<!-- MDB -->
		<script type="text/javascript" src="{{ asset('Frontend/assets/js/mdb.min.js') }}"></script>
		<!-- SweetAlert -->
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.1/dist/sweetalert2.all.min.js"></script>
		<!-- MDB UI Kit -->
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>
		<!-- Custom scripts -->
		{{ $inPageJs }}
		<script type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" ></script>
	</body>
</html>
