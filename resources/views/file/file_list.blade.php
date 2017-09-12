@if((count($files) < $num || $num == 0) && !$disable_upload )
    <button type="button" class="click-trigger btn btn-primary btn-file" style="padding: 6.5px;display: block"
            data-for=".button_{{ $module_name}}_{{ $fileable_id}}_{{ $morph_id}}"><i
                class="glyphicon glyphicon-upload"></i> {{ trans('lang.select-file')}}</button>
@endif
<div id="upload-files-{{ $module_name }}" class="files-list">
    <img src="img/ajax-loader_1.gif" style="display: none" class="preloader"/>

    @if(count($files))
        @foreach($files as $file)
            <div class="file-preview-frame" fileid="{{ $file->id }}">
                @if($file->type == 'image')
                    <img src="/{{ $file->path }}" class="file-preview-image" title="{{ $file->name }}" alt="{{ $file->name }}" >
                @else
                    <i class="glyphicon glyphicon-paperclip"></i>
                @endif
                <div class="file-thumbnail-footer">
                    <div class="file-footer-caption" title="{{ $file->name }}">{{ $file->name }}</div>
                </div>
                @if ( !$disable_upload )
                    <div class="file-actions">
                        <span class="btn btn-primary btn-xs handle_{{ $module_name }}">
                          <i class="fa fa-arrows" aria-hidden="true"></i>
                        </span>
                        <div class="file-footer-buttons">
                            <a class=" btn btn-xs btn-default delete_file" title="Remove file"
                               data-id="{{ $file->id}}"
                               data-module_name="{{ $file->module_name}}"
                               data-fileable_id="{{ $file->fileable_id}}"
                               data-fileable_type="{{ $file->fileable_type}}"
                               data-morph_id="{{ $file->morph->id}}"
                               data-update=".files-{{ $module_name}}-{{ $fileable_id}}-{{ $morph_id}}">
                                <i class="glyphicon glyphicon-trash text-danger"></i>
                            </a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                @endif
            </div>
        @endforeach
    @endif
</div>