<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;

class PageControl extends Controller
{
    public function __construct(Page $pages)    {
        $this->pages = $pages;
        
    }

    public function index()
    {
    	$data = array(	
    		'title' => 'Home page',
    		'keywords' => 'keyword1,keyword2',
    		'description' => 'Description of the page',
    		'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
		);
    	return view('layouts.modules.home')->with('data', $data);
    }

    public function open($page) {
    	$data = $this->pages->getTitle($page);

        $imgData = $this->pages->getImageByPage($data[0]->id);
    	if (isset($data) && !is_null($data)) {
    		return view('layouts.modules.page')->with(array('data' => $data, 'imgData' => $imgData));
    		
    	} else {
    		redirect(route('homepage'));
    	}
    }
}
