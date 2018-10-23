<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Post;
use App\Model\Post_Categories;
use Illuminate\Support\Facades\DB;
use App\Model\Tag;
use App\Model\Tag_Post;

class TourDuLichController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post_travels = Post::paginate(10);
        return view('admin.tourdulich.index',compact('post_travels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        $danhmucs = Post_Categories::all();
        return view('admin.tourdulich.create',compact('danhmucs','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $names = Post::all();
        foreach($names as $name){
            if($name->title === $request->tieude){
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
            while(file_exists("images/tourdulich/".$Hinh)){
                $obj = (object) array('status' => 0 ,'error'=>'Hình ảnh sản phẩm đã tồn tại');
                return json_encode($obj, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            }
             $file->move('images/tourdulich/',$Hinh);
        }else{
            $Hinh = null;
        }
        $post_travel = new Post();
        $post_travel->title = $request->tieude;
        $post_travel->synopsis = $request->tomtat;
        $post_travel->slug = str_slug($request->tieude);
        $post_travel->category_id = $request->danhmucid;
        $post_travel->departure_location = $request->diadiem;
        $post_travel->trip_time = $request->thoigiandi;
        $post_travel->vehicle = $request->phuongtien;
        $post_travel->departure_time = $request->ngaydi;
        $post_travel->tour_schedule = $request->lichtrinh;
        $post_travel->price = $request->gia;
        $post_travel->rules = $request->dieukhoan;
        $post_travel->regulations = $request->quydinh;
        $post_travel->status = 0;
        if($Hinh != null){
            $post_travel->image = "images/tourdulich/".$Hinh;
        }else{
            $post_travel->image = $Hinh;
        }
        $post_travel->save();
        $id_tour = $post_travel->id;
        $tag_tens = explode(',',$request->tag_id);
        if($tag_tens[0] != "null"){
            foreach($tag_tens as $tag_ten){
                $tag = Tag::updateOrCreate([
                    'name' => $tag_ten,
                    'slug' => str_slug($tag_ten),
                ]);    
                $tag_tintuc = Tag_Post::create([
                    'post_id' => $id_tour,
                    'tag_id' => $tag->id,
                ]);
            }  
        }
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
        $new_travel = Post::find($id);
        $lists = Post_Categories::all();
        $tags = Tag::all();
        return view('admin.tourdulich.edit',compact('new_travel','lists','tags'));
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
        $post_travel = Post::find($id);
        $post_travel_id = Post::where('category_id',$request->danhmucid)->first();
        if(isset($post_new_id)){
            if($post_travel->category_id != $post_travel_id->category_id && $post_travel_id->title == $request->tieude){
                $obj = (object) array('status' => 0,'error'=>'Tên tour đã tồn tại trong các bài viết');
                return json_encode($obj, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            }
        }
        if($post_travel->image != null){
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
                while(file_exists("images/tourdulich/".$Hinh)){
                    $obj = (object) array('status' => 0 ,'error'=>'Hình ảnh sản phẩm đã tồn tại');
                    return json_encode($obj, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                }
                 $file->move('images/tourdulich/',$Hinh);
                 unlink($post_travel->image);
                 $post_travel->image = "images/tourdulich/".$Hinh;
            }else{
                $Hinh = $post_travel->image;
                $post_travel->image = $Hinh;
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
                while(file_exists("images/tourdulich/".$Hinh)){
                    $obj = (object) array('status' => 0 ,'error'=>'Hình ảnh đã tồn tại');
                    return json_encode($obj, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                }
                 $file->move('images/tourdulich/',$Hinh);
                 $post_travel->image = "images/tourdulich/".$Hinh;
            }else{
                $Hinh = $post_travel->image;
                $post_travel->image = $Hinh;
            }      
        }
        $post_travel->title = $request->tieude;
        $post_travel->synopsis = $request->tomtat;
        $post_travel->slug = str_slug($request->tieude);
        $post_travel->category_id = $request->danhmucid;
        $post_travel->departure_location = $request->diadiem;
        $post_travel->trip_time = $request->thoigiandi;
        $post_travel->vehicle = $request->phuongtien;
        $post_travel->departure_time = $request->ngaydi;
        $post_travel->tour_schedule = $request->lichtrinh;
        $post_travel->price = $request->gia;
        $post_travel->rules = $request->dieukhoan;
        $post_travel->regulations = $request->quydinh;
        $post_travel->save();
        $tag_tens = explode(',',$request->tag_id);
        $tag_tintucs = Tag_Post::where('post_id',$id)->delete();
        if($tag_tens[0] != "null"){
            foreach($tag_tens as $tag_ten){
                $tag = Tag::updateOrCreate([
                    'name' => $tag_ten,
                    'slug' => str_slug($tag_ten),
                ]);
                
                $tag_tintuc = Tag_Post::create([
                    'post_id' => $id,
                    'tag_id' => $tag->id,
                ]);       
            } 
        }     
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
        $post_travel = Post::find($id);
        $post_travel->delete();
        if($post_travel->image){unlink($post_travel->image);}
        $obj = (object) array('status' => 1);
        return json_encode($obj, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
    public function back(){
        return redirect()->route('list_travel');
    }
    public function search_travel($ten_tieude,$ten_chude,$page,$limit){
        $query = DB::table('post as tt')->select('tt.id', 'tt.title','tt.slug','tt.image','tt.departure_location','tt.trip_time','tt.vehicle','tt.departure_time','tt.tour_schedule','tt.price','tt.rules','tt.regulations','dm.name as TenDanhMucCha', 'tt.category_id')->leftJoin('post_category as dm', 'tt.category_id', '=', 'dm.id');
        if($ten_tieude != 'all'){
            $query = $query->where('tt.slug', 'like' ,'%'.$ten_tieude.'%')->orWhere('tt.title', 'like' ,'%'.$ten_tieude.'%');
        }   
         
        if($ten_chude != 'all'){ 
            $danhmucs = Post_Categories::where('name', 'like', '%'.$ten_chude.'%')->pluck('id')->toArray();
            $query = $query->whereIn('tt.category_id', $danhmucs);   
        }
        $danhsachs = $query->get();
        $total = ceil((float)count($danhsachs) / (float)$limit);
        $skip = ($page - 1) * $limit;
        $danhsachs = $query->limit($limit)->offset($skip)->get();
        $obj = (object) array('status' => 1,'data' => $danhsachs,'total'=>$total);
        return json_encode($obj, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
    public function status(Request $request,$id){
        $post_travel = Post::find($id);
        $post_travel->status = $request->status;
        $post_travel->save();
        $obj = (object) array('status' => 1);
        return json_encode($obj, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}
