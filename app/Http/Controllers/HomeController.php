<?php

namespace App\Http\Controllers;


use App\Repositories\Building\BuildingInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{

	private $building;

	public function __construct(BuildingInterface $building){

			$this->building=$building;

	}

	public function index()
	{
		return view('admin.building.add');
	}

	public function save(Request $r){
		try{

			$rules = array(
				'name' => 'required',
				'area' => 'required',
				'city' => 'required',
				'state' => 'required',
				'pincode' => 'required',
			);
			$validator = Validator::make($r->all(),$rules);
			if ($validator->fails()){
				return Redirect::back()->withErrors($validator)->withInput($r->all());
			}
			else{
				$data=$r->all();
				$data['user_id']=Auth::user()->id;
				$this->building->save($data);
				Session::flash('message',[
					'msg' => 'Added successfully.Thank you!!',
					'type' =>"alert-success"
				]);
			}

		}Catch(\Exception $e){
			Session::flash('message',[
				'msg'=>$e->getMessage(),
				'type'=>'alert-danger',
			]);
		}
		return Redirect::to('building/add');
	}

	public function view() {
		$buildings = $this->building->get( [ 'is_active' => '1' ] );

		return view( 'admin.building.view', [ 'buildings' => $buildings ] );

	}

	public function delete($id){
		try{
			$this->building->update($id,['is_active'=>'0']);
			Session::flash('message',[
				'msg' => 'Deleted successfully.Thank you!!',
				'type' =>"alert-success"
			]);
		}catch (\Exception $e){

			Session::flash('message',[
				'msg'=>$e->getMessage(),
				'type'=>'alert-danger',
			]);

		}

		return Redirect::back();

	}

	public function edit($id){

		try{

			$buildings=$this->building->getById($id);
			if($buildings==null)
				throw  new \Exception("Building Not Found");
			return view('admin.building.edit',['building'=>$buildings]);
		}catch (\Exception $e){

			Session::flash('message',[
				'msg'=>$e->getMessage(),
				'type'=>'alert-danger',
			]);
			return Redirect::back();
		}

	}

	public function update($id,Request $r){


		try{

			$rules = array(
				'name' => 'required',
				'area' => 'required',
				'city' => 'required',
				'state' => 'required',
				'pincode' => 'required',
			);
			$validator = Validator::make($r->all(),$rules);
			if ($validator->fails()){
				return Redirect::back()->withErrors($validator);
			}
			else{
				$data=$r->except(['_token']);
				$this->building->update($id,$data);
				Session::flash('message',[
					'msg' => 'Updated successfully.Thank you!!',
					'type' =>"alert-success"
				]);
			}

		}Catch(\Exception $e){
			Session::flash('message',[
				'msg'=>$e->getMessage(),
				'type'=>'alert-danger',
			]);
		}
		return Redirect::back();

	}
}
