
<script>
    document.addEventListener("DOMContentLoaded", function() {
        filewidget.filelist('{{ $module_name }}', '{{ $fileable_id }}','{{ $morph_id }}', '.files-{{ $module_name }}-{{ $fileable_id }}-{{ $morph_id }}', '{{ $num }}', {{ $disable_upload?1:0 }});
    });
</script>
@if (!$disable_upload)
<form action="{{ url('uploader/start/') }}" method="post" id="upload_start" >
    <input type="hidden" name="module_name" value="{{ $module_name }}" />
    <input type="hidden" name="fileable_id" value="{{ $fileable_id }}" />
    <input type="hidden" name="morph_id" value="{{ $morph_id }}" />
    <input type="hidden" name="num" value="{{ $num }}" />
    <input type="hidden" name="upath" value="{{ $path }}" />
    <input class="select_file button_{{ $module_name }}_{{ $fileable_id }}_{{ $morph_id }} hidden" type="file" name="upload_file" />
</form>

@endif

<div class="files-{{ $module_name }}-{{ $fileable_id }}-{{ $morph_id }}"></div>
