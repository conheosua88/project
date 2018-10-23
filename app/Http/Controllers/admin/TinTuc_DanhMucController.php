<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Post_New_Categories;

class TinTuc_DanhMucController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $danhmucs = Post_New_Categories::paginate(10);
        return view('admin.tintuc.danhmuc.index',compact('danhmucs'));
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
        $names = Post_New_Categories::all();
        foreach($names as $name){
            if($request->ten == $name->name){
                $obj = (object) array('status' => 0 ,'error'=>'Tên danh mục đã tồn tại');
                return json_encode($obj, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            }
        }      
        
        $category = new Post_New_Categories();
        $category->name = $request->ten;
        $category->slug = str_slug($request->ten);
        $category->save();
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
    public function edit($id)
    {
        $category = Post_New_Categories::find($id);
        $obj = (object) array('status' => 1 ,'data'=>$category);
        return json_encode($obj, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
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
        $category = Post_New_Categories::find($id);  
        $names = Post_New_Categories::all();
        foreach($names as $name){
            if($request->ten == $name->name && $request->ten != $category->name){
                $obj = (object) array('status' => 0 ,'error'=>'Tên danh mục đã tồn tại');
                return json_encode($obj, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            }
        }
        
        $category->name = $request->ten;
        $category->slug = str_slug($request->ten);
        $category->save();
        $obj = (object) array('status' => 1);
        return json_encode($obj, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Post_New_Categories::find($id);
        $category->delete();
        $obj = (object) array('status' => 1);
        return json_encode($obj, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
    public function search($ten_tieude,$page,$limit){
        if($ten_tieude != 'all'){
            $query = Post_New_Categories::where('name', 'like' ,'%'.$ten_tieude.'%');
        }        
        $danhsachs = $query->get();
        $total = ceil((float)count($danhsachs) / (float)$limit);
        $skip = ($page - 1) * $limit;
        $danhsachs = $query->limit($limit)->offset($skip)->get();
        $obj = (object) array('status' => 1,'data' => $danhsachs,'total'=>$total);
        return json_encode($obj, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}
