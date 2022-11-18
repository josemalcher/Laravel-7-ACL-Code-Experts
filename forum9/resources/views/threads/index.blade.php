@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <h2>Tópicos</h2>
            <hr>
        </div>
        <div class="col-12">
            @forelse($threads as $thread)

            @empty
                <div class="alert alert-warning">
                    Nenhum tópico encontrado
                </div>

            @endforelse
        </div>
    </div>

@endsection
