@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
				<div class="panel-heading">
					<span>Create new book</span>
					<span class="pull-right">
						<a class="btn btn-link no-padding" href="{{ route('books.index') }}">Back to books</a>
					</span>
				</div>

                <div class="panel-body">
					@if ($errors->count() > 0)
						<ul>
							@foreach($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					@endif
					<form action="{{ route('books.store') }}" method="post">
						{{ csrf_field() }}
						* Name:
						<br />
						<input type="text" name="name" value="{{ old('name') }}" />
						<br /><br />
						* Author:
						<br />
						<input type="text" name="author" value="{{ old('author') }}" />
						<br /><br />
						* Published date:
						<br />
						<input type="date" name="published_date" value="{{ old('published_date') }}" />
						<br /><br />
						* Category:
						<br />
						<select class="form-control autocomplete-select" name="category">
							@foreach($categories as $category)
								<option>{{ $category->name }}</option>
							@endforeach
						</select>
						<br /><br />
						<input type="submit" value="Create" class="btn btn-default" />
					</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
