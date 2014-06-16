@extends('backend/layouts/default')

{{-- Traduction Laravel-france --}}
{{--  Maj:6/06/2013 - backend/comments/index.php --}}

{{-- Page title --}}
@section('title')
{{Lang::get('backend/comments/actions.index.title')}} ::
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="page-header">
	<h3>
		{{Lang::get('backend/comments/actions.index.description')}}

		<div class="pull-right">
			<a href="{{ route('create/comments') }}" class="btn btn-small btn-info"><i class="icon-plus-sign icon-white"></i> {{Lang::get('backend/comments/actions.buttons.create')}}</a>
		</div>
	</h3>
</div>

<!-- $comments->links() -->

<table class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
			<th class="span1">{{Lang::get('backend/comments/table.id')}}</th>
			<th class="span1">{{Lang::get('backend/comments/table.parent_id')}}</th>
			<th class="span2">{{Lang::get('backend/comments/table.post_id')}}</th>
			<th class="span2">{{Lang::get('backend/comments/table.user_id')}}</th>
			<th class="span2">{{Lang::get('backend/comments/table.content')}}</th>
			<th class="span2">{{Lang::get('backend/comments/table.created_at')}}</th>
			<th class="span2">{{Lang::get('backend/comments/table.updated_at')}}</th>
			<th class="span2">Actions</th>
		</tr>
	</thead>
	<tbody>
		@if ($comments->count() >= 1)
		@foreach ($comments as $comment)
		<tr>
			<td>{{ $comment->id }}</td>
			<td>{{ $comment->parent_id }}</td>
			<td>{{ $comment->post_id }}</td>
			<td>{{ $comment->user_id }}</td>
			<td>{{ $comment->content }}</td>
			<td>{{ $comment->created_at->diffForHumans() }}</td>
			<td>{{ $comment->updated_at->diffForHumans() }}</td>
			<td>
				<a href="{{ route('update/comments', $comment->id) }}" class="btn btn-mini">{{Lang::get('buttons.edit')}}</a>
				<a href="{{ route('delete/comment', $comment->id) }}" class="btn btn-mini btn-danger">{{Lang::get('buttons.delete')}}</a>
			</td>
		</tr>
		@endforeach
		@else
		<tr>
			<td colspan="5">{{Lang::get('backend/comments/table.no-results')}}</td>
		</tr>
		@endif
	</tbody>
</table>

<!-- $comments->links()-->
@stop
