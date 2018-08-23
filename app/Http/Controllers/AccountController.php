<?php

namespace App\Http\Controllers;


use App\Repositories\Account\AccountInterface;
use App\Repositories\Account\BuildingInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller {

	private $account;

	public function __construct( AccountInterface $account ) {
		$this->account = $account;
	}

	public function index() {
		$user = Auth::user();

		return view( 'admin.dashboard', [ 'user' => $user ] );
	}

	public function deposit() {
		return view( 'admin.account.deposit' );
	}

	public function saveDeposit( Request $r ) {

		try {
			$rules     = array(
				'amount' => 'required|numeric',
			);
			$validator = Validator::make( $r->all(), $rules );
			if ( $validator->fails() ) {
				return Redirect::back()->withErrors( $validator )->withInput( $r->all() );
			} else {
				$data                      = $r->all();
				$data['account_id']        = Auth::user()->account->id;
				$data['type']              = '1';
				$data['opening_balance']   = Auth::user()->account->balance;
				$update_account['balance'] = $data['closing_balance'] = $data['opening_balance'] + $data['amount'];
				DB::beginTransaction();
				$this->account->saveTransaction( $data );
				$this->account->update( $data['account_id'], $update_account );
				DB::commit();
				Session::flash( 'message', [
					'msg'  => 'Amount deposited successfully.Thank you!!',
					'type' => "alert-success"
				] );
			}

		} Catch ( \Exception $e ) {
			DB::rollBack();
			Session::flash( 'message', [
				'msg'  => $e->getMessage(),
				'type' => 'alert-danger',
			] );
		}

		return Redirect::to( 'account/deposit' );
	}

	public function withdraw() {

		$user_balance = Auth::user()->account->balance;
		return view( 'admin.account.withdraw', [ 'user_balance' => $user_balance ] );
	}

	public function saveWithdraw( Request $r ) {

		try {
			$rules     = array(
				'amount' => 'required|numeric',
			);
			$validator = Validator::make( $r->all(), $rules );
			if ( $validator->fails() ) {
				return Redirect::back()->withErrors( $validator )->withInput( $r->all() );
			} else {
				$data = $r->all();
				if ( ( Auth::user()->account->balance - $data['amount'] ) < 0 ) {
					Session::flash( 'message', [
						'msg'  => "You don't have this much of amount in bank.",
						'type' => 'alert-danger',
					] );

					return Redirect::back()->withInput( $r->all() );
				}
				$data['account_id']        = Auth::user()->account->id;
				$data['type']              = '2';
				$data['opening_balance']   = Auth::user()->account->balance;
				$update_account['balance'] = $data['closing_balance'] = $data['opening_balance'] - $data['amount'];
				DB::beginTransaction();
				$this->account->saveTransaction( $data );
				$this->account->update( $data['account_id'], $update_account );
				DB::commit();
				Session::flash( 'message', [
					'msg'  => 'Amount withdraw Successfully.Thank you!!',
					'type' => "alert-success"
				] );
			}

		} Catch ( \Exception $e ) {
			DB::rollBack();
			Session::flash( 'message', [
				'msg'  => $e->getMessage(),
				'type' => 'alert-danger',
			] );
		}

		return Redirect::to( 'account/withdraw' );
	}


	public function transfer() {

		$user_balance = Auth::user()->account->balance;
		return view( 'admin.account.transfer', [ 'user_balance' => $user_balance ] );
	}

	public function saveTransfer( Request $r ) {

		try {
			$rules     = array(
				'amount' => 'required|numeric',
				'email'=>'required|email'
			);
			$validator = Validator::make( $r->all(), $rules );
			if ( $validator->fails() ) {
				return Redirect::back()->withErrors( $validator )->withInput( $r->all() );
			} else {
				$data = $r->all();
				if(Auth::user()->email == $data['email']){
					Session::flash( 'message', [
						'msg'  => "You can not transfer amount to your own account.",
						'type' => 'alert-danger',
					] );
					return Redirect::back()->withInput( $r->all() );
				}
				else if ( ( Auth::user()->account->balance - $data['amount'] ) < 0 ) {
					Session::flash( 'message', [
						'msg'  => "You don't have this much of amount in bank.",
						'type' => 'alert-danger',
					] );
					return Redirect::back()->withInput( $r->all() );
				}
				$to_user=$this->account->getUserByEmail($data['email']);
				if(!empty($to_user)) {

					$data['account_id']        = Auth::user()->account->id;
					$data['type']              = '2';
					$data['is_transfer']       = '1';
					$data['transfer_account_id']       = $to_user->account->id;
					$data['opening_balance']   = Auth::user()->account->balance;
					$update_account['balance'] = $data['closing_balance'] = $data['opening_balance'] - $data['amount'];


					DB::beginTransaction();

					$transfer['from_account_id'] = $data['account_id'];
					$transfer['to_account_id'] = $data['account_id'];

					$this->account->saveTransaction( $data );
					$this->account->update( $data['account_id'], $update_account );

					$to['account_id']             = $to_user->account->id;
					$to['amount']                 = $data['amount'];
					$to['type']                   = '1';
					$to['is_transfer']            = '1';
					$to['transfer_account_id']    = $data['account_id'];
					$to['opening_balance']        = $to_user->account->balance;
					$to_update_account['balance'] = $to['closing_balance'] = $to['opening_balance'] + $data['amount'];

					$this->account->saveTransaction( $to );
					$this->account->update( $to['account_id'], $to_update_account );
					DB::commit();
					Session::flash( 'message', [
						'msg'  => 'Amount Transfer successfully.Thank you!!',
						'type' => "alert-success"
					] );
				}
				else{
					Session::flash( 'message', [
						'msg'  => 'No account exist with this email id.',
						'type' => 'alert-danger',
					] );
					return Redirect::back()->withInput( $r->all() );
				}
			}

		} Catch ( \Exception $e ) {
				DB::rollBack();
				Session::flash( 'message', [
					'msg'  => $e->getMessage(),
					'type' => 'alert-danger',
				] );
		}

		return Redirect::to( 'account/transfer' );
	}


	public function statement(){
		$statements=$this->account->getStatementByAccountId(Auth::user()->account->id);
		return view('admin.account.statement',['statements'=>$statements]);
	}
}
