<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 24.07.2018
 * Time: 19:00
 */

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PastebinRepository
{

    public function getFirstTenPublicRecords(){
        return DB::table('pastebins')->where('term','>',Carbon::now())->paginate(10);
    }

    public function getFirstTenPublicRecordsForUser($userId){
        return DB::table('pastebins')->where([['user_id','=',$userId],['term','>',Carbon::now()]])->paginate(10);
    }
}