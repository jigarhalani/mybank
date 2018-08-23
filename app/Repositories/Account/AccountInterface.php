<?php



namespace App\Repositories\Account;

interface AccountInterface {

		public function saveTransaction($data);


        public function getUserByEmail($email);

		public function getStatementByAccountId($account_id);
}