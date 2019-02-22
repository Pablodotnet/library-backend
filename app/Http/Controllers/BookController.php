<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreBookRequest;
use App\Book;
use App\Category;

class BookController extends Controller
{
	public function index(Request $request)
	{
		$categories = Category::all();
		
		if ($request->has('category')) {
			$category = Category::where('name', $request->category)->firstOrFail();
			$books = Book::where('category_id', $category->id)->paginate(10)->appends('category', $request->category);
			return view('books')->with(['books' => $books, 'categories' => $categories]);
		} else {
			$books = Book::paginate(10);
			return view('books')->with(['books' => $books, 'categories' => $categories]);
		}
	}

	public function show(Book $book)
	{
		// return $book;
		return view('book')->with(['book' => $book]);
	}

	public function create()
	{
		$categories = Category::all();

		return view('createBook', ['categories' => $categories]);
	}

	public function store(StoreBookRequest $request)
	{
		$book = Book::create($request->all());

		// Assigning the category requested
		$category = Category::where('name', $request->category)->firstOrFail();
		$category->books()->save($book);

		// return response()->json($book, 201);
		return redirect()->route('book', ['book' => $book])->with(['message' => 'Book created successfully']);;
	}

	public function edit(Book $book)
	{
		$categories = Category::all();

		return view('editBook', ['book' => $book, 'categories' => $categories]);
	}

	public function update(StoreBookRequest $request, Book $book)
	{
		$book->update($request->all());

		// return response()->json($book, 200);
		return redirect()->route('book', ['book' => $book])->with(['message' => 'Book updated successfully']);
	}

	public function delete(Book $book)
	{
		$book->delete();

		// return response()->json(null, 204);
		return redirect()->route('books')->with(['books' => Book::all()]);
	}

	public function rent(Request $request, Book $book)
	{
		$user = $request->user();

		if ($user->book) {
			$user->book->user()->dissociate();
			$user->book->save();
		}
		$user->book()->save($book);

		return redirect()->route('book', ['book' => $book])->with(['message' => 'Book rented successfully']);
	}

	public function return(Request $request, Book $book)
	{
		$user = $request->user();

		$user->book->user()->dissociate();
		$user->book->save();

		return redirect()->route('book', ['book' => $book])->with(['message' => 'Book returned successfully']);
	}
}
