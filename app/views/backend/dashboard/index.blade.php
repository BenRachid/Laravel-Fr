@extends('backend/layouts/default')

{{-- Traduction Laravel-france --}}
{{--  Maj:8/06/2013 - backend/dashboard/index.php --}}

{{-- Page title --}}
@section('title')
{{Lang::get('backend/dashboard/actions.index.title')}}
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="page-header">
	<h3>
		Les cinq derniers commentaires 
	</h3>
		<table class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th class="span1">{{Lang::get('backend/posts/table.user_id')}}</th>
					<th class="span1">{{Lang::get('backend/posts/table.content')}}</th>
				</tr>
			</thead>
			<tbody>
				@if ($comments->count() >= 1)
				@foreach ($comments as $comment)
				<tr>
				<td>{{$comment->user_id}}</td> <!-- -->
				<td>{{$comment->content}}</td>
				</tr>
				@endforeach
				@else
				<tr>
					<td colspan="5">{{Lang::get('backend/posts/table.no-results')}}</td>
				</tr>
				@endif
			</tbody>
		</table>
</div>
@stop


