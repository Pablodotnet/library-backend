@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
					Books
					<a class="btn btn-link" href="{{ route('home') }}" style="float: right !important; padding: 0px;">Back to home</a>
				</div>

                <div class="panel-body">
					{{-- <ul>
						@foreach ($books as $book)
							<li>
								<a class="btn btn-link" href="{{ route('book', ['book' => $book]) }}">
									{{ $book->name }}
								</a>
							</li>
						@endforeach
					</ul> --}}
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>id</th>
								<th>Name</th>
								<th>Author</th>
								<th>Available</th>
							</tr>
						</thead>
						<tbody>
								@foreach($books as $book)
								<tr>
									<td>{{$book->id}}</td>
									<td>
										<a href="{{ route('book', ['book' => $book]) }}">
											{{ $book->name }}
										</a>
									</td>
									<td>{{$book->author}}</td>
									<td>
										@if ($book->user_id)
											Unavailable
										@else
											Available
										@endif
									</td>
								</tr>
								@endforeach
						</tbody>
					</table>
					<div class="text-center">
						{{ $books->links() }}
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
