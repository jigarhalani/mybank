<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'account_id','type', 'is_transfer','status','amount','opening_balance','closing_balance','created_at', 'updated_at'
	];

	public function account(){
		return $this->belongsTo( 'App\Account', 'account_id');
	}

	public function transfer(){
		return $this->hasOne('App\Transfer','transaction_id');
	}
}
