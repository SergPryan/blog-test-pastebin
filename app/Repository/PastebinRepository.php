<?php

namespace App\Repository;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PastebinRepository
{

    public function getFirstTenPublicRecords(){
        return DB::table('pastebins')->where('term','>',Carbon::now())->paginate(10);
    }

    public function getFirstTenPublicRecordsForUser($userId){
        return DB::table('pastebins')->where([['user_id','=',$userId],['term','>',Carbon::now()]])->paginate(10);
    }

    public function getByUrl($url){
        return DB::table('pastebins')->where('url','=',$url);
    }
}