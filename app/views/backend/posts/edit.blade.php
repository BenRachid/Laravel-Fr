@extends('backend/layouts/default')

{{-- Traduction Laravel-france --}}
{{--  Maj:6/06/2013 - backend/posts/edit.php --}}

{{-- Page title --}}
@section('title')
{{Lang::get('backend/posts/actions.edit.title')}} ::
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="page-header">
	<h3>
		{{Lang::get('backend/posts/actions.edit.description')}}

		<div class="pull-right">
			<a href="{{ route('posts') }}" class="btn btn-small btn-inverse"><i class="icon-circle-arrow-left icon-white"></i> {{Lang::get('buttons.back')}}</a>
		</div>
	</h3>
</div>

<!-- Tabs -->
<!--ul class="nav nav-tabs">
	<li class="active"><a href="#tab-general" data-toggle="tab">{{Lang::get('backend/general.tabs.general')}}</a></li>
	<li><a href="#tab-permissions" data-toggle="tab">{{Lang::get('backend/general.tabs.permissions')}}</a></li>
</ul-->

<form class="form-horizontal" method="post" action="" autocomplete="off" accept-charset="UTF-8" enctype="multipart/form-data">
	<!-- CSRF Token -->
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />

	<!-- Tabs Content -->
	<div class="tab-content">
		<!-- General tab -->
		<div class="tab-pane active" id="tab-general">
			<!-- user_id -->
			<div class="control-group {{ $errors->has('user_id') ? 'error' : '' }}">
				<label class="control-label" for="user_id">{{Lang::get('backend/posts/labels.user_id')}}</label>
				<div class="controls">
					<select class="form-control" type="dropdownmenu" name="user_id" id="user_id" value="{{ Input::old('user_id') }}" />
					  <?php 
					  foreach ($users as $key => $value) {
						echo "<option value=\""; echo $value['id'] ; echo "\">"; echo $value['email'];  echo " </option>";
					  }
					  ?>
					  <script type="text/javascript"> 
					  var optionlist = document.getElementById('user_id').options;
					  for (var option = 0; option < optionlist.length; option++ )
					  {
						if (optionlist[option].value == '<?php if (isset($post)) {echo $post->user_id; };?>')
						{
						  optionlist[option].selected = true;
						  break;
						}
					  }
					  </script> 
					  </select>
					{{ $errors->first('user_id', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
			<!-- title -->
			<div class="control-group {{ $errors->has('title') ? 'error' : '' }}">
				<label class="control-label" for="title">{{Lang::get('backend/posts/labels.title')}}</label>
				<div class="controls">
					<textarea type="text" name="title" id="title" value="{{ Input::old('title') }}"><?php if (isset($post)) {echo $post->title; };?> </textarea>
					{{ $errors->first('title', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
			<!-- slug -->
			<div class="control-group {{ $errors->has('slug') ? 'error' : '' }}">
				<label class="control-label" for="slug">{{Lang::get('backend/posts/labels.slug')}}</label>
				<div class="controls">
					<textarea type="text" name="slug" id="slug" value="{{ Input::old('slug') }}"><?php if (isset($post)) {echo $post->slug; };?> </textarea>
					{{ $errors->first('slug', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
			<!-- content -->
			<div class="control-group {{ $errors->has('content') ? 'error' : '' }}">
				<label class="control-label" for="content">{{Lang::get('backend/posts/labels.content')}}</label>
				<div class="controls">
					<textarea type="text" name="content" id="content" value="{{ Input::old('content') }}"><?php if (isset($post)) {echo $post->content; };?> </textarea>
					{{ $errors->first('content', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
			<!-- Photo -->
			<div class="control-group {{ $errors->has('Photo') ? 'error' : '' }}">
				<label class="control-label" for="Photo">{{Lang::get('backend/posts/labels.Photo')}}</label>
				<div class="controls">
					<input class="form-control" type="file" name="Photo" id="Photo" value="{{ Input::old('Photo') }}" />
					{{ $errors->first('Photo', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
			<!-- meta_title -->
			<div class="control-group {{ $errors->has('meta_title') ? 'error' : '' }}">
				<label class="control-label" for="meta_title">{{Lang::get('backend/posts/labels.meta_title')}}</label>
				<div class="controls">
					<textarea type="text" name="meta_title" id="meta_title" value="{{ Input::old('meta_title') }}"><?php if (isset($post)) {echo $post->meta_title; };?> </textarea>
					{{ $errors->first('meta_title', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
			<!-- meta_description -->
			<div class="control-group {{ $errors->has('meta_description') ? 'error' : '' }}">
				<label class="control-label" for="meta_description">{{Lang::get('backend/posts/labels.meta_description')}}</label>
				<div class="controls">
					<textarea type="text" name="meta_description" id="meta_description" value="{{ Input::old('meta_description') }}"><?php if (isset($post)) {echo $post->meta_description; };?> </textarea>
					{{ $errors->first('meta_description', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
			<!-- meta_keywords -->
			<div class="control-group {{ $errors->has('meta_keywords') ? 'error' : '' }}">
				<label class="control-label" for="meta_keywords">{{Lang::get('backend/posts/labels.meta_keywords')}}</label>
				<div class="controls">
					<textarea type="text" name="meta_keywords" id="meta_keywords" value="{{ Input::old('meta_keywords') }}"><?php if (isset($post)) {echo $post->meta_keywords; };?> </textarea>
					{{ $errors->first('meta_keywords', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
		</div>

	</div>

	<!-- Form Actions -->
	<div class="control-group">
		<div class="controls">
			<a class="btn btn-link" href="{{ route('posts') }}">{{Lang::get('buttons.cancel')}}</a>

			<button type="reset" class="btn">{{Lang::get('buttons.reset')}}</button>

			<button type="submit" class="btn btn-success">{{Lang::get('backend/posts/actions.buttons.edit')}}</button>
		</div>
	</div>
</form>
@stop
