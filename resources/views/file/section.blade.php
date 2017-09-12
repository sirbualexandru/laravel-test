@if(isset($files))
    @foreach($files as $key => $module)
        <article class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-{{$module['name']}}-{{$key }}" data-widget-editbutton="false"
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
                    <h2>{{ $module['title'] }}</h2>
                </header>
                <div>
                    <div class="jarviswidget-editbox"></div>
                    <div class="widget-body no-padding">
                        <div class="smart-form">

                            <fieldset style="padding-bottom: 25px">
                                <div class="row">
                                    <div class="col col-md-12 file-upload-form">

                                        @include('file.widget',[
                                            'module_name'   => $module['name'],
                                            'fileable_id'   => $id,
                                            'morph_id'      => $morph->id,
                                            'num'           => $module['max'],
                                            'path'          => $upload_path,
                                            'disable_upload'=> (isset($disable_upload))?$disable_upload:false
                                        ])
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    @endforeach
@endif