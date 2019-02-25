@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
				<div class="panel-heading">
					<span>Editing book</span>
					<a class="btn btn-link" href="{{ route('book', ['book' => $book]) }}" style="float: right !important; padding: 0px;">Back to book</a>
				</div>

                <div class="panel-body">
					@if ($errors->count() > 0)
						<ul>
							@foreach($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					@endif
					<form action="{{ route('book.update', ['book' => $book]) }}" method="post">
						<input type="hidden" name="_method" value="PUT">
						{{ csrf_field() }}
						* Name:
						<br />
						<input type="text" name="name" value="{{ $book->name }}" />
						<br /><br />
						* Author:
						<br />
						<input type="text" name="author" value="{{ $book->author }}" />
						<br /><br />
						* Published date:
						<br />
						<input type="date" name="published_date" value="{{ $book->published_date }}" />
						<br /><br />
						* Category:
						<br />
						<select class="form-control autocomplete-select" name="category">
								@foreach($categories as $category)
									<option {{ ($category == $book->category ? 'selected' : '') }}>{{ $category->name }}</option>
								@endforeach
							</select>
						<br /><br />
						<input type="submit" value="Accept" class="btn btn-success" />
						<a value="Cancel" class="btn btn-danger" href="{{ route('book', ['book' => $book]) }}">Cancel</a>
					</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
