<?php


namespace App\Repositories\Account;



use App\Transaction;

use App\User;


class AccountRepository implements AccountInterface {

    public $transaction;
    public $transfer;


    function __construct(Transaction $transaction,User $user)
    {
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


	public function getStatementByAccountId($account_id){
    	return $this->transaction->where('account_id','=',$account_id)->get();
	}


}