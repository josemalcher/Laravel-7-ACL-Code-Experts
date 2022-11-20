<?php

namespace App\Http\Controllers;

use App\Thread;
use Illuminate\Http\Request;


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
            $this->thread->create($request->all());
            dd('topico criado com sucesso');
        } catch (\Exception $e) {
            dd($e->getMessage());
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

        if(!$thread) return redirect()->route('threads.index');

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
            dd('topico ATUALIZADO com sucesso');
        } catch (\Exception $e) {
            dd($e->getMessage());
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
            dd('topico REMOVIDO com sucesso');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
