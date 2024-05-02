@php
    // $settings = $helpers->getSettings();
    $meta_title = config('app.name') . ' | ' . $pageName;
    $meta_description = config('app.name') . ' | ' . $pageName;
@endphp
<!DOCTYPE html>
<html>

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
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="{{ asset('Frontend/assets/css/mdb.min.css') }}" />
    <!-- Main Style -->
    <link rel="stylesheet" href="{{ asset('Frontend/assets/css/style.css') }}" />
    <!-- Custom styles -->
    <style>
        .right {
            background: linear-gradient(212.38deg, rgba(242, 57, 127, 0.7) 0%, rgba(175, 70, 189, 0.71) 100%), url("{{ asset('Frontend/assets/img/login-bg.jpg') }}");
        }
    </style>
</head>

<body>
    <section class="login">
        <div class="login_box">
            <div class="left">
                <div class="top_link">
                    <a href="{{ url('/') }}">
                        <img src="https://drive.google.com/u/0/uc?id=16U__U5dJdaTfNGobB_OpwAJ73vM50rPV&export=download"
                            alt="" />
                        Return home
                    </a>
					{{-- <a href="{{ route('user.login') }}">
                        <img style="color: #999"/>
                        Login
                    </a> --}}
					

                </div>
                <div class="contact">
                    <form action="{{ route('register.submit') }}" method="POST" id="signup-form">
                        @csrf
                        <h3>SignUp</h3>
                        <input type="text" name="first_name" class="form-control" id="first_name"
                            placeholder="First Name" required />
                        <input type="text" name="last_name" class="form-control" id="last_name"
                            placeholder="Last Name" required />
                        <input type="text" name="username" class="form-control" id="username"
                            placeholder="Email Address" required />
                        <input type="password" name="password" class="form-control" id="password"
                            placeholder="Password" required />
                        <input type="password" name="confirm_password" class="form-control" id="confirm_password"
                            placeholder="Confirm Password" required />
                        <button type="submit" class="btn btn-primary" id="register-button">Register</button>
                        <br>
                        <br>
                        <small class="">Already Registered? <a href="{{ route('user.login') }}"
                                style="color:#999"class="">Login</a></small>


                    </form>
                </div>
            </div>
            <div class="right">
                <div class="right-text">
                    <h2>Manny Properties</h2>
                    <h5>Property Hub</h5>
                </div>
            </div>
        </div>
    </section>
    <!-- MDB -->
    <script type="text/javascript" src="{{ asset('Frontend/assets/js/mdb.min.js') }}"></script>
    <!-- Custom scripts -->
    <script type="text/javascript"></script>
</body>

</html>






@php
    return;
    // $settings = $helpers->getSettings();
    $meta_title = config('app.name') . ' | ' . $pageName;
    $meta_description = config('app.name') . ' | ' . $pageName;
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
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="{{ asset('Frontend/assets/css/mdb.min.css') }}" />
    <!-- Main Style -->
    <link rel="stylesheet" href="{{ asset('Frontend/assets/css/style.css') }}" />
    <!-- Custom styles -->

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="{{ route('register.submit') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="first_name" class="form-control" id="first_name"
                            placeholder="First Name" required />
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="last_name" class="form-control" id="last_name"
                            placeholder="Last Name" required />
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="text" name="username" class="form-control" id="username"
                            placeholder="Email Address" required />
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" id="password"
                            placeholder="Password" required />
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="confirm_password" class="form-control" id="confirm_password"
                            placeholder="Confirm Password" required />
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" id="register-button">Register</button>
                    </div>
                </form>
                <span>Already Registered? <a href="{{ url('/login') }}">Login here</a>.</span>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- MDB -->
    <script type="text/javascript" src="{{ asset('Frontend/assets/js/mdb.min.js') }}"></script>
    <!-- Custom scripts -->
    <script type="text/javascript"></script>
</body>

</html>
