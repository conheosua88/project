<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Tag;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $places = Tag::paginate(10);
        return view('admin.tourdulich.diadiem.index',compact('places'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $names = Tag::all();
        foreach($names as $name){
            if($request->ten == $name->name){
                $obj = (object) array('status' => 0 ,'error'=>'Tên địa điểm đã tồn tại');
                return json_encode($obj, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            }
        }      
        
        $place = new Tag();
        $place->name = $request->ten;
        $place->slug = str_slug($request->ten);
        $place->save();
        $obj = (object) array('status' => 1);
        return json_encode($obj, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        $obj = (object) array('status' => 1 ,'data'=>$tag);
        return json_encode($obj);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $place = Tag::find($id);  
        $names = Tag::all();
        foreach($names as $name){
            if($request->ten == $name->name && $request->ten != $place->name){
                $obj = (object) array('status' => 0 ,'error'=>'Tên địa điểm đã tồn tại');
                return json_encode($obj, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            }
        }
        
        $place->name = $request->ten;
        $place->slug = str_slug($request->ten);
        $place->save();
        $obj = (object) array('status' => 1);
        return json_encode($obj, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        $obj = (object) array('status' => 1);
        return json_encode($obj);
    }
}
