<?php 

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Page;
use Storage;
/**
* This controller handles CMS backend for the website
*/
class Backend extends Controller
{
	
	 public function __construct(Page $pages)
    {
    	$this->middleware('auth');
        $this->pages = $pages;        
    }

    /* Open page from backend:
        -create
        -viewAll
        
    */
    public function show($page)
    {
        $data = $this->pages->getPages();
        return view('layouts.modules.'.$page)->with("data", $data);
    }



	/* Saves new page into db */
	public function save(Request $request)
	{
		$this->validator($request);

		$data = $request->except('_token', "img", "x", "y");
		$pageId = $this->pages->savePage($data);
		
		if ($request->hasFile('img')) {
			$imgData = $this->saveImage($request, $pageId);
			$this->pages->saveImage($imgData);	
		}
		return redirect(route('home'));		
	}

	public function saveImage(Request $request, $pageId) {
		$destination = public_path().'/files/';
		$x = $request->input('x');
		$y = $request->input('y');
		$file = $request->file('img');
		$newName = $file->getClientOriginalName();
	    if ($file->isValid()) {
	    	if(file_exists($destination.$newName)) {
	    		$lokacija = $destination.$newName;
	    		$dodatek = 0;
	    		$date=date_create();
				$stamp = date_timestamp_get($date);

	    		$path_parts = pathinfo($destination.$newName);
    			$newName = $path_parts['filename'].'('.$stamp.')'.'.'.$path_parts['extension'];

	    		$file->move($destination,$newName);
	    		$destination = $destination.$newName;
	    	} else {
	    		$file->move($destination,$newName);
	    		$destination = $destination.$newName;
	    	}  
	    	if($x > 1 && $y > 1) {$crop = true;} else {$crop = false;} 				    

		    $this->imageResize($destination, $destination, 400, 400, $crop, $x, $y);		    

			
			$imgData = array(
				'img_name' => $newName,
				'page_id' => $pageId,
				'x' => $x,
				'y' => $y
			);
			return $imgData;
		}
	}

	/* Updates data in existing page */
	public function update(Request $request, $id)
	{
		$this->validatorUpdate($request);
		$data = $request->except('_token', "img", "x", "y");
		$this->pages->updatePage($data, $id);
		if ($request->hasFile('img')) {
			$imgData = $this->saveImage($request, $id);
			$this->pages->updateImage($imgData, $id);
		}	

		return redirect(route('home'));	
	}

	public function delete($pageId) {
		$this->pages->deletePage($pageId);
		return redirect(route('home'));	
	}
	public function deleteImage($id)
	{
		$this->pages->deleteImage($id);

	}

	public function edit($id) {
		$data = $this->pages->getPage($id);
		$imgData = $this->pages->getImageByPage($id);		
		return view('layouts.modules.edit')->with(array('data' => $data, 'imgData' => $imgData));
	}

	/* Validation for request */
	public function validator(Request $request)
	{
		$this->validate($request, [
			"title" => "required|unique:pages,title",
			"keywords" => "required",
			"description" => "required",
			"content" => "required"
		]);
	}

	public function validatorUpdate(Request $request) {
		$this->validate($request, [
			"title" => "required",
			"keywords" => "required",
			"description" => "required",
			"content" => "required"
		]);
	}


	function imageResize($src, $dst, $width, $height, $crop=false, $x=0, $y=0){
		
		if(!list($w, $h) = getimagesize($src)) return;

			$type = strtolower(substr(strrchr($src,"."),1));
			if($type == 'jpeg') $type = 'jpg';
			switch($type){
			case 'gif': $img = imagecreatefromgif($src); break;
			case 'jpg': $img = imagecreatefromjpeg($src); break;
			case 'png': $img = imagecreatefrompng($src); break;
			default : return "Unsupported picture type!";
		}

		if($crop){			
			$width = $x;
			$height = $y;
			$w =$x;
			$h =$y;
			$new = imagecreatetruecolor($width, $height);
			imagecopyresampled($new, $img, 0, 0, 0, 0, $x, $y, $w, $h);
		} else{			
			$ratio = min($width/$w, $height/$h);
			$width = $w * $ratio;
			$height = $h * $ratio;
			$new = imagecreatetruecolor($width, $height);
			imagecopyresampled($new, $img, 0, 0, 0, 0, $width, $height, $w, $h);
		}

	    switch($type){
      		case 'gif': imagegif($new, $dst); break;
	    	case 'jpg': imagejpeg($new, $dst); break;
	    	case 'png': imagepng($new, $dst); break;
	    }
	  	return true;
	}
}