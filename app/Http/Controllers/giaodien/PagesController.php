<?php

namespace App\Http\Controllers\giaodien;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Post;
use App\Model\Post_New;
use App\Model\Post_Categories;
use App\Model\Post_New_Categories;
use App\Model\Tag;
use App\Helpers\Menu;
use Illuminate\Support\Facades\Mail;

class PagesController extends Controller
{
    public function __construct(){ 
        $tags = Tag::all();
        view()->share('tags',$tags); 
    }
    public function trangchu(){
        $danhmuc_tournuocngoais = Post_Categories::where('slug','tour-nuoc-ngoai')->pluck('id')->toArray();
        $post_nuocngoais =Post::whereIn('category_id', $danhmuc_tournuocngoais)->orderBy('created_at','DESC')->take(4)->get();
        $danhmuc_tourtrongnuocs = Post_Categories::where('slug', 'tour-trong-nuoc')->pluck('id')->toArray();
        $post_trongnuocs = Post::whereIn('category_id', $danhmuc_tourtrongnuocs)->orderBy('created_at','DESC')->take(4)->get();
        $post_highlights = Post::where('status',1)->orderBy('created_at','DESC')->get();
        $post_news = Post_New::orderBy('created_at','DESC')->take(4)->get();
        
        return view('giaodien.trangchu',compact('post_news','post_highlights','post_trongnuocs','post_nuocngoais'));
    }
    public function post($url,Request $request){
        $kiemtra = substr($url,0,4);
        if($url == 'search_tour'){
            if($request->text != null){
                $html = '';
                $tags = Tag::where('name', 'like', '%' . $request->text . '%')->get();
                $html .='<p class="title_s"><i class="fa fa-map-marker" aria-hidden="true"></i> Địa điểm </p>';
                foreach($tags as $tag){
                    if(count($tag->tag_tintuc) > 0){
                        $html .='<a class="place" href=" place/'.$tag->slug.' "> '.$tag->name.'<span><strong>'. count($tag->tag_tintuc) .'</strong> tours</span></a>';             
                    }
                }
                
                $tours = Post::where('title', 'like', '%' . $request->value . '%')->get();
                $html .='<p class="title_s"><i class="fa fa-paper-plane-o" aria-hidden="true"></i>TOUR</p>';
                foreach($tours as $tour){
                    $html .='<a class="place" href=" tour-'.$tour->slug.' "> '.$tour->title.'</a>';             
                }
            }else{
                $tags = Tag::all();
                $html = '';
                $html .='<p class="title_s"><i class="fa fa-map-marker" aria-hidden="true"></i> Địa điểm HOT</p>';
                foreach($tags as $tag){
                if(count($tag->tag_tintuc) > 0){
                    $html .='<div class="place_img col-xs-12 col-sm-4">';    
                    $html .='<a class="place" href="place/'.$tag->slug.'"><img src="'.( $tag->tours->first() ? $tag->tours->first()->image : '').'" alt=" '.$tag->name.' " /></a>';
                    $html .='<a class="url" href="place/'.$tag->slug.' "> '.$tag->name.' <br/><span><strong>'.count($tag->tag_tintuc).'</strong> tours</span></a>';                                
                    $html .='</div>';
                    }
                }
            }
            
                return $html;
            
        }
        if($kiemtra == 'tour'){
            if($url == 'tour-trong-nuoc'){
                $danhmuc_tourtrongnuocs = Post_Categories::where('slug',$url)->pluck('id')->toArray();
                $posts = Post::whereIn('category_id', $danhmuc_tourtrongnuocs)->orderBy('created_at','DESC')->get();
                return view('giaodien.post',compact('posts'));
            }
            if($url == 'tour-nuoc-ngoai'){
                $danhmuc_tournuocngoais = Post_Categories::where('slug',$url)->pluck('id')->toArray();
                $posts =Post::whereIn('category_id', $danhmuc_tournuocngoais)->orderBy('created_at','DESC')->get();
                return view('giaodien.post',compact('posts'));
            }
            $url = substr($url,5);
            $post_tour =Post::where('slug', $url)->first(); 
            $abc = ' data-spy="scroll" data-target="#myScroll" ';
            return view('giaodien.chitiettour',compact('post_tour','abc'));
        }else{
            if($url == 'booking'){
                $tour = Post::find($request->tour);
                $num = $request->num;
                $price = (string)($tour->price * $num);  
                return view('giaodien.bookingtour',compact('tour','num','price'));
            }
            if($url == 'gioi-thieu'){
                return view('giaodien.gioithieu',compact('url'));
            }
            if($url == 'lien-he'){
                return view('giaodien.lienhe',compact('url'));
            }
            if($url == 'visa'){
                $danhmucs = Post_New_Categories::where('slug',$url)->pluck('id')->toArray();
            }
            if($url == 'thue-xe'){
                $danhmucs = Post_New_Categories::where('slug',$url)->pluck('id')->toArray();
            }
            if($url == 'to-chuc-su-kien'){
                $danhmucs = Post_New_Categories::where('slug',$url)->pluck('id')->toArray();
            }
            if($url == 'khach-san'){
                $danhmucs = Post_New_Categories::where('slug',$url)->pluck('id')->toArray();
            }
            if($url == 'tuyen-dung'){
                $danhmucs = Post_New_Categories::where('slug',$url)->pluck('id')->toArray();
            }
            if($url == 'blog-du-lich'){
                $danhmucs = Post_New_Categories::where('slug',$url)->pluck('id')->toArray();  
            }
            $post_news =Post_New::whereIn('category_new_id', $danhmucs)->orderBy('created_at','DESC')->paginate(6); 
            return view('giaodien.post_new',compact('post_news'));
        }  
    }
    public function booking_user(Request $request){
        $alls = $request->all();
        Mail::send('giaodien.mail_booking',(['detail'=>$alls]), function($message){ 
            $message->to("btdat1988@gmail.com")->subject('PhuonghoangTouris.vn');      
        });
        return redirect()->back()->with('thongbao','Bạn đã đặt tour thành công');
    }
    public function contact(Request $request){
        $alls = $request->all();
        Mail::send('giaodien.mail_contact',(['detail'=>$alls]), function($message){ 
            $message->to("btdat1988@gmail.com")->subject('PhuonghoangTouris.vn');      
        });
        return redirect()->back()->with('thongbao','Bạn đã liên hệ thành công.Chúng tôi sẽ liên hệ với bạn sớm nhất có thể');
    }
    public function tintuc($category,$url,Request $request){
        if($category == 'place'){
            $place = Tag::where('slug',$url)->first();
            $posts = $place->tours;
            return view('giaodien.post',compact('posts'));
        }else{
            if($category == 'visa'){
                $category_id = Post_New_Categories::where('slug',$category)->first()->id;
            }
            if($category == 'thue-xe'){
                $category_id = Post_New_Categories::where('slug',$category)->first()->id;
            }
            if($category == 'to-chuc-su-kien'){
                $category_id = Post_New_Categories::where('slug',$category)->first()->id;
            }
            if($category == 'khach-san'){
                $category_id = Post_New_Categories::where('slug',$category)->first()->id;
            }
            if($category == 'tuyen-dung'){
                $category_id = Post_New_Categories::where('slug',$category)->first()->id;
            }
            if($category == 'blog-du-lich'){
                $category_id = Post_New_Categories::where('slug',$category)->first()->id;
            }
            $post_new = Post_New::where('category_new_id', $category_id)->where('slug',$url)->orderBy('created_at','DESC')->first();
            $post_new->view = ($post_new->view +1);
            $post_new->save();
            $relate_news = Post_New::where('category_new_id', $category_id)->get();
            return view('giaodien.trangtintuc',compact('post_new','relate_news'));
        }
    }
}
