@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <h2>{{$thread->title}}</h2>
            <hr>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <small>Criado por {{$thread->user->name}} - a {{$thread->created_at->diffForHumans()}}</small>
                </div>
                <div class="card-body">
                    {{$thread->body}}
                </div>
                <div class="card-footer">
                    <a href="{{route('threads.edit', $thread->slug)}}" class="btn btn-sn btn-primary">Editar</a>
                    <a href="#" class="btn btn-sn btn-danger"
                       onclick="event.preventDefault()
                       document.querySelector('form.thread-rm').submit()">
                        Remover</a>

                    <form action="{{route('threads.destroy', $thread->slug)}}"
                          class="thread-rm"
                          method="post" style="display: none">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
            <hr>
        </div>
        <div class="col-12">
            <h5>Respostas</h5>
            <hr>
        </div>

        <div class="col-12">
            <hr>
            <form action="{{route('replies.store')}}" method="post">

                @csrf
                <div class="form-group">
                    <input type="hidden" name="thread_id" value="{{$thread->id}}">
                    <label for="responder">Responder</label>
                    <textarea name="reply" cols="30" rows="5" class="form-control"></textarea>
                </div>
                <button type="submit">Responder</button>

            </form>
        </div>
    </div>
@endsection
