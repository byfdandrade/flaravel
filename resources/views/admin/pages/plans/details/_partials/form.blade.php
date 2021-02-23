@include('admin.includes.alerts')
<div class="form-group">
    <label for="nome">Nome:</label>
    <input type="text" name="name" class="form-control" placeholder="Nome" value="{{ $detail->name ?? old('name') }}">
</div>
<div class="form-group">
    <button type="submit" class="btn btn-dark">Salvar</button>
</div>
