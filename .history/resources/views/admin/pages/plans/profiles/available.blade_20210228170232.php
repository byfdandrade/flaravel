@extends('adminlte::page')

@section('title', 'Permissões Disponíveis para o Perfil')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.index') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('plans.index') }}">Planos</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('plans.profiles', $plan->id) }}">Planos</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="{{ route('plans.profiles.available', $plan->id) }}">Perfils</a>
        </li>
    </ol>
    <h1>Perfils Disponíveis para o Plano - {{ $plan->name  }}</h1>
    <div class="text-right">

    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
          <form action="{{route('plans.profiles.available', $plan->id)}}" method="POST" class="form form-inline">
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
                       <th width="50px">#</th>
                       <th>Nome</th>
                   </tr>
               </thead>
               <tbody>
                   <form action="{{route('plans.profiles.attach', $plan->id)}}" method="POST">
                       @csrf
                       @foreach ($profiles as $profile)

                       <tr>
                           <td>
                               <input type="checkbox" name="permissions[]" value="{{$profile->id}}">
                           </td>
                           <td>
                               {{$profile->name}}
                           </td>
                       </tr>

                       @endforeach
                       <tr>
                           <td colspan="500">
                            <button type="submit" class="btn btn-success">Vincular</button>
                           </td>
                       </tr>
                   </form>
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
