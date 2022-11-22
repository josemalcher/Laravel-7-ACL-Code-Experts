<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\ReplyRequest;

class ReplyController extends Controller
{
    public function store(ReplyRequest $request)
    {
        try {

            $reply = $request->all();
            $reply['user_id'] = 1;
            $thread = \App\Models\Thread::find($request->thread_id);
            $thread->replies()->create($reply);

            flash('Resposta criada com sucesso')->success();

            return redirect()->back();

        } catch (\Exception $e) {
            $message = env('APP_DEBUG') ? $e->getMessage() : 'Erro ao processar a requisição';

            flash($message)->warning();
            return redirect()->back();
        }
    }
}
