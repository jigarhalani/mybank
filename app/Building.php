<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
	protected $table = 'building';
	protected $fillable = [ 'user_id','name', 'area', 'city', 'state', 'pincode', 'is_active', 'created_at', 'updated_at' ];



	public function rooms(){
		return $this->hasMany( 'App\Rooms', 'building_id' );
	}


}
