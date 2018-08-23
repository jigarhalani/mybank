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
		'account_id','type', 'is_transfer','status','amount','opening_balance','transfer_account_id','closing_balance'
	];

	public function account(){
		return $this->belongsTo( 'App\Account', 'account_id');
	}

	public function transfer(){
		return $this->belongsTo( 'App\Account', 'transfer_account_id');
	}
}
