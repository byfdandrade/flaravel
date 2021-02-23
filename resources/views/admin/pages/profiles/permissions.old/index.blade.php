@extends('adminlte::page')

@section('title', 'Permissões do Perfil')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.index') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="{{ route('profiles.index') }}">Permissões do Perfil</a>
        </li>
    </ol>
    <h1>Permissões do Perfil - {{ $profile->name  }}</h1>
    <div class="text-right">
        <a href="{{ route('profiles.permissions.available', $profile->id) }}" class="btn btn-dark" title="Adicionar Nova Permissão"><i class="fas fa-plus-square fa-1x"></i></a>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
          <form action="{{ route('profiles.search') }}" method="POST" class="form form-inline">
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
                   </tr>
               </thead>
               <tbody>
                   @foreach ($permissions as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                    </tr>
                   @endforeach
               </tbody>
           </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
            {!! $permissions->appends($filters)->links() !!}
        @else
            {!! $permissions->links() !!}
        @endif
        </div>


    </div>

@stop
