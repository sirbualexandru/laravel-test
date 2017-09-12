@extends('layouts.master')

@section('content')
    <div id="main" role="main">
        <!-- RIBBON -->
        <div id="ribbon">
            <!-- breadcrumb -->
            <ol class="breadcrumb">
                <li>
                    <a href="/jobs">
                        <i class="fa fa-suitcase"></i>
                        {{ trans('Job') }}
                    </a>
                </li>
                <li>
                    <b>
                        <i class="fa fa-pencil"></i>
                        {{ trans('Edit') }}
                    </b>
                </li>
            </ol>
        </div>

        <div id="content">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-left">
                    <a class="btn btn-labeled btn-primary" href="/jobs">
                        <span class="btn-label"><i class="fa fa-chevron-left"></i></span>
                        {{ trans('Back') }}
                    </a>
                </div>
            </div>
            <br />

            <!-- widget grid -->
            <section id="widget-grid" class="">
                <!-- row -->
                <div class="row">
                    <form action="/jobs/{{$page->id}}/update" id="edit-page-form" method="post">
                        <!-- NEW WIDGET START -->
                        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <!-- Widget ID (each widget will need unique ID)-->
                            <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-1" data-widget-editbutton="false"
                                 data-widget-colorbutton="false"
                                 data-widget-togglebutton="false"
                                 data-widget-deletebutton="false"
                                 data-widget-fullscreenbutton="false"
                                 data-widget-custombutton="false"
                                 data-widget-collapsed="false"
                                 data-widget-sortable="false"
                            >
                                <header>
                                    <span class="widget-icon"> <i style="margin-top: 10px;" class="fa fa-suitcase"></i> </span>
                                    <h2>{{ trans('Edit page') }}</h2>
                                </header>

                                <div>
                                    <div class="jarviswidget-editbox"></div>
                                    <div class="widget-body no-padding">
                                        <div id="result"></div>

                                        <div class="smart-form">
                                            <fieldset>
                                                <div class="row">

                                                    <section class="col col-md-6">
                                                        <label class="label">{{ trans('lang.name') }}</label>
                                                        <label class="input">
                                                            <i class="icon-append fa fa-font"></i>
                                                            <input type="text" name="name" placeholder="{{ trans('lang.name') }}" value="{{ $page->name }}">
                                                        </label>
                                                    </section>

                                                    <section class="col col-md-6">
                                                        <label class="label">{{ trans('lang.categories') }}</label>
                                                        <label class="select">
                                                            <select name="category_id">
                                                                <option value="">{{ trans('Select category') }}</option>
                                                                @foreach(\App\Models\Category::all() as $category)
                                                                    <option value="{{$category->id}}" {{ $category->id === $page->category_id ? "selected" : "" }} >{{$category->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            <i></i>
                                                        </label>
                                                    </section>

                                                </div>

                                                <div class="row">
                                                    <section class="col col-md-6">
                                                        <label class="label">{{ trans('lang.experience') }}</label>
                                                        <label class="input">
                                                            <i class="icon-append fa fa-line-chart"></i>
                                                            <input type="text" name="experience" placeholder="{{ trans('lang.experience') }}"  value="{{ $page->experience }}"/>
                                                        </label>
                                                    </section>

                                                    <section class="col col-md-6">
                                                        <label class="label">{{ trans('lang.salary') }}</label>
                                                        <label class="input">
                                                            <i class="icon-append fa fa-money"></i>
                                                            <input type="text" name="salary" placeholder="{{ trans('lang.salary') }}" value="{{ $page->salary }}" />
                                                        </label>
                                                    </section>
                                                </div>

                                                <div class="row">
                                                    <section class="col col-md-12">
                                                        <label class="label">{{ trans('lang.description') }}</label>
                                                        <label class="input">
                                                            <i class="icon-append fa fa-bars"></i>
                                                            <textarea name="description" class="form-control" style="min-height:50px; padding:10px; padding-right:40px; box-sizing:border-box;">{{ $page->description }}</textarea>
                                                        </label>
                                                    </section>
                                                </div>
                                            </fieldset>

                                            <footer>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fa fa-check"></i>
                                                    {{ trans('Update') }}
                                                </button>

                                                <a href="/jobs" class="btn btn-default">
                                                    {{ trans('Cancel') }}
                                                </a>
                                            </footer>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </form>
                </div>
            </section>

        </div>
    </div>
@endsection

@section('custom_plugin')
    <script src="/js/plugin/jquery_form/jquery.form.js"></script>
@endsection

@section('custom_script')
    <script>
        $(document).ready(function () {

            var errorClass      = 'invalid';
            var errorElement    = 'em';
            var $registerForm   = $("#edit-page-form").validate({
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
                    },
                    category_id: {
                        required: true
                    },
                    experience: {
                        required: true,
                    },
                    salary: {
                        required: true,
                    },
                    description: {
                        required: true,
                    }
                },
                // Messages for form validation
                messages: {
                    name: {
                        required: "{{trans('Name required')}}"
                    },
                    category_id: {
                        required: "{{ trans('Category required') }}"
                    },
                    experience: {
                        required: "{{trans('Experience required')}}"
                    },
                    salary: {
                        required: "{{trans('Salary required')}}"
                    },
                    description: {
                        required: "{{trans('Description required')}}"
                    }
                },
                // Do not change code below
                errorPlacement: function (error, element) {
                    error.insertAfter(element.parent());
                },
                submitHandler: function (form) {
                    submit_form('#edit-page-form', '#result')
                }
            });


            
        });


    </script>
@endsection
