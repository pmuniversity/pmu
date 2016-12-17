@extends('layouts.auth')

@section('content')
<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Content area -->
				<div class="content">

					<!-- Simple login form -->
					<form method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}
						<div class="panel panel-body login-form">
							<div class="text-center">
								<div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
								<h5 class="content-group">Login to your account <small class="display-block">Enter your credentials below</small></h5>
							</div>

							<div class="form-group has-feedback has-feedback-left{{ $errors->has('email') ? ' has-error' : '' }}">
								<input type="email" name="email" class="form-control" placeholder="E-mail"  value="{{ old('email') }}" required autofocus>
								<div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
								</div>
								@if ($errors->has('email'))
                                    <span class="help-block">
                                        {{ $errors->first('email') }}
                                    </span>
                                @endif
							</div>

							<div class="form-group has-feedback has-feedback-left{{ $errors->has('password') ? ' has-error' : '' }}">
								<input type="password" class="form-control" placeholder="Password" name="password" required>
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
								@if ($errors->has('password'))
                                    <span class="help-block">
                                        {{ $errors->first('password') }}
                                    </span>
                                @endif
							</div>
							
							<div class="form-group login-options">
								<div class="row">
									<div class="col-sm-6">
										<label class="checkbox-inline">
										<span class="checked">
											<input type="checkbox" class="styled" checked="checked" name="remember">
											Remember
											</span>
										</label>
									</div>

									<div class="col-sm-6 text-right">
										<a href="{{ url('/password/reset') }}">Forgot password?</a>
									</div>
								</div>
							</div>

							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-block">Sign in <i class="icon-circle-right2 position-right"></i></button>
							</div>

							<div class="text-center">
								<a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot password?</a>
							</div>
						</div>
					</form>
					<!-- /simple login form -->


					<!-- Footer -->
					<div class="footer text-muted text-center">
						&copy; 2015. <a href="#">Limitless Web App Kit</a> by <a href="http://themeforest.net/user/Kopyov" target="_blank">Eugene Kopyov</a>
					</div>
					<!-- /footer -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->
@endsection
