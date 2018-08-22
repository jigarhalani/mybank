<?php



namespace App\Repositories\Building;

interface BuildingInterface {

		public function save($data);

        public function get($where);

        public function getById($id);

		public function update($id,$data);

}