<?php



namespace App\Repositories\Account;

interface AccountInterface {

		public function save($data);

        public function get($where);

        public function getById($id);

		public function update($id,$data);

}