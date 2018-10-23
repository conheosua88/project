<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Post_Categories;
use Illuminate\Support\Facades\DB;

class TourDuLich_DanhMucController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $danhmucs = Post_Categories::paginate(10);
        return view('admin.tourdulich.danhmuc.index',compact('danhmucs'));
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
        $names = Post_Categories::all();
        if(isset($name)){
            foreach($names as $name){
                if($request->ten == $name->name){
                    $obj = (object) array('status' => 0 ,'error'=>'Tên danh mục đã tồn tại');
                    return json_encode($obj, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                }
            }  
        }
        $category = new Post_Categories();
        $category->name = $request->ten;
        $category->slug = str_slug($request->ten);
        $category->parent_category_id = $request->danhmucid;
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
        $category = Post_Categories::find($id);
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
        $category = Post_Categories::find($id);  
        $names = Post_Categories::all();
        foreach($names as $name){
            if($request->ten == $name->name && $request->ten != $category->name){
                $obj = (object) array('status' => 0 ,'error'=>'Tên danh mục đã tồn tại');
                return json_encode($obj, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            }
        }
        $category->name = $request->ten;
        $category->slug = str_slug($request->ten);
        $category->parent_category_id = $request->danhmucid;
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
        $category = Post_Categories::find($id);
        $category->delete();
        $obj = (object) array('status' => 1);
        return json_encode($obj, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
    public function search($ten_tieude,$page,$limit){
        $query = DB::table('post_category as dm')->select('dm.id', 'dm.name','dmc.name as parent_category_name')->leftJoin('post_category as dmc', 'dm.parent_category_id', '=', 'dmc.id');
        if($ten_tieude != 'all'){
            $query = $query->where('dm.name', 'like' ,'%'.$ten_tieude.'%');
        }        
        $danhsachs = $query->get();
        $total = ceil((float)count($danhsachs) / (float)$limit);
        $skip = ($page - 1) * $limit;
        $danhsachs = $query->limit($limit)->offset($skip)->get();
        $obj = (object) array('status' => 1,'data' => $danhsachs,'total'=>$total);
        return json_encode($obj, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}
