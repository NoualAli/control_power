<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * show specified resource
     *
     * @param App\Models\Comment $comment
     * @return JsonResponse
     **/
    public function show(Comment $comment)
    {
        return $comment;
    }
}
