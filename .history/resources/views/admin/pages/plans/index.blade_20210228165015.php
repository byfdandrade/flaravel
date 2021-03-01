@extends('adminlte::page')

@section('title', 'Planos')

@section('content_header')
    <h1>Planos</h1>
    <div class="text-right">
        <a href="{{ route('plans.create') }}" class="btn btn-dark" title="Adicionar Plano"><i class="fas fa-plus-square fa-1x"></i></a>
    </div>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.index') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="{{ route('plans.index') }}">Planos</a>
        </li>
    </ol>

@stop

@section('content')
 <div class="card">
     <div class="card-header">
        <form action="{{ route('plans.search') }}" method="POST" class="form form-inline">
            @csrf
          <input type="text" name="filter" placeholder="Nome" class="form-control" value="{{ $filters['filter'] ?? '' }}">
          <button type="submit" class="btn btn-dark">Filtrar</button>
        </form>
     </div>
     <div class="card-body">
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th class="text-right" width="280px">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($plans as $plan)
                <tr>
                    <td>{{ $plan->name }}</td>
                    <td>R$ {{ number_format($plan->price,2,',','.') }}</td>
                    <td class="text-right">
                    <a href="{{route('details.plan.index', $plan->url)}}" class="btn btn-info mr-1">Detalhes</a>
                    <a href="{{route('plans.edit', $plan->url)}}" class="btn btn-info mr-1">Editar</a>
                    <a href="{{route('plans.show', $plan->url)}}" class="btn btn-warning">Ver</a>
                    <a href="{{route('plans.profiles', $plan->url)}}" class="btn btn-warning"><i class="fas fa-address-book "></i></a>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
     </div>
     <div class="card-footer">
            @if (isset($filters))
            {!! $plans->appends($filters)->links("pagination::bootstrap-4") !!}
        @else
        {!! $plans->links("pagination::bootstrap-4") !!}
        @endif
        </div>
 </div>

@stop
