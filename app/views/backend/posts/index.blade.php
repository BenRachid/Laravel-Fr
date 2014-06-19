@extends('backend/layouts/default')

{{-- Traduction Laravel-france --}}
{{--  Maj:6/06/2013 - backend/posts/index.php --}}

{{-- Page title --}}
@section('title')
{{Lang::get('backend/posts/actions.index.title')}} ::
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="page-header">
	<h3>
		{{Lang::get('backend/posts/actions.index.description')}}

		<div class="pull-right">
			<a href="{{ route('create/posts') }}" class="btn btn-small btn-info"><i class="icon-plus-sign icon-white"></i> {{Lang::get('backend/posts/actions.buttons.create')}}</a>
		</div>
	</h3>
</div>

<!-- $posts->links() -->

<table class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
			<th class="span1">{{Lang::get('backend/posts/table.id')}}</th>
			<th class="span1">{{Lang::get('backend/posts/table.user_id')}}</th>
			<th class="span1">{{Lang::get('backend/posts/table.title')}}</th>
			<th class="span1">{{Lang::get('backend/posts/table.slug')}}</th>
			<th class="span1">{{Lang::get('backend/posts/table.content')}}</th>
			<th class="span1">{{Lang::get('backend/posts/table.Photo')}}</th>
			<th class="span1">{{Lang::get('backend/posts/table.meta_title')}}</th>
			<th class="span1">{{Lang::get('backend/posts/table.meta_description')}}</th>
			<th class="span1">{{Lang::get('backend/posts/table.meta_keywords')}}</th>
			<th class="span1">{{Lang::get('backend/posts/table.created_at')}}</th>
			<th class="span1">{{Lang::get('backend/posts/table.updated_at')}}</th>
			<th class="span1">Actions</th>
		</tr>
	</thead>
	<tbody>
		@if ($posts->count() >= 1)
		@foreach ($posts as $post)
		<?php $small =substr($post->content, 0, 100);
				$smallPhoto =substr($post->Photo, 0, 20); ?>
		<tr>
			<td>{{ $post->id }}</td>
			<td>{{ $post->user_id }}</td>
			<td>{{ $post->title }}</td>
			<td>{{ $post->slug }}</td>
			<td>{{ $small}}</td>
			<td>{{ $smallPhoto }}</td>
			<td>{{ $post->meta_title }}</td>
			<td>{{ $post->meta_description }}</td>
			<td>{{ $post->meta_keywords }}</td>
			<td>{{ $post->created_at->diffForHumans() }}</td>
			<td>{{ $post->updated_at->diffForHumans() }}</td>
			<td>
				<a href="{{ route('update/posts', $post->id) }}" class="btn btn-mini">{{Lang::get('buttons.edit')}}</a>
				<a href="{{ route('delete/post', $post->id) }}" class="btn btn-mini btn-danger">{{Lang::get('buttons.delete')}}</a>
			</td>
		</tr>
		@endforeach
		@else
		<tr>
			<td colspan="5">{{Lang::get('backend/posts/table.no-results')}}</td>
		</tr>
		@endif
	</tbody>
</table>

<!-- $posts->links()-->
@stop
