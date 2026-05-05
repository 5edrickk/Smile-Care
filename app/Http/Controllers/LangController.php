<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LangController extends Controller
{
    //
    public function switch(Request $request)
    {
        $locale = $request->locale;
        app()->setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }
}
