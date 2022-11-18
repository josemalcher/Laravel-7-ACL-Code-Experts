@extends('layouts.app')

@section('content')

    @forelse($threads as $thread)

    @empty
        <div class="alert alert-warning">
            Nenhum tópico encontrado
        </div>

    @endforelse

@endsection
