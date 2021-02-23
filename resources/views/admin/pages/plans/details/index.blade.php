@extends('adminlte::page')

@section('title', "Detalhes do Plano {$plan->name}")

@section('content_header')
    <h1>Detalhes do Plano {{$plan->name}}</h1>
    <div class="text-right">
        <a href="{{ route('details.plan.create',$plan->url) }}" class="btn btn-dark" title="Adicionar Detalhe"><i class="fas fa-plus-square fa-1x"></i></a>
    </div>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a> </li>
        <li class="breadcrumb-item"><a href="{{ route('plans.show', $plan->url) }}">{{ $plan->name }}</a> </li>
        <li class="breadcrumb-item active"> <a href="{{ route('details.plan.index', $plan->url) }}">Detalhes</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @include('admin.includes.alerts')
           <table class="table table-hover">
               <thead>
                   <tr>
                       <th>Nome</th>
                       <th class="text-right">Ações</th>
                   </tr>
               </thead>
               <tbody>
                   @foreach ($details as $detail)
                    <tr>
                        <td>{{ $detail->name }}</td>
                        <td class="text-right">
                        <a href="{{ route('details.plan.edit',[$plan->url,$detail->id]) }}" class="btn btn-info mr-1">Editar</a>
                        <a href="{{ route('details.plan.show',[$plan->url,$detail->id]) }}" class="btn btn-warning">Ver</a>
                        </td>
                    </tr>
                   @endforeach
               </tbody>
           </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
            {!! $details->appends($filters)->links() !!}
        @else
            {!! $details->links() !!}
        @endif
        </div>


    </div>

@stop
