{{ Form::label('file', 'Attach a file if required:') }} <a href="#" class="help">&nbsp;</a>
<div class="help-box">Maximum file size: {{ get_max_upload_size(true) }}mb. If you need to send a lot of files, please combine all files in a single zip file using archiving software such as <a href="http://www.7-zip.org/" target=_blank>7-zip</a> or <a href="http://www.rarlab.com/" target="_blank">WinRAR</a>. Alternatively, email your files to <a href="mailto:edt@fipra.com">edt@fipra.com</a> quoting your project details.</div>
<div class="formgroup">
	{{ Form::file('file[]') }}
</div>
{{ display_form_error('file', $errors) }}
{{ form::hidden('max_upload_size', get_max_upload_size(true), ['id' => 'max_upload_size']) }}