<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times;
    </button>
    <h4 class="modal-title" id="myModalLabel">{{ trans('Add new category') }}</h4>
</div>

<div id="result"></div>

<div class="modal-body no-padding">

    <form action="categories" id="add-category-form" method="post" class="smart-form">
        <fieldset>
            <div class="row">
                <section class="col col-md-12">
                    <label class="input"> <i class="icon-append fa fa-cog"></i>
                        <input type="text" name="name" placeholder="{{ trans('lang.name') }}" autocomplete="off">
                    </label>
                </section>
            </div>
        </fieldset>

        <footer>
            <button type="submit" class="btn btn-primary">
                {{ trans('Add') }} {{ trans('Category') }}
            </button>

            <button type="button" class="btn btn-default" data-dismiss="modal">
                {{ trans('Cancel') }}
            </button>
        </footer>
    </form>
</div>


<!-- PAGE RELATED PLUGIN(S) -->
<script src="/js/plugin/jquery_form/jquery.form.js"></script>

<script>
    var errorClass = 'invalid';
    var errorElement = 'em';

    var $registerForm = $("#add-category-form").validate({
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
            name: {
                required: true
            }
        },
        // Messages for form validation
        messages: {
            name: {
                required: "{{trans('Name required')}}"
            }
        },
        // Do not change code below
        errorPlacement: function (error, element) {
            error.insertAfter(element.parent());
        },
        submitHandler: function (form) {
            submit_form('#add-category-form', '#result')
        }
    });
</script>