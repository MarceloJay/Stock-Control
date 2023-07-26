@extends('layouts.sidebar')

</html>
<!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"> -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" />    
<div class="container" >
    <body>    
        <h1 style="display: block; margin-top:50px;">Lista de Produtos</h1>
        <div class="row" style="margin-right:0px;">
            <div id="store-filters" class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="search-input">
                <a id="btn-search" class="btn btn-info">Pesquisar</a>
                <select id="categoria" name="categoria">
                    <option value="" selected disabled>Selecione a Categoria</option>
                    <option value="">Todos</option> 
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria }}">{{ ucfirst($categoria) }}</option>
                    @endforeach
                </select>
            </div> 
        </div>		
      
        
        @if (session('errorMessage'))
            <div class="alert alert-danger">
                {{ session('errorMessage') }}
            </div>
        @endif

        @if ($produtos !== null && count($produtos) > 0)
            <table class="table table-striped table-bordered dt-responsive nowrap">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Categoria</th>
                        <th>Embalagem</th>
                        <th>Quantidade Embalagem</th>
                        <th>Unidades</th>
                        <th>Quantidade Total</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produtos as $produto)
                            <tr class="categoria-row" data-categoria="{{ $produto->categoria }}">
                                <td>{{ $produto->nome }}</td>
                                <td>{{ $produto->descricao }}</td>
                                <td>{{ $produto->categoria }}</td>
                                <td>{{ $produto->embalagem }}</td>
                                <td>{{ $produto->quantidade_embalagem }}</td>
                                <td class="display-mode">{{ $produto->unidades }}</td>
                                <td class="edit-mode" style="display: none; width: 100px; text-align: center;">
                                    <input type="number" class="form-control" value="{{ $produto->unidades }}" />
                                </td>
                                <td style="text-align:right;">{{ $produto->quantidadeTotal }}</td>
                                <td class="justify-content flex-end text-right">
                                <button type="button" class="btn btn-success edit-button" data-toggle="modal" data-target="#editModal" data-produto-id="{{ $produto->id }}" data-produto-nome="{{ $produto->nome }}" data-produto-embalagem="{{ $produto->embalagem }}"  data-produto-countembalagem="{{ $produto->quantidade_embalagem }}" data-produto-unidades="{{ $produto->unidades }}">Adicionar</button>
                                <form action="" method="POST" style="display: inline" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <!-- <button type="submit" class="btn btn-danger delete-button" onclick="return confirm('Tem certeza?')">Excluir</button> -->
                                    <button type="submit" class="btn btn-danger delete-button d-inline-block mb-2 mb-md-0" onclick="return confirm('Tem certeza?')">Excluir</button>


                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination-container full-right">
                {{ $produtos->links('layouts.pagination') }}
            </div>
        @else
            <p>Nenhum pagamento encontrado.</p>
        @endif
        
    </body> 
</div> 

<!-- Modal de Edição -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Adicionar Produto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editForm">
          <div class="form-group">
            <label for="nome">Nome do Produto:</label>
            <input type="text" id="produtoNomeInput" class="form-control" readonly>
          </div>
          <div class="form-group">
            <label for="Embalagem">Embalagem:</label>
            <input type="text" id="produtoEmbalagem" class="form-control" readonly>
          </div>
          <div class="form-group">
            <label for="quantidade_embalagem">Quantidade por embalagem:</label>
            <input type="text" id="produtoCountEmbalagem" class="form-control" readonly>
          </div>
          <div class="form-group">
            <label for="unidades">Unidades:</label>
            <input type="number" id="produtoUnidadesInput" class="form-control">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="saveChangesButton">Salvar Alterações</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal Teste -->



<style>
    .container {
        /* background-color: beige; */
        /* border: 1px solid red; */
        /* width: 1600px; */
        display: block;
        /* margin-right: 0; */
        margin-left: 250;
    }
    /* Estilo para a tabela */
    table {
        border-collapse: collapse;
        margin-top: 20px;
        margin-right: 0; 
    }

    /* Estilo para o cabeçalho da tabela */
    .table th {
        background-color: #f2f2f2;
        border: 1px solid #ccc;
        padding: 8px;
        text-align: center;
    }

    /* Estilo para as células da tabela */
    .table td {
        text-align: center;
        border: 1px solid #ccc;
        padding: 3;
    }

    .pagination-container {
        display: flex;
        justify-content: flex-end;
        margin-top: 20px;
    }

    .pagination {
        display: flex;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .pagination li {
        margin-right: 5px;
    }

    .pagination li a {
        display: inline-block;
        padding: 5px 10px;
        background-color: #f0f0f0;
        color: #333;
        text-decoration: none;
        border-radius: 3px;
    }

    .pagination li a:hover {
        background-color: #ccc;
    }

    #store-filters { 
        margin-bottom: 16px;
    }
    #search-input {
        border-radius: 4px;
        margin-top: 20px;
        margin-bottom: 0px;
        margin-right: 8px;
    }
    #btn-search {
        margin-top: 0px;
        margin-bottom: 6px;
    }
    #store-filters { margin-bottom:10px; }
    #store-filters #search-input { width:280px; height:36px; text-align:center; border:1px solid #ddd; 
        font-size:16px; font-weight:200; color:#000; cursor:text; border:1px solid #5bc0de; }
    #categoria {
        width: 200px;
        height: 36px;
        margin-top: -42px;
        margin-left: 400px;
        text-align: center;
    }
    .btn-success {
        /* height: 30px; */
        font-size: 14px;
        text-align: center;
        margin-right: 10;
    } 
    .btn-danger {
        /* height: 30px; */
        font-size: 14px;
        text-align: center;
        margin-right: 10;
    }
