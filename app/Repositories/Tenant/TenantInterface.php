<?php



namespace App\Repositories\Tenant;

interface TenantInterface{

		public function save($data);

        public function get($where);

        public function getById($id);

		public function update($id,$data);

}