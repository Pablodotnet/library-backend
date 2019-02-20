<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	/**
	 * The books that belong to the category.
	 */
	public function books()
	{
		return $this->belongsToMany('App\Book');
	}
	
	protected $fillable = ['name', 'description'];
}
