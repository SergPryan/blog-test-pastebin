<?php

namespace App\Http\Controllers;

use App\Repository\PastebinRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class PastebinRegisterController extends Controller
{
    private $pastebinRepository;

    public function __construct(PastebinRepository $repository)
    {
        $this->middleware('auth');
        $this->pastebinRepository=$repository;
    }

    public function index()
    {
        $pastebins = $this->pastebinRepository->getFirstTenPublicRecordsForUser(Auth::id());
        return view('pastebin-register-user',['pastebins'=>$pastebins]);
    }
}
