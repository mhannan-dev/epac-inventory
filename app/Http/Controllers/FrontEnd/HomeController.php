<?php

namespace App\Http\Controllers\FrontEnd;
use App\Http\Controllers\Controller;
use Validator;


class HomeController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getIndex()
    {
        $data['title'] = "Home page";
        return view('shop.pages.index', $data);
    }


}
