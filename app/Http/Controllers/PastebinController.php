<?php

namespace App\Http\Controllers;


use App\Pastebin;
use App\Service\PastebinApi;
use App\Service\PastebinDto;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PastebinRepository;


class PastebinController extends Controller
{
    private $pastebinRepository;

    public function __construct(PastebinRepository $repository)
    {
        $this->pastebinRepository=$repository;
    }


    public function index()
    {
        $pastebins =$this->pastebinRepository->getFirstTenPublicRecords();
        $pastebinsRegisterUser=[];
        if(Auth::check()){
            $userId=Auth::id();
            $pastebinsRegisterUser = $this->pastebinRepository->getFirstTenPublicRecordsForUser($userId);
        }
        return view('pastebin',['pastebins'=>$pastebins,'pastebinsRegisterUser'=>$pastebinsRegisterUser]);
    }

    public function store(Request $request)
    {
        $name = $request->get('name');
        $text = $request->get('text');
        $languale=$request->get('language');
        $access = $request->get('access');
        $term = $request->get('term');

        $paste = new PastebinDto();
        $paste->set_me_public();
        $paste->set_paste_expire_date('N');
        $paste->set_paste_name($name);
        $paste->set_paste_format($languale);
        $paste->set_paste_code($text);

        $pastebinApi = new PastebinApi('8bdc76c257b607cf0d5bcdf00ed0e230');
        $url = $pastebinApi->send_paste($paste);

        $pastebin = new Pastebin();
        $pastebin->name=$name;
        $pastebin->text=$text;
        $pastebin->language=$languale;

        $nowDateTime=Carbon::now();

        switch ($term){
            case '10M': $nowDateTime->addMinutes(10); break;
            case '1H': $nowDateTime->addHour(); break;
            case '3H': $nowDateTime->addHour(3); break;
            case '1D': $nowDateTime->addDay(); break;
            case '1W': $nowDateTime->addWeek(); break;
            case '1M': $nowDateTime->addMonth(); break;
            default: $nowDateTime->addYear(1000);
        }
        $pastebin->term=$nowDateTime;
        $pastebin->access=$access;
        $pastebin->url=$url;
        $pastebin->save();


        return redirect()->route('pastebin');
    }

}
