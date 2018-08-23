<?php


namespace App\Repositories\Account;



use App\Account;
use App\Transaction;

use App\User;


class AccountRepository implements AccountInterface {

    public $account;
    public $transaction;
    public $transfer;


    function __construct(Account $account , Transaction $transaction,User $user)
    {
	    $this->account = $account;
	    $this->transaction = $transaction;
	    $this->user=$user;
    }

	public function saveTransaction($data){
		return $this->transaction->create($data);
	}

    public function getUserByEmail($email)
    {
        return $this->user->where('email','=',$email)->first();
    }

	public function update($id,$data){
		return $this->account->where('id', '=', $id)->update($data);
	}

	public function getStatementByAccountId($account_id){
    	return $this->transaction->where('account_id','=',$account_id)->get();
	}


}