<!DOCTYPE html>
@extends('headers.sidebar')
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <title>Cadastrar Produto</title>
</head>

<body>

  <div class="container d-flex justify-content-center mt-5">
    <div class="col-md-6">
      <h2 class="mb-4">Cadastrar Produto</h2>
      <form method="POST" action="{{ route('produtos.create') }}">
        @csrf

        <div class="form-group">
          <label for="nome">Nome do Produto:</label>
          <input type="text" id="nome" name="nome" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="descricao">Descrição do Produto:</label>
            <textarea id="descricao" name="descricao" class="form-control"></textarea>
        </div>


        <div class="form-group">
          <label for="categoria">Categoria:</label>
          <select id="categoria" name="categoria" class="form-control" required>
            <option value="bebidas">Bebidas</option>
            <option value="alimentos">Alimentos</option>
            <option value="limpeza">Produtos de Limpeza</option>
          </select>
        </div>

        <div class="form-group">
          <label for="embalagem">Embalagem:</label>
          <select id="embalagem" name="embalagem" class="form-control" required>
            <option value="fardo">Fardo</option>
            <option value="caixa">Caixa</option>
            <option value="unitario">Unitário</option>
          </select>
        </div>

        <div class="form-group">
          <label for="quantidade_embalagem">Quantidade na Embalagem:</label>
          <input type="number" id="quantidade_embalagem" name="quantidade_embalagem" class="form-control" required>
        </div>

        <div class="form-group">
          <label for="unidades">Unidades:</label>
          <input type="number" id="unidades" name="unidades" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Cadastrar Produto</button>
      </form>
    </div>
  </div>

</body>

</html>
