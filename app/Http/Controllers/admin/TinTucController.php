<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Post_New;
use App\Model\Post_New_Categories;
use Illuminate\Support\Facades\DB;


class TinTucController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tintucs = Post_New::paginate(10);
        return view('admin.tintuc.index',compact('tintucs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $danhmucs = Post_New_Categories::all();
        return view('admin.tintuc.create',compact('danhmucs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $names = Post_New::all();
        foreach($names as $name){
            if($name->name === $request->tieude){
                $obj = (object) array('status' => 0,'error'=>'Tên tiêu đề đã tồn tại');
                return json_encode($obj, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            }
        }
        if($request->hasFile('anh')){
            $file = $request->file('anh');
            $duoi = $file->getClientOriginalExtension();//lay ten duoi

            if($duoi !='jpg' && $duoi !='png' && $duoi !='jpeg' && $duoi !='PNG' && $duoi !='JPG' && $duoi != 'JPEG'){
                $obj = (object) array('status' => 0 ,'error'=>'Đuôi file phải là jpg hoặc png hoặc jpeg');
                return json_encode($obj, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            }
            $type_file = $file->getMimeType();//lay kieu file
            $name = $file->getClientOriginalName();//lay ten hinh
            $Hinh = $name;
            while(file_exists("images/tintuc/".$Hinh)){
                $obj = (object) array('status' => 0 ,'error'=>'Hình ảnh sản phẩm đã tồn tại');
                return json_encode($obj, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            }
             $file->move('images/tintuc/',$Hinh);
        }else{
            $Hinh = null;
        }
        $post_new = new Post_New();
        $post_new->title = $request->tieude;
        $post_new->synopsis = $request->tomtat;
        $post_new->slug = str_slug($request->tieude);
        $post_new->category_new_id = $request->danhmucid;
        $post_new->content = $request->noidung;
        $post_new->view = 0;
        if($Hinh != null){
            $post_new->image = "images/tintuc/".$Hinh;
        }else{
            $post_new->image = $Hinh;
        }
        $post_new->save();
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
        $new = Post_New::find($id);
        $lists = Post_New_Categories::all();
        return view('admin.tintuc.edit',compact('new','lists'));
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
        $post_new = Post_New::find($id);
        $post_new_id = Post_New::where('category_new_id',$request->danhmucid)->first();
        if(isset($post_new_id)){
            if($post_new->category_new_id != $post_new_id->category_new_id && $post_new_id->title == $request->tieude){
                $obj = (object) array('status' => 0,'error'=>'Tên tin tức đã tồn tại trong các bài viết');
                return json_encode($obj, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            }
        }
        if($post_new->image != null){
            if($request->hasFile('anh')){
                $file = $request->file('anh');
                $duoi = $file->getClientOriginalExtension();//lay ten duoi

                if($duoi !='jpg' && $duoi !='png' && $duoi !='jpeg' && $duoi !='PNG' && $duoi != 'JPEG'){
                    $obj = (object) array('status' => 0 ,'error'=>'Đuôi file phải là jpg hoặc png hoặc jpeg');
                    return json_encode($obj, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                }
                $type_file = $file->getMimeType();//lay kieu file
                $name = $file->getClientOriginalName();//lay ten hinh
                $Hinh = $name;
                while(file_exists("images/tintuc/".$Hinh)){
                    $obj = (object) array('status' => 0 ,'error'=>'Hình ảnh sản phẩm đã tồn tại');
                    return json_encode($obj, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                }
                 $file->move('images/tintuc/',$Hinh);
                 unlink($post_new->image);
                 $post_new->image = "images/tintuc/".$Hinh;
            }else{
                $Hinh = $post_new->image;
                $post_new->image = $Hinh;
            }      
        }else{
            if($request->hasFile('anh')){
                $file = $request->file('anh');
                $duoi = $file->getClientOriginalExtension();//lay ten duoi

                if($duoi !='jpg' && $duoi !='png' && $duoi !='jpeg' && $duoi !='PNG' && $duoi != 'JPEG'){
                    $obj = (object) array('status' => 0 ,'error'=>'Đuôi file phải là jpg hoặc png hoặc jpeg');
                    return json_encode($obj, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                }
                $type_file = $file->getMimeType();//lay kieu file
                $name = $file->getClientOriginalName();//lay ten hinh
                $Hinh = $name;
                while(file_exists("images/tintuc/".$Hinh)){
                    $obj = (object) array('status' => 0 ,'error'=>'Hình ảnh đã tồn tại');
                    return json_encode($obj, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                }
                 $file->move('images/tintuc/',$Hinh);
                 $post_new->image = "images/tintuc/".$Hinh;
            }else{
                $Hinh = $post_new->image;
                $post_new->image = $Hinh;
            }      
        }  
        $post_new->title = $request->tieude;
        $post_new->synopsis = $request->tomtat;
        $post_new->slug = str_slug($request->tieude);
        $post_new->category_new_id = $request->danhmucid;
        $post_new->content = $request->noidung;
        $post_new->save();
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
        $post_new = Post_New::find($id);
        $post_new->delete();
        if($post_new->image){unlink($post_new->image);}
        $obj = (object) array('status' => 1);
        return json_encode($obj, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
    public function back(){
        return redirect()->route('list_new');
    }
    public function search_new($ten_tieude,$ten_chude,$page,$limit){
        $query = DB::table('post_new as tt')->select('tt.id', 'tt.title','tt.slug', 'tt.image','tt.content','tt.view','dm.name as TenDanhMucCha', 'tt.category_new_id')->leftJoin('post_new_category as dm', 'tt.category_new_id', '=', 'dm.id');
        if($ten_tieude != 'all'){
            $query = $query->where('tt.slug', 'like' ,'%'.$ten_tieude.'%')->orWhere('tt.title', 'like' ,'%'.$ten_tieude.'%');
        }   
         
        if($ten_chude != 'all'){ 
            $danhmucs = Post_New_Categories::where('name', 'like', '%'.$ten_chude.'%')->pluck('id')->toArray();
            $query = $query->whereIn('tt.category_new_id', $danhmucs);   
        }
        $danhsachs = $query->get();
        $total = ceil((float)count($danhsachs) / (float)$limit);
        $skip = ($page - 1) * $limit;
        $danhsachs = $query->limit($limit)->offset($skip)->get();
        $obj = (object) array('status' => 1,'data' => $danhsachs,'total'=>$total);
        return json_encode($obj, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}
