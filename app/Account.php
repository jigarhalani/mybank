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
		return $this->hasMany( 'App\Transaction', 'account_id' );
	}

	public function transfer(){
		return $this->hasMany( 'App\Transaction', 'transfer_account_id');
	}
}
