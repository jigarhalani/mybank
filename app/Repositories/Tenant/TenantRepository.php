<?php


namespace App\Repositories\Tenant;




use App\Tenants;

class TenantRepository implements TenantInterface{

    public $tenants;


    function __construct(Tenants $tenants )
    {
	    $this->tenants = $tenants;
    }

	public function save($data){
		return $this->tenants->create($data);
	}

    public function get($where=['is_active'=>'1'])
    {
        return $this->tenants->where($where)->with(['building','room'])->get();
    }

	public function update($id,$data){
		return $this->tenants->where('id', '=', $id)->update($data);
	}

	public function getById($id){
		return $this->tenants->find($id);
	}


}