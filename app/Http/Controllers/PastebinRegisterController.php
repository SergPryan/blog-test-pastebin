<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PastebinRegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->middleware('auth');
        $pastebins = DB::table('pastebins')->paginate(10);
        return view('pastebin-register-user',['pastebins'=>$pastebins]);
    }
}
