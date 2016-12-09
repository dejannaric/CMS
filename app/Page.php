<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Page extends Model
{
	//returns all pages in db
	public function getPages() {
		return DB::table('pages')->get();
	}

    //return page by id
    public function getPage($id) {
        return DB::table('pages')->where("id", $id)->get();
    }

    //return page by title
    public function getTitle($title) {
        return DB::table('pages')->where("title", $title)->get();
    }

    public function getImageByPage($id) {
        return DB::table('images')->where('page_id', $id)->get();
    }
    
    /* delete page and its image */
    public function deletePage($id) {
        $img = DB::table('images')->where('page_id', $id)->get();
        if (isset($img) && !empty($img)) {
            unlink(public_path().'/files/'.$img[0]->img_name);
        }
        DB::table('images')->where('page_id', $id)->delete();
    	DB::table('pages')->where('id', $id)->delete();      

    }
    public function deleteImage($id)
    {        
        $img = DB::table('images')->where('id', $id)->get();
        if (isset($img) && !empty($img)) {
            unlink(public_path().'/files/'.$img[0]->img_name);
        }
        DB::table('images')->where('id', $id)->delete();
    }

    public function updatePage($data, $id) {
        DB::table('pages')->where('id', $id)->update($data);

    }

    public function updateImage($data, $id) 
    {
        $bool = DB::table('images')->where('page_id', $id)->update($data);
        if (!$bool) {
            $this->saveImage($data);
        }
    }

    /* Inserts new page and returns its ID */
    public function savePage($data) {
    	return DB::table("pages")->insertGetId($data);   	

    }

    public function saveImage($data) {
    	DB::table("images")->insert($data);
    }
}
