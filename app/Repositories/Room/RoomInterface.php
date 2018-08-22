<?php



namespace App\Repositories\Room;

interface RoomInterface{

		public function save($data);

        public function get($where);

        public function getById($id);

		public function update($id,$data);

}