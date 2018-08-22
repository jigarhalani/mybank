<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tenants extends Model
{
	protected $table = 'tenants';
	protected $fillable = [ 'building_id','room_id', 'name', 'address', 'pan_no', 'aadhar_no', 'is_active', 'created_at', 'updated_at' ];


	public function room(){
		return $this->hasOne( 'App\Rooms', 'id','room_id');
	}

	public function building(){
		return $this->hasOne( 'App\Building', 'id','building_id');
	}
}
