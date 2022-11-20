<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function store(Request $request)
    {
        try {

            $reply = $request->all();
            $reply['user_id'] = 1;
            $thread = \App\Models\Thread::find($request->thread_id);
            $thread->replies()->create($reply);

            return redirect()->back();

        } catch (\Exception $exception) {
            return redirect()->back();
        }
    }
}
