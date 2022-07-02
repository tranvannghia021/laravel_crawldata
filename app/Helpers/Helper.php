<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Session;

class Helper{
    
   
    public static function category($datas){
        $html='';
        $datas=array_reverse($datas);
        foreach($datas as $key => $item){
            $html.='<tr>
            <td>'.++$key.'</td>
            <td>'.$item->name.'</td>
            <td>'.date ("d-m-Y", strtotime($item->created_at)).'</td>

            <td style="">
                <a href="'.route("categorys.edit",["id"=> $item->id]).'">
                    <button type="button" class="btn btn-info btn-circle btn-lg"><i class="fas fa-edit"></i></button>
                </a>
                <a href="'.route("categorys.delete",["id"=> $item->id]).'" >
                    <button class="btn btn-danger btn-circle btn-lg"><i class="fas fa-trash"></i></button>
                </a>
              
            </td>
          </tr>';
        }
        return $html;
    }
    public static function listPost($datas){
        $html='';
        foreach($datas as $key =>$item){
            $html.='<div class="father">
                        <div class="father__thumb">
                            <img src="'.$item->img.'" class="father__img" alt="">
                        </div>
                        <div class="father__content">
                            <div class="father__title">
                                <a href="#"><h3>'.$item->title.'</h3></a>
                            </div>
                            <div class="father__body">
                                <a href="#"><p>'.$item->description.'</p></a>
                            </div>
                        </div>
                        <div class="icon_btn">
                          <a href="'.route("crawls.edit",["id"=> $item->id]).'"><button type="button" class="btn btn-info">Sửa</button></a>
                          <form id="form-delete"method="delete">
                          <input type="hidden" name="_token" value="'.csrf_token().'" />
                          <input type="hidden" name="idDelete" value="' . $item->id . '" />
                          <button onclick="toggleClickRemove(\'/admin/crawls/destroy\')" type="button" class="btn btn-danger">Xóa</button></form>
                          <div class="status_post">Trạng thái: <p>'.$item->status.'</p></div>
                        </div>
                    </div>';
        }
        return $html;
    }
    public static function listPostClient($datas){
        $html='';
        foreach($datas as $key =>$item){
            $html.='<div class="father">
                        <div class="father__thumb">
                            <img src="'.$item->img.'" class="father__img" alt="">
                        </div>
                        <div class="father__content">
                            <div class="father__title">
                                <a href="'.route('posts.show',['id'=>$item->id]).'"><h3>'.$item->title.'</h3></a>
                            </div>
                            <div class="father__body">
                                <a href="'.route('posts.show',['id'=>$item->id]).'"><p>'.$item->description.'</p></a>
                            </div>
                        </div>
                        
                    </div>';
        }
        return $html;
    }
    public static function postDetail($datas){
        
       
            $html='<div class="text-center font-weight-bold">
                        <h1>'.$datas->title.'</h1>
                    </div>
                    <h4>'.$datas->description.'</h4>
                    <p>'.$datas->description_sub.'</p>';
      
        return $html;
    }
    
}
?>