<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Requests\EditCommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentRequest $request)
    {
        Comment::create([
            'user_id' => $request->input('user_id'),
            'post_id' => $request->input('post_id'),
            'content' => $request->input('content'),
        ]);
        return redirect()->back()->with('status', 'Uspesno ostavljen komentar');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditCommentRequest $request, string $id)
    {
        Comment::findOrFail($id)->update(['content' => $request->input('content')]);
        return redirect()->back()->with('status', 'Uspesno promenjen komentar');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Comment::findOrFail($id)->delete();
        return redirect()->back()->with('status', 'Succesfully deleted comment.');
    }
}
