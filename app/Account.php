<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'user_id','type', 'balance','created_at', 'updated_at'
	];


	public function user(){
		return $this->belongsTo( 'App\User', 'user_id');
	}

	public function transaction(){
		return $this->hasOne( 'App\Transaction', 'account_id' );
	}
}
