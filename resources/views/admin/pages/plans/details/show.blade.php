@extends('adminlte::page')

@section('title', "Detalhes {$detail->name}")

@section('content_header')
    <h1>Detalhes {{$detail->name}}</h1>
    <div class="text-right">
        <a href="{{ route('plans.create') }}" class="btn btn-dark" title="Editar detalhe do Plano"><i class="fas fa-plus-square fa-1x"></i></a>
    </div>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a> </li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.show', $plan->url) }}">{{ $plan->name }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('details.plan.index', $plan->url) }}">Detalhes</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('details.plan.edit', [$plan->url,$detail->id]) }}">Detalhes</a></li>
    </ol>
@stop
@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li><strong>Nome:</strong> {{ $detail->name }}</li>
            </ul>
        </div>
        <div class="card-footer">
            <form  action="{{ route('details.plan.destroy',[$plan->url,$detail->id]) }}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">Deletar o Detalhe {{ $detail->name }}</button>
            </form>
        </div>
        </div>
@endsection
