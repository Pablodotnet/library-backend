@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
			@if (session('message'))
				<div class="alert alert-info">{{ session('message') }}</div>
			@endif
			@if (isset($message))
				<div class="alert alert-info">{{ $message }}</div>
			@endif
            <div class="panel panel-default">
                <div class="panel-heading">
					Books
					<span class="pull-right">
						<a class="btn btn-link no-padding" href="{{ route('home') }}">Back to home</a>
					</span>
				</div>

                <div class="panel-body">
					Select category to filter list:
					<form action="{{ route('books.index') }}" method="GET">
						<select class="form-control autocomplete-select" name="category">
							@foreach($categories as $category)
								<option>{{ $category->name }}</option>
							@endforeach
						</select>
						<br /><br />
						<button type="submit" class="btn btn-success">Filter</button>
						<a class="btn btn-warning" href="{{ route('books.index') }}">
							Reset
						</a>
					</form>
					<hr>
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>id</th>
								<th>Name</th>
								<th>Author</th>
								<th>Category</th>
								<th>Available</th>
							</tr>
						</thead>
						<tbody>
								@forelse($books as $book)
								<tr>
									<td>{{$book->id}}</td>
									<td>
										<a href="{{ route('books.show', ['book' => $book]) }}">
											{{ $book->name }}
										</a>
									</td>
									<td>{{$book->author}}</td>
									<td>{{$book->category->name}}</td>
									<td>
										@if ($book->user_id)
											Rented
										@else
											Available
										@endif
									</td>
								</tr>
								@empty
									<span>No books found</span>
								@endforelse
						</tbody>
					</table>
					<div class="text-center">
						{{ $books->links() }}
					</div>
					<div class="pull-right">
						<a href="{{ route('books.create') }}" class="btn btn-success">Create New Book</a>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
