		<main class="">
			<nav class="navbar navbar-expand-lg mb-2">
				<div class="container-fluid">
					<a class="navbar-brand" href="#">
						<img src="{{asset('Frontend/assets/img/logo.png')}}">
					</a>
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<form class="d-flex">
							<select class="nav-select me-3">
								<option>ON</option>
								<option>BC</option>
							</select>
							<input class="form-control input-nav me-2" type="text" autocomplete="off" placeholder="Address, Street Name or Listing#" aria-label="Address, Street Name or Listing#" >
							<i class="fa fa-search nav-search"></i>
						</form>
						<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
							<li class="nav-item">
								<a class="nav-link active" aria-current="page" href="{{ route('mapSearch') }}">Map Search</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">Market Trends</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">Home Valuatioin</a>
							</li>
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
									Tools
								</a>
								<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
									
									<!-- <li><hr class="dropdown-divider"></li> -->
									<li><a class="dropdown-item" href="#">Something else here</a></li>
								</ul>
							</li>
							@if(Auth::user())
								<li class="nav-item ms-3">
									<a class="btn nav-bg-btn" href="{{ route('myWatchArea') }}">My Account</a>
								</li>
							@else
								{{-- <li class="nav-item ms-2">
									<a class="btn nav-outline-btn" href="{{ route('user.login') }}">Log in</a>
								</li> --}}
								<li class="nav-item ms-3">
									<a class="btn nav-bg-btn" href="{{ route('register') }}">Join</a>
								</li>

							@endif
						</ul>
						
					</div>
				</div>
			</nav>
		</main>
