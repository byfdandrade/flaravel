@extends('adminlte::page')

@section('title', 'Perfis')

@section('content_header')
    <h1>Perfis do Plano: <b>{{$plan->name}}</b></h1>
    <div class="text-right">
        <a href="{{ route('plans.profiles.available', $plan->id) }}" class="btn btn-dark" title="Adicionar Perfil"><i class="fas fa-plus-square fa-1x"></i></a>
    </div>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a> </li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a> </li>
        <li class="breadcrumb-item active"><a href="{{ route('plans.profiles', $plan->id) }}" class="active">Perfis</a></li>
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
                   @foreach ($profiles as $profile)
                    <tr>
                        <td>{{ $profile->name }}</td>
                        <td>{{ $profile->description }}</td>
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
            {!! $profiles->appends($filters)->links() !!}
        @else
            {!! $profiles->links() !!}
        @endif
        </div>


    </div>

@stop
