@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
			@if (session('message'))
				<div class="alert alert-info">{{ session('message') }}</div>
			@endif
            <div class="panel panel-default">
				<div class="panel-heading">
					<span>Book: <strong>{{ $book->name }}</strong></span>
					<span class="pull-right">
						<a class="btn btn-link" href="{{ route('books') }}" style="padding: 0px;">Back to books</a>
					</span>
				</div>

                <div class="panel-body">
					<h3>Book Information</h3>
					<p><strong>Name: </strong>{{ $book->name }}</p>
					<p><strong>Author: </strong>{{ $book->author }}</p>
					<p><strong>Published Date: </strong>{{ $book->published_date }}</p>
					<p><strong>Category: </strong>{{ $book->category->name }}</p>
					<hr>
					<div>
						@if ($book->user_id)
							@if ($book->user_id === Auth::user()->id)
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#bookStatusModal">
									Return book
								</button>
								@include('layouts.modal', ['book' => $book, 'action' => 'return'])
							@else
								Not available for rent
							@endif
						@else
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#bookStatusModal">
								Rent book
							</button>
							@include('layouts.modal', ['book' => $book, 'action' => 'rent'])
						@endif
						@if (!$book->user_id || ($book->user_id && $book->user_id === Auth::user()->id))	
							<a href="{{ route('book.edit', ['book' => $book]) }}" class="btn btn-success">Edit</a>
							<span class="pull-right">
								<form action="{{ route('book.delete', ['book' => $book]) }}" method="post">
									<input class="btn btn-danger" type="submit" value="Delete" />
									{!! method_field('delete') !!}
									{!! csrf_field() !!}
								</form>
							</span>
						@endif
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
