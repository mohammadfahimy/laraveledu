<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    
    public function store(CommentRequest $request, Product $product)
    {

        $ss = $product->comments()->create([
            'user_id' => User::first()->id,
            'body' => $request->body,
        ]);
        return back()->with('success',__('message.Your_comment_hass_been_added_successfuly'));
    }

}
