@extends('layouts.app')

@section('content')
<style type="text/css">
    .candidate { display:none; }
</style>

<div id="main" role="main">

    <!-- MAIN CONTENT -->
    <div id="content" class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>
                    <div class="panel-body">
                        <div id="result"></div>
                        <!--form  id="login-form" class="smart-form client-form" method="post" action="login"-->
                        <form id="register-form" class="smart-form client-form" method="POST" action="/register">
                            {{ csrf_field() }}

                            <section>
                                <label class="label">{{ trans('First name') }}</label>
                                <label class="input {{ $errors->has('first_name') ? ' has-error' : '' }}">
                                    <i class="icon-append fa fa-user"></i>
                                    <input type="text" name="first_name" value="{{ old('first_name') }}">
                                    <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Please enter first name</b>
                                </label>
                            </section>

                            <section>
                                <label class="label">{{ trans('Last name') }}</label>
                                <label class="input {{ $errors->has('last_name') ? ' has-error' : '' }}"> 
                                    <i class="icon-append fa fa-user"></i>
                                    <input type="text" name="last_name" value="{{ old('last_name') }}">
                                    <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Please enter last name</b>
                                </label>
                            </section>

                            <section>
                                <label class="label">{{ trans('lang.e_mail') }}</label>
                                <label class="input {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <i class="icon-append fa fa-envelope"></i>
                                    <input type="email" name="email" value="{{ old('email') }}">
                                    <b class="tooltip tooltip-top-right"><i class="fa fa-envelope txt-color-teal"></i> Please enter email address</b>
                                </label>
                            </section>

                            <section>
                                <label class="label">{{ trans('lang.address') }}</label>
                                <label class="input {{ $errors->has('address') ? ' has-error' : '' }}">
                                    <i class="icon-append fa fa-map-marker"></i>
                                    <input type="text" name="address" value="{{ old('address') }}">
                                    <b class="tooltip tooltip-top-right"><i class="fa fa-map-marker txt-color-teal"></i> Please enter your address</b>
                                </label>
                            </section>

                            <section>
                                <label class="label">{{ trans('lang.phone') }}</label>
                                <label class="input {{ $errors->has('phone') ? ' has-error' : '' }}">
                                    <i class="icon-append fa fa-phone"></i>
                                    <input type="text" name="phone" value="{{ old('phone') }}">
                                    <b class="tooltip tooltip-top-right"><i class="fa fa-phone txt-color-teal"></i> Please enter your phone number</b>
                                </label>
                            </section>

                            <section>
                                <label class="label">{{ trans('lang.password') }}</label>
                                <label class="input {{ $errors->has('password') ? ' has-error' : '' }}">
                                    <i class="icon-append fa fa-key"></i>
                                    <input type="password" name="password" id="password">
                                    <b class="tooltip tooltip-top-right"><i class="fa fa-key txt-color-teal"></i> Please enter your password</b>
                                </label>
                            </section>

                            <section>
                                <label class="label">{{ trans('lang.password_confirmation') }}</label>
                                <label class="input {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                    <i class="icon-append fa fa-key"></i>
                                    <input type="password" name="password_confirmation">
                                    <b class="tooltip tooltip-top-right"><i class="fa fa-key txt-color-teal"></i> Please confirm password</b>
                                </label>
                            </section>

                            <section>
                                <label class="label">{{ trans('lang.role') }}</label>
                                <label class="input {{ $errors->has('address') ? ' has-error' : '' }}">
                                    <select name="role" id="role" class="form-control">
                                        <option value=""> </option>
                                        @foreach(\App\Models\Role::orderBy('id', 'desc')->get() as $role)
                                            <option value="{{$role->id}}"
                                            {{ $role->id == old('role') ? "selected" : "" }}
                                            >{{ $role->display_name }}</option>
                                        @endforeach
                                    </select>
                                    <i></i>
                                </label>
                            </section>

                            <section class="candidate">
                                <label class="label">{{ trans('Wanted salary') }}</label>
                                <label class="input {{ $errors->has('wanted_salary') ? ' has-error' : '' }}"> 
                                    <i class="icon-append fa fa-money"></i>
                                    <input type="text" name="wanted_salary" value="{{ old('wanted_salary') }}">
                                    <b class="tooltip tooltip-top-right"><i class="fa fa-money txt-color-teal"></i> Please enter wanted salary</b>
                                </label>
                            </section>

                            <section class="candidate">
                                <label class="label">{{ trans('Experience') }}</label>
                                <label class="input {{ $errors->has('experience') ? ' has-error' : '' }}"> 
                                    <i class="icon-append fa fa-line-chart"></i>
                                    <input type="text" name="experience" value="{{ old('experience') }}">
                                    <b class="tooltip tooltip-top-right"><i class="fa fa-line-chart txt-color-teal"></i> Please enter your experience</b>
                                </label>
                            </section>

                            <section class="candidate">
                                <label class="label">{{ trans('Skills description') }}</label>
                                <label class="input {{ $errors->has('skills_description') ? ' has-error' : '' }}"> 
                                    <i class="icon-append fa fa-money"></i>
                                    <textarea name="skills_description" rows="3" cols="72" >{{ old('skills_description') }}</textarea>
                                    <b class="tooltip tooltip-top-right"><i class="fa fa-font txt-color-teal"></i> Please enter your skills</b>
                                </label>
                            </section>

                            <footer>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> {{ trans('lang.register') }}
                                </button>

                                <a href="/login" class="btn btn-default">
                                    <i class="fa fa-btn fa-times"></i>
                                    {{ trans('Cancel') }}
                                </a>
                            </footer>
    
                        </form>
                    </div>
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
        $("#register-form").validate({
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
                first_name: {
                    required: true
                },
                last_name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                address: {
                    required: true
                },
                phone: {
                    required: true
                },
                password: {
                    required: true,
                    minlength: 6,
                },
                password_confirmation: {
                    required: true,
                    minlength: 6,
                    equalTo: "#password"
                },
                role: {
                    required: true
                },
            },
            // Messages for form validation
            messages: {
                first_name: {
                    required: "{{ trans('Please enter your first name') }}"
                },
                last_name: {
                    required: "{{ trans('Please enter your last name') }}"
                },
                email: {
                    required: "{{ trans('Please enter your email') }}"
                },
                address: {
                    required: "{{ trans('Please enter your address') }}"
                },
                phone: {
                    required: "{{ trans('Please enter your phone number') }}"
                },
                password: {
                    required: "{{ trans('Please enter your password') }}"
                },
                password_confirmation: {
                    required: "{{ trans('Please confirm your password') }}"
                },
                role: {
                    required: "{{ trans('Please confirm your role') }}"
                },
            },
            // Do not change code below
            errorPlacement: function (error, element) {
                error.insertAfter(element.parent());
            },
            submitHandler: function (form) {
                submit_form('#register-form', '#result')
            }
        });

        // select role 
        $(document.body).on('change', "#role", function (e) {

            var optVal = $("#role option:selected").val();
            
            if (optVal == 2) {
                $(".candidate").show();
            }

            if (optVal == 1) {
                $(".candidate").hide();
            }
            
        });
    });
</script>
@endsection