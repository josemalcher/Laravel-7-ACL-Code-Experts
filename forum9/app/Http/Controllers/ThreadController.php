<?php

namespace App\Http\Controllers;

use App\Models\{User, Thread};
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ThreadController extends Controller
{
    private $thread;

    /**
     * @param $thread
     */
    public function __construct(\App\Models\Thread $thread)
    {
        $this->thread = $thread;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $threads = $this->thread->orderBy('created_at', 'DESC')->paginate(10);

        return view('threads.index', compact('threads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('threads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $thread = $request->all();
            $thread['slug'] = Str::slug($thread['title']);

            $user = User::find(1);
            $thread = $user->threads()->create($thread);

            //dd('topico criado com sucesso');

            flash('Tópico criado com sucesso')->success();
            return redirect()->route('threads.show', $thread->slug);

        } catch (\Exception $e) {

            $message = env('APP_DEBUG') ? $e->getMessage() : 'Erro ao processar a requisição';

            flash($message)->warning();

            return redirect()->back();

            //dd($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param string $thread
     * @return \Illuminate\Http\Response
     */
    public function show($thread)
    {

        $thread = $this->thread->whereSlug($thread)->first();

        if (!$thread) return redirect()->route('threads.index');

        return view('threads.show', compact('thread'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $thread
     * @return \Illuminate\Http\Response
     */
    public function edit($thread)
    {
        $thread = $this->thread->whereSlug($thread)->first();
        return view('threads.edit', compact('thread'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $thread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $thread)
    {
        try {
            $thread = $this->thread->whereSlug($thread)->first();
            $thread->update($request->all());
            //dd('topico ATUALIZADO com sucesso');

            flash('Tópico atualizado com sucesso')->success();
            return redirect()->route('threads.show', $thread->slug);

        } catch (\Exception $e) {
            $message = env('APP_DEBUG') ? $e->getMessage() : 'Erro ao processar a requisição';

            flash($message)->warning();

            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy($thread)
    {
        try {
            $thread = $this->thread->whereSlug($thread)->first();
            $thread->delete();
            // dd('topico REMOVIDO com sucesso');

            flash('Topico removido com sucesso')->success();

            return redirect()->route('threads.index');

        } catch (\Exception $e) {
            $message = env('APP_DEBUG') ? $e->getMessage() : 'Erro ao processar a requisição';

            flash($message)->warning();

            return redirect()->back();
        }
    }
}
