<?php

namespace App\Http\Controllers;

use App\Model\Question;
use App\Model\Reply;
use App\User;
use App\Http\Resources\ReplyResource;
use Illuminate\Http\Request;
use App\Notifications\ReplyNotification;

class ReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('jwt', ['except' => ['index']]);
    }

    public function index(Question $question)
    {
        return ReplyResource::collection($question->replies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Question $question ,Request $request)
    {
          $reply = $question->replies()->create($request->all());
          $user = User::find(auth()->id());
          $user->notify(new ReplyNotification($reply));
        return response(new ReplyResource($reply),201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question,Reply $reply)
    {
      return new ReplyResource($reply);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Question $question,Request $request, Reply $reply)
    {
       $reply->update($request->all());
      return response(new ReplyResource($reply),200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question, Reply $reply)
    {
        $reply->delete();
        return response('Deleted',200);
    }
}
