@extends('layouts.master')

@section('content')
    <div id="main" role="main">
        <!-- RIBBON -->
        <div id="ribbon">
            <!-- breadcrumb -->
            <ol class="breadcrumb">
                <li>{{ trans('lang.dashboard') }}</li>
                <li>{{ trans('lang.job_candidates') }}</li>
            </ol>
            <!-- end breadcrumb -->
        </div>
        <!-- END RIBBON -->

        <!-- MAIN CONTENT -->
        <div id="content">
            <div class="row">
                <div class="col-xs-7 col-sm-5 col-lg-8">
                    <h1 class="page-title txt-color-blueDark">
                        <i class="fa fa-table fa-fw "></i>
                        {{ trans('lang.job_candidates') }}
                    </h1>
                </div>
            </div>

            <!-- widget grid -->
            <section id="widget-grid" class="">
                <!-- row -->
                <div class="row">
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
                                <span class="widget-icon"> <i class="fa fa-briefcase"></i> </span>
                                <h2>{{ trans('lang.candidates') }}</h2>
                            </header>
                            <!-- widget div-->
                            <div>
                                <!-- widget edit box -->
                                <div class="jarviswidget-editbox">
                                    <!-- This area used as dropdown edit box -->
                                </div>
                                <!-- end widget edit box -->
                                <!-- widget content -->
                                <div class="widget-body no-padding">
                                    <table id="datatable_fixed_column" class="table table-striped table-bordered" width="100%">
                                        <thead>
                                        <tr>
                                            <th class="hasinput" style="width:40px" />
                                                <input type="text" class="form-control" placeholder="ID" />
                                            </th>

                                            <th class="hasinput" >
                                                <input type="text" class="form-control" placeholder="{{ trans('lang.email') }}" />
                                            </th>

                                            <th class="hasinput" >
                                                <input type="text" class="form-control" placeholder="{{ trans('lang.first_name') }}" />
                                            </th>

                                            <th class="hasinput" >
                                                <input type="text" class="form-control" placeholder="{{ trans('lang.last_name') }}" />
                                            </th>

                                            <th class="hasinput" >
                                                <input type="text" class="form-control" placeholder="{{ trans('lang.job') }}" />
                                            </th>

                                            <th></th>
                                        </tr>
                                        
                                        <tr>
                                            <th data-class="expand" style="width:40px" >ID</th>
                                            <th data-class="expand">{{ trans('lang.email') }}</th>
                                            <th data-hide="phone,tablet" >{{ trans('lang.first_name') }}</th>
                                            <th data-hide="phone,tablet" >{{ trans('lang.last_name') }}</th>
                                            <th data-hide="phone,tablet" >{{ trans('lang.applied_to_this_job') }}</th>
                                            <th style="width:110px;">{{ trans('lang.action') }}</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                                <!-- end widget content -->
                            </div>
                            <!-- end widget div -->
                        </div>
                        <!-- end widget -->
                    </article>
                    <!-- WIDGET END -->
                </div>
                <!-- end row -->
            </section>
            <!-- end widget grid -->
        </div>
        <!-- END MAIN CONTENT -->
        {{--<div id="example">--}}
        {{--<my-component></my-component>--}}
        {{--</div>--}}
    </div>
@endsection



@section('custom_plugin')
    <!-- PAGE RELATED PLUGIN(S) -->
    <script src="js/plugin/datatables/jquery.dataTables.min.js"></script>
    <script src="js/plugin/datatables/dataTables.colVis.min.js"></script>
    <script src="js/plugin/datatables/dataTables.tableTools.min.js"></script>
    <script src="js/plugin/datatables/dataTables.bootstrap.min.js"></script>
    <script src="js/plugin/datatable-responsive/datatables.responsive.min.js"></script>
@endsection



