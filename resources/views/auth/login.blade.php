{{-- OLD Layout (tidak dipakai)--}}
	{{-- <x-guest-layout>
		<!-- Session Status -->
		<x-auth-session-status class="mb-4" :status="session('status')" />

		<form method="POST" action="{{ route('login') }}">
			@csrf

			<!-- Email Address -->
			<div>
				<x-input-label for="email" :value="__('Email')" />
				<x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
				<x-input-error :messages="$errors->get('email')" class="mt-2" />
			</div>

			<!-- Password -->
			<div class="mt-4">
				<x-input-label for="password" :value="__('Password')" />

				<x-text-input id="password" class="block mt-1 w-full"
								type="password"
								name="password"
								required autocomplete="current-password" />

				<x-input-error :messages="$errors->get('password')" class="mt-2" />
			</div>

			<!-- Remember Me -->
			<div class="block mt-4">
				<label for="remember_me" class="inline-flex items-center">
					<input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
					<span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
				</label>
			</div>

			<div class="flex items-center justify-end mt-4">
				@if (Route::has('password.request'))
					<a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
						{{ __('Forgot your password?') }}
					</a>
				@endif

				<x-primary-button class="ms-3">
					{{ __('Log in') }}
				</x-primary-button>
			</div>
		</form>
	</x-guest-layout> --}}
{{-- OLD Layout (tidak dipakai)--}}

{{-- new layout --}}
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Presensix - Login</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon"  href="{{url('assetImg/logo-judul.png')}}">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	
	<!-- Global stylesheets -->
	<link href="{{ url('bs5eticket/template/assets/fonts/inter/inter.css')}}" rel="stylesheet" type="text/css">
	<link href="{{ url('bs5eticket/template/assets/icons/phosphor/styles.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{ url('bs5eticket/template/html/layout_2/full/assets/css/ltr/all.min.css')}}" id="stylesheet" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="{{ url('bs5eticket/template/assets/demo/demo_configurator.js')}}"></script>
	<script src="{{ url('bs5eticket/template/assets/js/bootstrap/bootstrap.bundle.min.js')}}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="{{ url('bs5eticket/template/html/layout_2/full/assets/js/app.js')}}"></script>
	<!-- /theme JS files -->
	<style>
		::placeholder {
  			color: rgba(170, 170, 170, 0.82) !important;
		}
		
		/* .dashboard-text {
		    opacity: 0;
		    transition: all 0.3s ease;
		}

		.position-absolute:hover .dashboard-text {
		    opacity: 1;
		} */
	</style>
</head>

<body>

	<!-- Main navbar -->
	<div class="navbar navbar-dark navbar-static py-2">
		<div class="container-fluid">
			<div class="navbar-brand">
				<a href="/" class="d-inline-flex align-items-center">
					<img src="{{ url('assetImg/logo-apk2.png') }}" width="175px" style="height: 53px !important;" alt="">
				</a>
			</div>

			<div class="d-flex justify-content-end align-items-center ms-auto">
				<ul class="navbar-nav flex-row">
					<li class="nav-item">
						<a href="#" class="navbar-nav-link navbar-nav-link-icon rounded ms-1">
							<img src="{{ url('assetImg/logo-smansix2.png') }}" width="150px" style="height: 65px !important;" alt="">
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Page content -->
	<div class="page-content bg-dark">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Inner content -->
			<div class="content-inner">

				<!-- Content area -->
				<div class="content d-flex justify-content-center align-items-center">

					<!-- Login form -->
					<form class="login-form" action="{{route('auth.login')}}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="card mb-0 shadow" style="border-radius: 15px;">
							<div class="card-body">
								<div class="text-center mb-3">
									<div class="d-inline-flex align-items-center justify-content-center mb-3 mt-2">
										<img src="{{ url('assetImg/logo-apk1.png')}}" class="pe-3" height="76px" alt="">
									</div>
									<h5 class="mb-0">Login to your account</h5>
									<span class="d-block text-muted">Enter your identity below</span>
								</div>

								@if ($errors->has('account'))
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <table>
                                        <tr>
                                            <td><i class="ph-x-circle me-2"></i></td>
                                            <td>{{ $errors->first('account') }}</td>
                                        </tr>
                                    </table>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                                @endif

								<div class="mb-3">
									<label class="form-label">NIP / NISN</label>
									<div class="form-control-feedback form-control-feedback-start">
										<input type="text" class="form-control" placeholder="NIP / NISN" type="text" name="credential_number" required>
										<div class="form-control-feedback-icon">
											<i class="ph-user-circle text-muted"></i>
										</div>
									</div>
								</div>

								<div class="mb-3">
									<label class="form-label">Password</label>
									<div class="form-control-feedback form-control-feedback-start">
										<input type="password" class="form-control" placeholder="DDMMYYYY" type="password" id="password" name="password" required>
										<div class="position-absolute end-0 top-50 translate-middle-y" style="z-index : 9999;">                            
											<a href="#" class="text-dark d-flex align-item-center d-none btn-show me-2"><i class="ph-eye ph-sm"></i></a>
										</div> 
										<div class="form-control-feedback-icon">
											<i class="ph-lock text-muted"></i>
										</div>
									</div>
								</div>

								<div class="mb-1">
									<button type="submit" class="btn btn-warning fw-bold w-100">LOGIN</button>
								</div>
								<div class="text-dark mt-2 text-center">
									<span><small><i class="ph-book text-dark"></i></small> User Manual <a target="_blank" href="{{ url('assetImg/User Manual Ticketing System.pdf') }}">klik disini</a></span>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>

<script>
	var passInput = $("#password");
        $('#password').keyup(function(){            
            if($('#password').val() != ''){
                $('.btn-show').removeClass('d-none');  
                $('.btn-show').click(function(){
                    showPassword();
                });
            } else{
                $('.btn-show').addClass('d-none');
                passInput.attr('type','password');
            }
        });
        
	function showPassword(){              
		if(passInput.attr('type')==='password')
			{
			passInput.attr('type','text');
		}else{
			passInput.attr('type','password');
		}
	}

	$(document).ready(function(){
		$(".position-absolute").hover(
			function() {
				$(this).find('.dashboard-text').stop().fadeIn('slow').toggleClass('d-none');
			}, 
			function() {
				$(this).find('.dashboard-text').stop().fadeOut('slow', function() {
					$(this).toggleClass('d-none');
				});
			}
		);
	});
</script>
</html>