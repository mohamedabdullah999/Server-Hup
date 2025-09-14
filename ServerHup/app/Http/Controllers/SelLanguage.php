<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class SelLanguage extends Controller
{
    public function change(Request $request){
        $lang = $request->lang;
        session::put("locale", $lang);
        return redirect()->back();
    }
}
