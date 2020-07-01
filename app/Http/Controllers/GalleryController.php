<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function storeImages(Request $request)
    {
        if($request->hasfile('filename'))
        {
            foreach($request->file('filename') as $image)
            {
                $name=$image->getClientOriginalName();
                $image->move(public_path().'/gallery/images',$name);
                $data[]= $name;
            }
        }
        $images = new Gallery();
        $images->filename=json_encode($data);
        $images->save();
        return "success";
    }
     
}
