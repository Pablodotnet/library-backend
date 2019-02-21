<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

	public function store(Request $request)
	{
		$book = Book::create($request->all());

		return response()->json($book, 201);
	}

	public function update(Request $request, Book $book)
	{
		$book->update($request->all());

		return response()->json($book, 200);
	}

	public function delete(Book $book)
	{
		$book->delete();

		// return response()->json(null, 204);
		return redirect()->route('books')->with(['books' => Book::all()]);
	}
}
