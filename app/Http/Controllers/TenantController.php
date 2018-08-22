<?php

namespace App\Http\Controllers;

use App\Repositories\Building\BuildingInterface;
use App\Repositories\Room\RoomInterface;
use App\Repositories\Tenant\TenantInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class TenantController extends Controller {

	private $room;
	private $building;
	private $tenant;

	public function __construct( RoomInterface $room, BuildingInterface $building ,TenantInterface $tenant) {
		$this->room     = $room;
		$this->building = $building;
		$this->tenant = $tenant;
	}

	public function index() {
		$building = $this->building->get( [ 'is_active' => '1', 'user_id' => Auth::user()->id ] );

		return view( 'admin.tenant.add', [ 'buildings' => $building ] );
	}

	public function save( Request $r ) {
		try {

			$rules     = array(
				'building_id' => 'required',
				'room_id' => 'required',
				'name'   => 'required',
				'address'   => 'required',
				'pan_no'   => 'required',
				'aadhar_no'   => 'required'
			);
			$validator = Validator::make( $r->all(), $rules );
			if ( $validator->fails() ) {
				return Redirect::back()->withErrors( $validator )->withInput( $r->all() );
			} else {
				$data = $r->all();
				$this->tenant->save( $data );
				Session::flash( 'message', [
					'msg'  => 'Added successfully.Thank you!!',
					'type' => "alert-success"
				] );
			}

		} Catch ( \Exception $e ) {
			Session::flash( 'message', [
				'msg'  => $e->getMessage(),
				'type' => 'alert-danger',
			] );
		}

		return Redirect::to( 'tenants/add' );
	}

	public function view() {

		$tenants = $this->tenant->get( [ 'is_active' => '1' ] );
		return view( 'admin.tenant.view', [ 'tenants' => $tenants ] );

	}

	public function delete( $id ) {

		try {

			$this->tenant->update( $id, [ 'is_active' => '0' ] );
			Session::flash( 'message', [
				'msg'  => 'Deleted successfully.Thank you!!',
				'type' => "alert-success"
			] );
		} catch ( \Exception $e ) {

			Session::flash( 'message', [
				'msg'  => $e->getMessage(),
				'type' => 'alert-danger',
			] );

		}

		return Redirect::back();

	}

	public function edit( $id ) {

		try {

			$tenants = $this->tenant->getById( $id );
			$buildings = $this->building->get( [ 'is_active' => '1', 'user_id' => Auth::user()->id ] );

			if ( $tenants == null ) {
				throw  new \Exception( "Tenants Not Found" );
			}

			return view( 'admin.tenant.edit', [ 'buildings' => $buildings, 'tenants' => $tenants ] );

		} catch ( \Exception $e ) {

			Session::flash( 'message', [
				'msg'  => $e->getMessage(),
				'type' => 'alert-danger',
			] );

			return Redirect::back();
		}

	}

	public function update( $id, Request $r ) {

		try {

			$rules     = array(
				'building_id' => 'required',
				'room_id' => 'required',
				'name'   => 'required',
				'address'   => 'required',
				'pan_no'   => 'required',
				'aadhar_no'   => 'required'
			);
			$validator = Validator::make( $r->all(), $rules );
			if ( $validator->fails() ) {
				return Redirect::back()->withErrors( $validator )->withInput( $r->all() );
			} else {
				$data = $r->except(['_token']);
				$this->tenant->update( $id, $data );
				Session::flash( 'message', [
					'msg'  => 'Updated successfully.Thank you!!',
					'type' => "alert-success"
				] );
			}

		} Catch ( \Exception $e ) {
			Session::flash( 'message', [
				'msg'  => $e->getMessage(),
				'type' => 'alert-danger',
			] );
		}

		return Redirect::back();

	}

	public  function  getRoom($id){
		$building = $this->building->get( ['id' => $id ] )->first();
		return $building->rooms;
	}

}
