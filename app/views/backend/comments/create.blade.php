@extends('backend/layouts/default')

{{-- Traduction Laravel-france --}}
{{--  Maj:6/06/2013 - backend/comments/edit.php --}}

{{-- Page title --}}
@section('title')
{{Lang::get('backend/comments/actions.create.title')}} ::
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="page-header">
	<h3>
		{{Lang::get('backend/comments/actions.create.description')}}

		<div class="pull-right">
			<a href="{{ route('comments') }}" class="btn btn-small btn-inverse"><i class="icon-circle-arrow-left icon-white"></i> {{Lang::get('buttons.back')}}</a>
		</div>
	</h3>
</div>

<!-- Tabs -->
<!--ul class="nav nav-tabs">
	<li class="active"><a href="#tab-general" data-toggle="tab">{{Lang::get('backend/general.tabs.general')}}</a></li>
	<li><a href="#tab-permissions" data-toggle="tab">{{Lang::get('backend/general.tabs.permissions')}}</a></li>
</ul-->

<form class="form-horizontal" method="post" action="" autocomplete="off">
	<!-- CSRF Token -->
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />

	<!-- Tabs Content -->
	<div class="tab-content">
		<!-- General tab -->
		<div class="tab-pane active" id="tab-general">
			<!-- parent_id -->
			<div class="control-group {{ $errors->has('parent_id') ? 'error' : '' }}">
				<label class="control-label" for="parent_id">{{Lang::get('backend/comments/labels.parent_id')}}</label>
				<div class="controls">
					<select class="form-control" type="dropdownmenu" name="parent_id" id="parent_id" value="{{ Input::old('parent_id') }}" />
					<option value="0">Racine</option>
					  <?php 
					  foreach ($comments as $key => $value) {
						echo "<option value=\""; echo $value['id'] ; echo "\">"; echo $value['id'];  echo " </option>";
					  }
					  ?>
					</select>
					{{ $errors->first('parent_id', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
			<!-- post_id -->
			<div class="control-group {{ $errors->has('post_id') ? 'error' : '' }}">
				<label class="control-label" for="post_id">{{Lang::get('backend/comments/labels.post_id')}}</label>
				<div class="controls">
					<select class="form-control" type="dropdownmenu" name="post_id" id="post_id" value="{{ Input::old('post_id') }}" />
					  <?php 
					  foreach ($posts as $key => $value) {
						echo "<option value=\""; echo $value['id'] ; echo "\">"; echo $value['title'];  echo " </option>";
					  }
					  ?>
					</select>
					{{ $errors->first('post_id', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
			<!-- user_id -->
			<div class="control-group {{ $errors->has('user_id') ? 'error' : '' }}">
				<label class="control-label" for="user_id">{{Lang::get('backend/comments/labels.user_id')}}</label>
				<div class="controls">
					<select class="form-control" type="dropdownmenu" name="user_id" id="user_id" value="{{ Input::old('user_id') }}" />
					  <?php 
					  foreach ($users as $key => $value) {
						echo "<option value=\""; echo $value['id'] ; echo "\">"; echo $value['email'];  echo " </option>";
					  }
					  ?>
					  </select>
					{{ $errors->first('user_id', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
			<!-- content -->
			<div class="control-group {{ $errors->has('content') ? 'error' : '' }}">
				<label class="control-label" for="content">{{Lang::get('backend/comments/labels.content')}}</label>
				<div class="controls">
					<textarea type="text" name="content" id="content" value="{{ Input::old('content') }}"> </textarea>
					{{ $errors->first('content', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
			
			
		</div>

	</div>

	<!-- Form Actions -->
	<div class="control-group">
		<div class="controls">
			<a class="btn btn-link" href="{{ route('comments') }}">{{Lang::get('buttons.cancel')}}</a>

			<button type="reset" class="btn">{{Lang::get('buttons.reset')}}</button>

			<button type="submit" class="btn btn-success">{{Lang::get('backend/comments/actions.buttons.create')}}</button>
		</div>
	</div>
</form>
@stop
