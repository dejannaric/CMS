<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Page $pages)
    {

        $this->middleware('auth');

        $this->pages = $pages;

        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data =  $this->pages->getPages();        
        return view('layouts.modules.viewAll')->with("data", $data);
    }

   

    
}
