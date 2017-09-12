@extends('layouts.app')
@section('content')

<div id="main" role="main">

	<!-- MAIN CONTENT -->
	<div id="content" class="container">

		<div class="row">
		
			<div class="col-xs-12 col-sm-12 col-md-5 col-lg-4 col-md-offset-4">
				<div class="well no-padding">
					<form  id="login-form" class="smart-form client-form" method="post" action="login">
						{{ csrf_field() }}
						<header>
							{{ trans('lang.sign_in') }}
						</header>
						
						<div id="result"></div>
						
						<fieldset>
							<section>
								<label class="label">{{ trans('lang.e_mail') }}</label>
								<label class="input {{ $errors->has('email') ? ' has-error' : '' }}"> <i class="icon-append fa fa-user"></i>
									<input type="email" name="email">
									<b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Please enter email address</b></label>
							</section>

							<section>
								<label class="label">{{ trans('lang.password') }}</label>
								<label class="input"> <i class="icon-append fa fa-lock"></i>
									<input type="password" name="password">
									<b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Enter your password</b> </label>
							</section>

							<section>
								<label class="checkbox">
									<input type="checkbox" name="remember" checked="">
									<i></i>{{ trans('lang.stay_signed_in') }}
								</label>
							</section>
						</fieldset>

						<footer>
							<button type="submit" class="btn btn-primary">
								{{ trans('lang.sign_in') }}	
							</button>

							<a href="/register" class="btn btn-default">
                                <i class="fa fa-btn fa-user"></i>
                                {{ trans('Register') }}
                            </a>
						</footer>
					</form>

				</div>
			</div>
		</div>
	</div>

</div>
@endsection

@section('custom_script')
<script type="text/javascript">
	runAllForms();

    $(function () {
		var errorClass = 'invalid';
		var errorElement = 'em';
		// Validation
		$("#login-form").validate({
			errorClass: errorClass,
			errorElement: errorElement,
			highlight: function (element) {
				$(element).parent().removeClass('state-success').addClass("state-error");
				$(element).removeClass('valid');
			},
			unhighlight: function (element) {
				$(element).parent().removeClass("state-error").addClass('state-success');
				$(element).addClass('valid');
			},
			// Rules for form validation
			rules: {
			    email: {
			        required: true,
					email: true
                },
				password: {
					required: true
				}
			},
			// Messages for form validation
			messages: {
			    email: {
			        required: "{{ trans('Please enter your email') }}"
                },
                password: {
					required: "{{ trans('Please enter your password') }}"
				}
			},
			// Do not change code below
			errorPlacement: function (error, element) {
				error.insertAfter(element.parent());
			},
			submitHandler: function (form) {
				submit_form('#login-form', '#result')
			}

		});
	});
</script>
@endsection