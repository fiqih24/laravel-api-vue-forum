<?php

namespace App\Http\Controllers;

use App\Model\Like;
use App\Model\Reply;
use Illuminate\Http\Request;

class LikeController extends Controller
{
  public function __construct()
    {
        $this->middleware('jwt', ['except' => ['countLike']]);
    }
  public function LikeIt(Reply $reply){
    $reply->like()->create([
      'user_id'=>auth()->id()
    ]);
    return response($reply,201);
  }

  public function countLike(Reply $reply){
    $rep = $reply->like()->where('user_id',auth()->id())->count();
    return response($rep,200);
  }
  public function unLikeIt(Reply $reply){
    // $reply->like()->where('user_id',1)->delete();
    $reply->like()->where('user_id',auth()->id())->delete();
    return response('unLike It',201);
  }
  public function check_like(Reply $reply){
    $cek = $reply->like()->where('user_id',auth()->id())->count();
    return response($cek,200);
  }
}
