@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <h2>Tópicos</h2>
            <hr>
        </div>
        <div class="col-12">
            @forelse($threads as $thread)
                <div class="list-group">
                    <a href="{{ route('threads.show', $thread->slug) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        <div>
                            <h4>{{$thread->title}}</h4>
                            <h6><span class="badge bg-primary">{{$thread->channel->name}}</span></h6>
                            <small>Criado em {{$thread->created_at->diffForHumans()}} por {{ $thread->user->name }}</small>
                        </div>
{{--                        @can('access-index-forum')--}}
                            <span class="badge bg-info">{{$thread->replies->count()}}</span>
                        {{--@endcan--}}
                    </a>
                </div>
            @empty
                <div class="alert alert-warning">
                    Nenhum tópico encontrado
                </div>

            @endforelse

            {{$threads->links()}}

        </div>
    </div>

@endsection