</style>
<script>
    const editButton = document.querySelector(".edit-button");
    var editModal = document.querySelector('.fade');
    editButton.addEventListener("click", function () {
        // Obtém os dados do produto do botão clicado
        const produtoId = this.dataset.produtoId;
        const produtoNome = this.dataset.produtoNome;
        const produtoEmbalagem = this.dataset.produtoEmbalagem;
        const produtocountEmbalagem = this.dataset.produtoCountembalagem;

        // Preenche o formulário do modal com os dados do produto
        document.getElementById('produtoNomeInput').value = produtoNome;
        document.getElementById('produtoEmbalagem').value = produtoEmbalagem;
        document.getElementById('produtoCountEmbalagem').value = produtocountEmbalagem;

        // Abre o modal
        $("#editModal").modal({ show: true });
        // abreModal();
    });

    // document.getElementById('categoria').addEventListener('change', function() {
    //     const selectedCategoria = this.value;
    //     const rows = document.querySelectorAll('.categoria-row');

    //     const countRows = rows.length;
    //     alert(countRows);
        
    //     rows.forEach(row => {
    //         const categoriaRow = row.getAttribute('data-categoria');
    //         if (categoriaRow === selectedCategoria) {
    //             row.style.display = 'table-row';
    //         } else {
    //             row.style.display = 'none';
    //         }
    //     });

    // });

    let selectedCategoria = '';

    function filtrarPorCategoria() {
        const rows = document.querySelectorAll('.categoria-row');
        let totalRowsExibidas = 0;

        rows.forEach(row => {
            const categoriaRow = row.getAttribute('data-categoria');
            if (selectedCategoria === '' || categoriaRow === selectedCategoria) {
                row.style.display = 'table-row';
                totalRowsExibidas++;
            } else {
                row.style.display = 'none';
            }
        });
        
    }

    function atualizarURL(categoria) {
        const url = new URL(window.location.href);
        if (categoria === '') {
            url.searchParams.delete('categoria');
        } else {
            url.searchParams.set('categoria', categoria);
        }
        window.history.pushState({}, '', url);
    }

    document.getElementById('categoria').addEventListener('change', function() {
        selectedCategoria = this.value;
        if (selectedCategoria === '') {
            filtrarPorCategoria(); // Se selecionou "Todos", exibe todos os produtos
        } else {
            filtrarPorCategoria(); // Se selecionou uma categoria específica, filtra por essa categoria
        }
        atualizarURL(selectedCategoria);
    });

    // Captura o clique nos links de páginação e aplica o filtro novamente
    const paginacaoLinks = document.querySelectorAll('.pagination a');
    for (const link of paginacaoLinks) {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            const href = this.getAttribute('href');
            fetch(href)
                .then(response => response.text())
                .then(data => {
                    const parser = new DOMParser();
                    const newDocument = parser.parseFromString(data, 'text/html');
                    const newTable = newDocument.querySelector('.table');
                    document.querySelector('.table').outerHTML = newTable.outerHTML;
                    filtrarPorCategoria();
                    atualizarURL(selectedCategoria);
                });
        });
    }

    // Ao carregar a página, verifique se há parâmetro 'categoria' na URL e aplique o filtro correspondente
    const urlParams = new URLSearchParams(window.location.search);
    const categoriaParam = urlParams.get('categoria');
    if (categoriaParam) {
        selectedCategoria = categoriaParam;
        document.getElementById('categoria').value = selectedCategoria;
        filtrarPorCategoria();
    } else {
        // Se não houver filtro, exibe todos os produtos e deixa a opção "Selecione a Categoria" selecionada
        selectedCategoria = ''; // Limpa o filtro
        filtrarPorCategoria();
        document.getElementById('categoria').value = ''; // Define a opção padrão como selecionada
    }

    // ################################################################
    const filtroCategoria = document.getElementById('categoria');

    filtroCategoria.addEventListener('change', function() {
        const selectedCategoria = this.value;

        // Redireciona para a página com a categoria selecionada (selecione ou a categoria escolhida)
        window.location.href = `{{ route('produtos.index') }}?categoria=${selectedCategoria}`;
    });
    // Recriar paginator
    // function criarPaginacao(totalRows) {
        // alert(totalRows);
        // const paginacaoContainer = document.querySelector('.pagination-container');
        // paginacaoContainer.innerHTML = ''; // Limpa o conteúdo existente

        // const paginasNecessarias = Math.ceil(totalRows / 10); // Calcula o número de páginas necessárias (10 produtos por página)

        // for (let i = 1; i <= paginasNecessarias; i++) {
        // const link = document.createElement('a');
        // link.href = '?page=' + i; // Define o link para a página correspondente
        // link.textContent = i; // Texto do link é o número da página
        // if (i === 1) {
        //     link.classList.add('active'); // Marca a primeira página como ativa por padrão
        // }

        // link.addEventListener('click', function (event) {
        //     event.preventDefault();
        //     const href = this.getAttribute('href');
        //     fetch(href)
        //     .then(response => response.text())
        //     .then(data => {
        //         const parser = new DOMParser();
        //         const newDocument = parser.parseFromString(data, 'text/html');
        //         const newTable = newDocument.querySelector('.table');
        //         document.querySelector('.table').outerHTML = newTable.outerHTML;
        //         filtrarPorCategoria();
        //         atualizarURL(selectedCategoria);
        //         // Recalcula o paginador após atualizar a página com o filtro aplicado
        //         const rows = document.querySelectorAll('.categoria-row');
        //         criarPaginacao(rows.length);
        //     });
        // });

        // paginacaoContainer.appendChild(link);
        // }
    // }

    // ################################################################
    // let selectedCategoria = '';

    // function filtrarPorCategoria() {
    //     const rows = document.querySelectorAll('.categoria-row');
    //     const paginacaoLinks = document.querySelectorAll('.pagination a');

    //     rows.forEach(row => {
    //     const categoriaRow = row.getAttribute('data-categoria');
    //     if (selectedCategoria === '' || categoriaRow === selectedCategoria) {
    //         row.style.display = 'table-row';
    //     } else {
    //         row.style.display = 'none';
    //     }
    //     });

    //     paginacaoLinks.forEach(link => {
    //     link.addEventListener('click', function(event) {
    //         event.preventDefault();
    //         const href = this.getAttribute('href');
    //         fetch(href)
    //         .then(response => response.text())
    //         .then(data => {
    //             const parser = new DOMParser();
    //             const newDocument = parser.parseFromString(data, 'text/html');
    //             const newTable = newDocument.querySelector('.table');
    //             document.querySelector('.table').outerHTML = newTable.outerHTML;
    //             filtrarPorCategoria(); // Reaplica o filtro após mudar de página
    //         });
    //     });
    //     });
    // }

    // function contarRowsFiltradas() {
    //     const rows = document.querySelectorAll('.categoria-row');
    //     let totalRowsExibidas = 0;

    //     rows.forEach(row => {
    //     const categoriaRow = row.getAttribute('data-categoria');
    //     if (selectedCategoria === '' || categoriaRow === selectedCategoria) {
    //         totalRowsExibidas++;
    //     }
    //     });

    //     return totalRowsExibidas;
    // }

    // function criarPaginacao(totalRows) {
    //     // Implemente aqui a lógica para criar a paginação com o número correto de páginas
    //     // Total de rows é passado como parâmetro para esta função
    // }

    // document.getElementById('categoria').addEventListener('change', function() {
    //     selectedCategoria = this.value;
    //     filtrarPorCategoria();

    //     const totalRowsExibidas = contarRowsFiltradas();
    //     criarPaginacao(totalRowsExibidas);

    //     atualizarURL(selectedCategoria);
    // });

    // // Ao carregar a página, verifique se há parâmetro 'categoria' na URL e aplique o filtro correspondente
    // const urlParams = new URLSearchParams(window.location.search);
    // const categoriaParam = urlParams.get('categoria');
    // if (categoriaParam) {
    //     selectedCategoria = categoriaParam;
    //     document.getElementById('categoria').value = selectedCategoria;
    //     filtrarPorCategoria();
    // } else {
    //     // Se não houver filtro, exibe todos os produtos e deixa a opção "Selecione a Categoria" selecionada
    //     selectedCategoria = ''; // Limpa o filtro
    //     filtrarPorCategoria();
    //     document.getElementById('categoria').value = ''; // Define a opção padrão como selecionada
    // }


    
</script>








