<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	use Notifiable;
	
	/**
	 * Get the book associated with the user.
	 */
	public function book()
	{
		return $this->hasOne('App\Book');
	}

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
	];
	
	/**
	 * Function to generate user token
	 * 
	 */
	public function generateToken()
	{
		$this->api_token = str_random(60);
		$this->save();

		return $this->api_token;
	}
}
