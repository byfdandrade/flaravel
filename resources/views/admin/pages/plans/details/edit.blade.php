@extends('adminlte::page')

@section('title', "Editar detalhe do Plano {$detail->name}")

@section('content_header')
    <h1>Adicionar novo detalhe ao Plano {{$detail->name}}</h1>
    <div class="text-right">
        <a href="{{ route('plans.create') }}" class="btn btn-dark" title="Editar detalhe do Plano"><i class="fas fa-plus-square fa-1x"></i></a>
    </div>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a> </li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.show', $plan->url) }}">{{ $plan->name }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('details.plan.index', $plan->url) }}">Detalhes</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('details.plan.edit', [$plan->url,$detail->id]) }}">Editar</a></li>
    </ol>
@stop
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('details.plan.update', [$plan->url,$detail->id]) }}" method="POST">
                @csrf
                @method('put')
                @include('admin.pages.plans.details._partials.form')

            </form>
        </div>
    </div>
@endsection
