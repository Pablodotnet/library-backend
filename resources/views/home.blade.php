@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
					@endif
					
                    You are logged in!
					<h1>{{ Auth::user()->name }}</h1>

					Now you can get some books
					<hr>
					<a class="btn btn-link" href="{{ route('books.index') }}">Books</a>
					<hr>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
