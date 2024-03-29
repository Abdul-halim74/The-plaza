@extends('layouts.app');

@section('content')

	<div class="container">
		@if(session()->has('status'))
			<p class="alert alert-info">
			{{session()->get('status')}}
			</p>
		@endif	
		
		<div class="col-sm-6 col-sm-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					Add user
				</div>
				<div class="panel-body">
					{{Form::model($user, ['url' =>route('users.update', $user->id), 'method' =>'PUT'])}}	{{--users.update means Route controller method name--}}
						@include('users._form')
					{{Form::close()}}
				</div>
			</div>
		</div>
	</div>

@endsection