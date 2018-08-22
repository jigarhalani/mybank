<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
	protected $fillable = [ 'building_id', 'room_name', 'max_person', 'is_active', 'created_at', 'updated_at' ];


	public function building() {
		return $this->belongsTo( 'App\Building', 'building_id');
	}

}
