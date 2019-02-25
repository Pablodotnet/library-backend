<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
	/**
	 * Get the user that borrowed the book.
	 */
	public function user()
	{
		return $this->belongsTo('App\User');
	}

	/**
	 * Get the category associated with the book.
	 */
	public function category()
	{
		return $this->belongsTo('App\Category');
	}
	
	protected $fillable = ['name', 'author', 'published_date'];
}
