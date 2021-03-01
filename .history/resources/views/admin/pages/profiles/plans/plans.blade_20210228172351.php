@extends('adminlte::page')

@section('title', 'Perfis')

@section('content_header')
    <h1>Planos do Perfil: <b>{{$plan->name}}</b></h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a> </li>
        <li class="breadcrumb-item"><a href="{{ route('profiles.index') }}">Perfils</a> </li>
        <li class="breadcrumb-item active"><a href="{{ route('profiles.plans') }}">Planos</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
          <form action="{{ route('permissions.search') }}" method="POST" class="form form-inline">
              @csrf
            <input type="text" name="filter" placeholder="Filtro" class="form-control" value="{{ $filters['filter'] ?? '' }}">
            <button type="submit" class="btn btn-dark">Filtrar</button>
          </form>
        </div>
        <div class="card-body">
            @include('admin.includes.alerts')
           <table class="table table-hover">
               <thead>
                   <tr>
                       <th>Nome</th>
                       <th>Descrição</th>
                       <th class="text-right">Ações</th>
                   </tr>
               </thead>
               <tbody>
                   @foreach ($plans as $plan)
                    <tr>
                        <td>{{ $plan->name }}</td>
                        <td>{{ $plan->description }}</td>
                        <td class="text-right">
                        <a href="{{route('plans.profile.detach',[$plan->id, $profile->id])}}" class="btn btn-danger mr-1">Desvicular</a>
                        </td>
                    </tr>
                   @endforeach
               </tbody>
           </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
            {!! $plans->appends($filters)->links() !!}
        @else
            {!! $plans->links() !!}
        @endif
        </div>
    </div>
@stop
