<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreBookRequest;
use App\Book;

class BookController extends Controller
{
	public function index()
	{
		$books = Book::paginate(10);
		// return Book::all();
		return view('books')->with(['books' => $books]);
	}

	public function show(Book $book)
	{
		// return $book;
		return view('book')->with(['book' => $book]);
	}

	public function create()
	{
		return view('createBook');
	}

	public function store(StoreBookRequest $request)
	{
		$book = Book::create($request->all());

		// return response()->json($book, 201);
		return redirect()->route('book', ['book' => $book])->with(['message' => 'Book created successfully']);;
	}

	public function edit(Book $book)
	{
		return view('editBook', ['book' => $book]);
	}

	public function update(StoreBookRequest $request, Book $book)
	{
		$book->update($request->all());

		// return response()->json($book, 200);
		return redirect()->route('book', ['book' => $book])->with(['message' => 'Book updated successfully']);;
	}

	public function delete(Book $book)
	{
		$book->delete();

		// return response()->json(null, 204);
		return redirect()->route('books')->with(['books' => Book::all()]);
	}
}
