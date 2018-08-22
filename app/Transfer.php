<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'transaction_id','transfer_account_id','created_at', 'updated_at'
	];

	public function transaction(){
		return $this->belongsTo( 'App\Transaction', 'transaction_id');
	}
}
