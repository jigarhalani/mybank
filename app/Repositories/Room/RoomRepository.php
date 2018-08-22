<?php


namespace App\Repositories\Room;




use App\Rooms;

class RoomRepository implements RoomInterface{

    public $room;


    function __construct(Rooms $room )
    {
	    $this->room = $room;
    }

	public function save($data){
		return $this->room->create($data);
	}

    public function get($where=['is_active'=>'1'])
    {
        return $this->room->where($where)->with(['building'])->get();
    }

	public function update($id,$data){
		return $this->room->where('id', '=', $id)->update($data);
	}

	public function getById($id){
		return $this->room->find($id);
	}


}