<?php

namespace App\Http\Controllers;

use App\Repositories\Building\BuildingInterface;
use App\Repositories\Room\RoomInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller {

	private $room;
	private $building;

	public function __construct( RoomInterface $room, BuildingInterface $building ) {
		$this->room     = $room;
		$this->building = $building;
	}

	public function index() {
		$building = $this->building->get( [ 'is_active' => '1', 'user_id' => Auth::user()->id ] );

		return view( 'admin.room.add', [ 'buildings' => $building ] );
	}

	public function save( Request $r ) {
		try {

			$rules     = array(
				'building_id' => 'required',
				'room_name'   => 'required',
				'max_person'  => 'required',
			);
			$validator = Validator::make( $r->all(), $rules );
			if ( $validator->fails() ) {
				return Redirect::back()->withErrors( $validator )->withInput( $r->all() );
			} else {
				$data = $r->all();
				$this->room->save( $data );
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

		return Redirect::to( 'room/add' );
	}

	public function view() {
		$rooms = $this->room->get( [ 'is_active' => '1' ] );

		return view( 'admin.room.view', [ 'rooms' => $rooms ] );

	}

	public function delete( $id ) {

		try {

			$this->room->update( $id, [ 'is_active' => '0' ] );
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

			$rooms = $this->room->getById( $id );
			$buildings = $this->building->get( [ 'is_active' => '1', 'user_id' => Auth::user()->id ] );

			if ( $rooms == null ) {
				throw  new \Exception( "Room Not Found" );
			}

			return view( 'admin.room.edit', [ 'buildings' => $buildings,'rooms'=>$rooms ] );

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

			$rules = array(
				'building_id' => 'required',
				'room_name'   => 'required',
				'max_person'  => 'required',
			);

			$validator = Validator::make( $r->all(), $rules );

			if ( $validator->fails() ) {
				return Redirect::back()->withErrors( $validator )->withInput( $r->all() );
			} else {
				$data = $r->except(['_token']);
				$this->room->update( $id, $data );
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

}
