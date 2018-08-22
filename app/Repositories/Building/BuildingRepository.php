<?php


namespace App\Repositories\Building;



use App\Building;


class BuildingRepository implements BuildingInterface{

    public $building;


    function __construct(Building $building )
    {
	    $this->building = $building;
    }

	public function save($data){
		return $this->building->create($data);
	}

    public function get($where=['is_active'=>'1'])
    {
        return $this->building->where($where)->get();
    }

	public function update($id,$data){
		return $this->building->where('id', '=', $id)->update($data);
	}

	public function getById($id){
		return $this->building->find($id);
	}


}