<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gallery;

class GalleryController extends Controller
{
    public function storeImages(Request $request)
    {
        $data=array();
        if($request->hasfile('filename'))
        {
            foreach($request->file('filename') as $image)
            {
                $name=$image->getClientOriginalName();
                $image->move(public_path().'/gallery/images',$name);
                array_push($data,$name);
            }
        }
        $images = new Gallery();
        $images->filename=json_encode($data);
        if($images->save())
        {
            return json_encode([
                'data'=>$data,
                'message'=>'saved'
            ]);
        }
        else
        {
            return json_encode([
                'data'=>null,
                'message'=>'Failed to save'
            ]);
        }
        
    }
    public function show()
    {
        $gallery = new Gallery();
        $data=$gallery->all();
        return json_encode([
            'data'=>$data,
            'message'=>'successful'
        ]);
    }
     
}
