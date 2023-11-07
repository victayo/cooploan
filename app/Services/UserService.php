<?php

namespace App\Services;

use App\Models\Transaction;
use App\Models\User;
use App\Models\UserContribution;
use App\Models\Wallet;
use Exception;
use Illuminate\Support\Facades\DB;

class UserService {

    /**
     * Funds a user's Wallet with an amount
     * @return Wallet
     */
    public function fundWallet(User $user, $amount){
        try{
            DB::beginTransaction();
            $wallet = Wallet::where('user_id', $user->mainone_id)->first();
            if($wallet){
                $wallet->balance += $amount; // increase the $balance and save;
                $wallet->save();
            }else{
                $wallet = Wallet::create([
                    'user_id' => $user->mainone_id,
                    'balance' => $amount
                ]);
            }
            Transaction::create([
                'user_id' => $user->mainone_id,
                'amount' => $amount,
                'transaction_type' => Transaction::WALLET_FUNDING
            ]);
            DB::commit();
            return $wallet;
        }catch(Exception $exception){
            DB::rollBack();
            report($exception);
            return null;
        }
    }

    /**
     * Makes a contribution for the user. This contribution is added to the user's wallet
     */
    public function makeContribution(User $user, $amount, $type = Transaction::MONTHLY_CONTRIBUTION){
        try{
            DB::beginTransaction();
            UserContribution::create([
                'user_id' => $user->mainone_id,
                'amount' => $amount
            ]);

            $wallet = $this->fundWallet($user, $amount);
            if(!$wallet){
                DB::rollBack();
                return false;
            }

            Transaction::create([
                'user_id' => $user->mainone_id,
                'amount' => $amount,
                'transaction_type' => $type
            ]);
            DB::commit();
            return true;
        }catch(Exception $exception){
            report($exception);
            DB::rollBack();
            return false;
        }
    }
}
