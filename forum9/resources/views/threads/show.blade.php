@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <small>Criado por {{$thread->user->name}}</small>
                </div>
                <div class="card-body">
                    {{$thread->body}}
                </div>
                <div class="card-footer">
                    <small>{{$thread->created_at->diffForHumans()}}</small>
                </div>
            </div>
            <hr>
        </div>
    </div>
@endsection
