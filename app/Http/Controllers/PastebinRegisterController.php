<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PastebinRegisterController extends Controller
{
    private $pastebinREpository;

    public function __construct(\PastebinRepository $pastebinRepository)
    {
        $this->middleware('auth');
        $this->pastebinREpository=$pastebinRepository;
    }

    public function index()
    {
        $pastebins = $this->pastebinREpository->getFirstTenPublicRecordsForUser(Auth::id());
        return view('pastebin-register-user',['pastebins'=>$pastebins]);
    }
}
