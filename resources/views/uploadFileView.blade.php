@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="card">
				<div class="card-header">Upload file Example</div>
				
				<div class="card-body">
					@if($message= Session::get('success'))
						<div class="alert alert-success alert-block">
							<button type="button" class="close" data-dismiss="alert">X</button>
							
							<strong>{{ $message }}</strong>
					</div>
					@endif
					
					@if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
					
					<form action="/uploadFilePost" method="post" enctype="multipart/form-data"> <!--here action="" 'name' and web.php file Route::post url name must be given same -->
						@csrf
						<div class="form-group">
							<input type="file" class="form-controll-file" name="fileToUploadName" id="exampleInputFile" aria-describedy="fileHelp" />
							<small class="form-text text-muted" id="fileHelp">Please, upload a valid file. Size should not be 2 MB</small>
							
						</div>
						<button class="btn btn-primary" type="submit">submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>	<!--end container-->


@endsection