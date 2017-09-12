<style>
    .btn-group .btn-sm {
        padding: 6px 70px 5px;
    }
</style>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times;
    </button>
    <h4 class="modal-title" id="myModalLabel">{{ trans('lang.edit_profile') }}</h4>
</div>

<div id="result"></div>
<div class="modal-body no-padding">
    <form action="users/{{$user->id}}" id="update-user-form" method="post" class="smart-form">
        <input name="_method" type="hidden" value="PUT">
        <fieldset>

            <div class="row">
                <section class="col col-6">
                    <label class="label">{{ trans('lang.first_name') }}</label>
                    <label class="input"> <i class="icon-append fa fa-user"></i>
                        <input type="text" value="{{$user->first_name}}" name="first_name" placeholder="{{ trans('lang.first_name') }}">
                    </label>
                </section>


                <section class="col col-6">
                    <label class="label">{{ trans('lang.last_name') }}</label>
                    <label class="input"> <i class="icon-append fa fa-user"></i>
                        <input type="text" value="{{$user->last_name}}" name="last_name" placeholder="{{ trans('lang.last_name') }}">
                    </label>
                </section>
            </div>

            <div class="row">
                <section class="col col-lg-6">
                    <label class="label">{{ trans('lang.email') }}</label>
                    <label class="input"> <i class="icon-append fa fa-envelope-o"></i>
                        <input type="email" value="{{$user->email}}" name="email" placeholder="{{ trans('lang.email') }}" autocomplete="off">
                    </label>
                </section>

                <section class="col col-lg-6">
                    <label class="label">{{ trans('lang.username') }}</label>
                    <label class="input"> <i class="icon-append fa fa-user"></i>
                        <input type="text" value="{{$user->username}}" name="username" placeholder="{{ trans('lang.username') }}" autocomplete="off">
                    </label>
                </section>

            </div>

            <div class="row">
                <section class="col col-6">
                    <label class="label">{{ trans('lang.phone') }}</label>
                    <label class="input"> <i class="icon-append fa fa-phone"></i>
                        <input type="text" value="{{$user->phone}}" name="phone" placeholder="{{ trans('lang.phone') }}" autocomplete="off">
                    </label>
                </section>

                <section class="col col-6">
                    <label class="label">{{ trans('lang.phone_2') }}</label>
                    <label class="input"> <i class="icon-append fa fa-phone"></i>
                        <input type="text" value="{{$user->phone_2}}" name="phone_2" placeholder="{{ trans('lang.phone_2') }}" autocomplete="off">
                    </label>
                </section>
            </div>

            <div class="row">
                <section class="col col-6">
                    <label class="label">{{ trans('lang.number_matricola') }}</label>
                    <label class="input"> <i class="icon-append fa fa-info"></i>
                        <input type="text" value="{{$user->number_matricola}}" name="number_matricola" placeholder="{{ trans('lang.number_matricola') }}" autocomplete="off">
                    </label>
                </section>

                <section class="col col-6">
                    <label class="label">{{ trans('lang.role') }}</label>
                    <label class="select">
                        <select name="role">
                            <option value="">{{ trans('lang.chose_role') }}</option>
                             @foreach(\App\Models\Role::orderBy('id', 'desc')->get() as $role)
                                <option
                                    @if($user->roles()->first()->id == $role->id)
                                        selected
                                    @endif
                                    value="{{$role->id}}">
                                    {{$role->display_name}}
                                </option>
                       
                            @endforeach
                        </select>
                        <i></i>
                    </label>
                </section>

            </div>

        </fieldset>

        <fieldset>
            <div class="row">
                <section class="col col-6">
                    <label class="label">{{ trans('lang.password') }}</label>
                    <label class="input"> <i class="icon-append fa fa-lock"></i>
                        <input type="password" name="password" placeholder="{{ trans('lang.password') }}" id="password">
                        <b class="tooltip tooltip-bottom-right">{{ trans('lang.forgot_password_no') }}</b>
                    </label>
                </section>

                <section class="col col-6">
                    <label class="label">{{ trans('lang.confirm_password') }}</label>
                    <label class="input"> <i class="icon-append fa fa-lock"></i>
                        <input type="password" name="password_confirmation" placeholder="{{ trans('lang.confirm_password') }}">
                        <b class="tooltip tooltip-bottom-right">{{ trans('lang.forgot_password_no') }}</b>
                    </label>
                </section>
            </div>

        </fieldset>

        <footer>
            <button type="submit" class="btn btn-primary">
                {{ trans('lang.edit') }} {{ trans('lang.user') }}
            </button>
            <button type="button" class="btn btn-default" data-dismiss="modal">
                {{ trans('lang.cancel') }}
            </button>
        </footer>
    </form>

</div>


<!-- PAGE RELATED PLUGIN(S) -->
<script src="js/plugin/jquery_form/jquery.form.js"></script>
<script type="text/javascript">
    $(document).ready(function () {

        $(document).on('change', '.files', function () {
            $path = $(this).val();
            $(this).parent().parent().children().eq(0).val($path.replace(/^.*\\/, ""));
        });

        var errorClass = 'invalid';
        var errorElement = 'em';

        var $registerForm = $("#update-user-form").validate({
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
                ruol: {
                    required: false
                },
                phone: {
                    required: false,
                    number: true
                },
                phone_2: {
                    required: false,
                    number: true
                },
                number_matricola: {
                    required: false,
                    number: true
                },
                password: {
                    minlength: 4,
                    maxlength: 50
                },
                password_confirmation: {
                    minlength: 4,
                    maxlength: 50,
                    equalTo: '#password'
                }
            },
            // Messages for form validation
            messages: {
                first_name: {
                    required: "{{trans('lang.first_name_required')}}"
                },
                last_name: {
                    required: "{{trans('lang.last_name_required')}}"
                },
                password: {
                    required: "{{trans('lang.password').' '.trans('lang.required')}}"
                },
                password_confirmation: {
                    required: "{{trans('lang.confirm_password').' '.trans('lang.required')}}",
                    equalTo: "{{trans('lang.the_same').' '.trans('lang.required')}}"
                }
            },
            // Do not change code below
            errorPlacement: function (error, element) {
                error.insertAfter(element.parent());
            },
            submitHandler: function (form) {
                submit_form('#update-user-form', '#result')
            }
        });
    });

</script>