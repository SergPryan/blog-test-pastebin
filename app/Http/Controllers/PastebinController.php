<?php

namespace App\Http\Controllers;


use App\Pastebin;
use App\Service\PastebinApi;
use App\Service\PastebinDto;
use Carbon\Carbon;
use Illuminate\Http\Request;


class PastebinController extends Controller
{
    public function index()
    {
        return view('pastebin');
    }

    public function store(Request $request)
    {
        $name = $request->get('name');
        $text = $request->get('text');
        $languale=$request->get('language');
        $access = $request->get('access');

        $paste = new PastebinDto();
        $paste->set_me_public(); // http://pastebin.com/api#7
        $paste->set_paste_expire_date('N'); // http://pastebin.com/api#6
        $paste->set_paste_name($name);
        $paste->set_paste_format($languale); // http://pastebin.com/api#5
        $paste->set_paste_code($text);

        $pastebinApi = new PastebinApi('8bdc76c257b607cf0d5bcdf00ed0e230');
        $url = $pastebinApi->send_paste($paste);


        $pastebin = new Pastebin();
        $pastebin->name=$name;
        $pastebin->text=$text;
        $pastebin->language=$languale;
        $pastebin->term=Carbon::now();
        $pastebin->access=$access;
        $pastebin->url=$url;
        $pastebin->save();


        return redirect()->route('pastebin');
    }
}