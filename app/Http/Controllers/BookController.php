<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreBookRequest;
use App\Book;
use App\Category;

class BookController extends Controller
{
	/**
	 * Show the list of books
	 * 
	 */
	public function index(Request $request)
	{
		$categories = Category::all();
		
		if ($request->has('category')) {
			$category = Category::where('name', $request->category)->firstOrFail();
			$books = Book::where('category_id', $category->id)->paginate(10)->appends('category', $request->category);
			return view('books')->with(['books' => $books, 'categories' => $categories, 'message' => "Filtered by: $category->name"]);
		} else {
			$books = Book::paginate(10);
			return view('books')->with(['books' => $books, 'categories' => $categories]);
		}
	}

	/**
	 * Show the a specific requested book
	 * 
	 */
	public function show(Book $book)
	{
		return view('book')->with(['book' => $book]);
	}

	/**
	 * Show the book creation view
	 * 
	 */
	public function create()
	{
		$categories = Category::all();

		return view('createBook', ['categories' => $categories]);
	}

	/**
	 * Store a new book
	 * 
	 */
	public function store(StoreBookRequest $request)
	{
		$book = Book::create($request->all());

		// Assigning the category requested
		$category = Category::where('name', $request->category)->firstOrFail();
		$category->books()->save($book);

		return redirect()->route('book', ['book' => $book])->with(['message' => 'Book created successfully']);
	}

	/**
	 * Show the book edition view
	 * 
	 */
	public function edit(Book $book)
	{
		$categories = Category::all();

		return view('editBook', ['book' => $book, 'categories' => $categories]);
	}

	/**
	 * Update a specific book
	 * 
	 */
	public function update(StoreBookRequest $request, Book $book)
	{
		$book->update($request->all());

		return redirect()->route('book', ['book' => $book])->with(['message' => 'Book updated successfully']);
	}

	/**
	 * Delete a specific book
	 * 
	 */
	public function delete(Book $book)
	{
		$book->delete();

		return redirect()->route('books')->with(['books' => Book::all()])->with(['message' => 'Book deleted successfully']);
	}

	/**
	 * Change status of a specific book to rented
	 * if user already has a book, it returns it before
	 * renting the new one
	 * 
	 */
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

	/**
	 * Change the status of a book to available
	 * 
	 */
	public function return(Request $request, Book $book)
	{
		$user = $request->user();

		$user->book->user()->dissociate();
		$user->book->save();

		return redirect()->route('book', ['book' => $book])->with(['message' => 'Book returned successfully']);
	}
}