@section('custom_script')
    <script>
        var otable;
        $(document).ready(function () {
            pageSetUp();
            pagenumbner = (localStorage.getItem('UsersList')) ? localStorage.getItem('UsersList') : 0;
            /* BASIC ;*/
            var responsiveHelper_dt_basic = undefined;
            var responsiveHelper_datatable_fixed_column = undefined;
            var responsiveHelper_datatable_col_reorder = undefined;
            var responsiveHelper_datatable_tabletools = undefined;
            var breakpointDefinition = {
                tablet: 1024,
                phone: 480
            };
            /* COLUMN FILTER  */
            otable = $('#datatable_fixed_column').DataTable({
                "ajax": {
                    url: 'candidates/datatable',
                    type: 'POST',
                    data: function (d) {
                        d.page = pagenumbner + 1;
                    }
                },
                "pageLength": 15,
                'displayStart': pagenumbner * 15,
                "processing": false,
                "serverSide": true,
                "bDestroy": true,
                columns: [
                    {data: 'user_id',    name: 'id'},
                    {data: 'email',      name: 'email'},
                    {data: 'first_name', name: 'first_name'},
                    {data: 'last_name',  name: 'last_name'},
                    {data: 'job_name',   name: 'job_name'},
                    {data: 'action',     name: 'action', orderable: false, searchable: false}
                ],
                "order": [[0, 'desc']],
                "sDom": "<'dt-toolbar'<'col-sm-6 col-xs-12 hidden-xs'<'toolbar'>>r>" +
                "t" +
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
                "autoWidth": true,
                "oLanguage": {
                    "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
                },
                "preDrawCallback": function () {
                    // Initialize the responsive datatables helper once.
                    if (!responsiveHelper_datatable_fixed_column) {
                        responsiveHelper_datatable_fixed_column = new ResponsiveDatatablesHelper($('#datatable_fixed_column'), breakpointDefinition);
                    }
                },
                "rowCallback": function (nRow, data) {
                    responsiveHelper_datatable_fixed_column.createExpandIcon(nRow);
                },
                "drawCallback": function (oSettings) {
                    responsiveHelper_datatable_fixed_column.respond();
                    $("[rel=tooltip]").tooltip();
                }
            });
            // Apply the filter
            $("#datatable_fixed_column thead th input[type=text]").on('keyup', function (e) {
                if (e.keyCode == 13) {
                    otable.column($(this).parent().index() + ':visible')
                        .search(this.value)
                        .draw();
                }
            });
            $("#datatable_fixed_column thead th select").on('change', function (e) {
                otable.column($(this).parent().parent().index() + ':visible')
                    .search(this.value)
                    .draw();
            });
            $('.datepicker').on('change', function () {
                otable.column($(this).parent().index() + ':visible')
                    .search(this.value)
                    .draw();
            });
            $('#datatable_fixed_column').on('page.dt', function () {
                localStorage.setItem('UsersList', otable.page.info().page);
            });
            /* END COLUMN FILTER */
            $(document).on('submit', '.remove-resource', function (e) {
                e.preventDefault();
                var form = $(this);
                $.SmartMessageBox({
                    title : '<i class="fa fa-trash"></i> {{ trans('Confirm removing') }}',
                    content : '{{ trans('Are you sure you want to remove this page?') }}',
                    buttons : '[{{ trans('Cancel') }}][{{ trans('OK') }}]'
                }, function(btn) {
                    if (btn === '{{ trans('OK') }}') {
                        $.ajax({
                            type: form.attr('method'),
                            url: form.attr('action'),
                            data: form.serialize(),
                            beforeSend: function(){
                                form.find('button').each(function(){
                                    $(this).data('actual-content', $(this).html());
                                    $(this).html('<i class="fa fa-refresh fa-spin"></i>');
                                    $(this).prop('disabled', true);
                                });
                            },
                            success: function(response){
                                otable.ajax.reload(function(){
                                    $.smallBox({
                                        title : '{{ trans('lang.success') }}',
                                        content : '<i class="fa fa-check"></i> <i>' + response + '</i>',
                                        color : '#659265',
                                        iconSmall : 'fa fa-check fa-2x fadeInRight animated',
                                        timeout : 4000
                                    });
                                    form.find('button').each(function(){
                                        $(this).prop('disabled', false);
                                        $(this).html($(this).data('actual-content'));
                                        $(this).removeData('actual-content');
                                    });
                                });
                            },
                            error: function(response){
                                $.smallBox({
                                    title : '{{ trans('lang.error') }}',
                                    content : '<i class="fa fa-times"></i> <i>' + response + '</i>',
                                    color : '#C46A69',
                                    iconSmall : 'fa fa-times fa-2x fadeInRight animated',
                                    timeout : 4000
                                });
                                form.find('button').each(function(){
                                    $(this).prop('disabled', false);
                                    $(this).html($(this).data('actual-content'));
                                    $(this).removeData('actual-content');
                                });
                            }
                        });
                    }
                });
            });
        });
        //added this line because the datepicke won't work in modal Create or Edit User
        var enforceModalFocusFn = $.fn.modal.Constructor.prototype.enforceFocus;
        $.fn.modal.Constructor.prototype.enforceFocus = function() {};
    </script>
@endsection
