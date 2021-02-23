@extends('adminlte::page')

@section('title', 'Perfis')

@section('content_header')
    <h1>Permissões</h1>
    <div class="text-right">
        <a href="{{ route('permissions.create') }}" class="btn btn-dark" title="Adicionar Perfil"><i class="fas fa-plus-square fa-1x"></i></a>
    </div>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.index') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="{{ route('permissions.index') }}">Perfils</a>
        </li>
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
                   @foreach ($permissions as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->description }}</td>
                        <td class="text-right">
                        <a href="{{ route('permissions.edit',$permission->id) }}" class="btn btn-info mr-1">Editar</a>
                        <a href="{{ route('permissions.show',$permission->id) }}" class="btn btn-warning">Ver</a>
                       <a href="{{ route('permissions.profiles',$permission->id) }}" class="btn btn-primary"><i class="fas fa-address-book "></i></a>
                        </td>
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
