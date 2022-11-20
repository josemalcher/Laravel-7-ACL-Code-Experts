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
                    <a href="{{route('threads.edit', $thread->slug)}}" class="btn btn-sn btn-danger">Deletar</a>
                </div>
            </div>
            <hr>
        </div>
    </div>
@endsection
