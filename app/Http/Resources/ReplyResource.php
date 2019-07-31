<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReplyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[
          'id'=>$this->id,
          'question'=>$this->question->body,
          'question_id'=>$this->question_id,
          'likes'=>$this->like,
          'jumlah_like'=>$this->like->count(),
          'reply'=>$this->body,
          'user'=>$this->user->name,
          'user_id'=>$this->user_id,
          'created_at'=>$this->created_at->diffForHumans()
        ];
    }
}
