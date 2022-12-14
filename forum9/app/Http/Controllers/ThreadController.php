<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use App\Models\{User, Thread,Channel};
use Illuminate\Http\Request;
use App\Http\Requests\ThreadRequest;
use Illuminate\Support\Str;


class ThreadController extends Controller
{
    private $thread;

    /**
     * @param $thread
     */
    public function __construct(Thread $thread)
    {
        $this->thread = $thread;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Channel $channel)
    {
        // $this->authorize('access-index-forum');

        // if (!Gate::allows('access-index-forum')) {
//        if (Gate::denies('access-index-forum')) {
//            return dd('não tenho permissão');
//        }

        // $this->authorize('threads/index');

        $channelParam = $request->channel;

        if (null !== $channelParam) {
            $threads = $channel->whereSlug($channelParam)->first()->threads()->paginate(10);
        }else{
            $threads = $this->thread->orderBy('created_at', 'DESC')->paginate(10);
        }


        return view('threads.index', compact('threads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Channel $channel)
    {
        return view('threads.create', [
            'channels' => $channel->all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ThreadRequest $request)
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

        $this->authorize('update', $thread);

        return view('threads.edit', compact('thread'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $thread
     * @return \Illuminate\Http\Response
     */
    public function update(ThreadRequest $request, $thread)
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
