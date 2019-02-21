@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
				<div class="panel-heading">
					<span>Book: <strong>{{ $book->name }}</strong></span>
					<a class="btn btn-link" href="{{ route('books') }}" style="float: right !important; padding: 0px;">Back to books</a>
				</div>

                <div class="panel-body">
					<h3>Book Information</h3>
					<p><strong>Name: </strong>{{ $book->name }}</p>
					<p><strong>Author: </strong>{{ $book->author }}</p>
					<p><strong>Published Date: </strong>{{ $book->published_date }}</p>
					<hr>
					<div>
						<button type="button" class="btn btn-primary">Rent book</button>
						<button type="button" class="btn btn-success">Edit</button>
						<form action="{{ route('book.delete', ['book' => $book]) }}" method="post">
							<input class="btn btn-danger" type="submit" value="Delete" />
							{!! method_field('delete') !!}
							{!! csrf_field() !!}
						</form>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
