<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutosController extends Controller
{
    public function index(Request $request)
    {
        $selectedCategoria = $request->query('categoria'); // Obtém a categoria selecionada da query string

        $query = Produto::query();
        if ($selectedCategoria) {
            $query->where('categoria', $selectedCategoria);
        }

        $totalProdutos = $query->count();
        $produtosPorPagina = 10;
        $produtos = $query->paginate($produtosPorPagina);
        $categorias = Produto::distinct()->pluck('categoria');

        return view('produtos.index', compact('produtos', 'categorias', 'selectedCategoria', 'totalProdutos'));
    }


    // Método para exibir um produto específico
    public function show($id)
    {
        // Sua lógica para obter o produto com o ID informado e passá-lo para a view
    }

    // Método para criar um novo produto
    public function create()
    {
        // Sua lógica para exibir o formulário de criação de produtos
        return view('create');
    }

    // Método para salvar o novo produto no banco de dados
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nome' => 'required|string',
                'categoria' => 'required|string|in:bebidas,alimentos,pizzaria,sushi,limpeza',
                'embalagem' => 'required|string|in:fardo,caixa,unitario',
                'quantidade_embalagem' => 'required|integer|min:1',
                'unidades' => 'required|integer|min:1',
            ]);
            
            $produtoExistente = Produto::where('embalagem', $request->input('embalagem'))
                ->where('quantidade_embalagem', $request->input('quantidade_embalagem'))
                ->where('categoria', $request->input('categoria'))
                ->where('nome', $request->input('nome'))
                ->first();
            if ($produtoExistente) {
                $produtoExistente->unidades += $request->input('unidades');
                $produtoExistente->save();
            } else {
                $produto = new Produto([
                    'nome' => $request->input('nome'),
                    'descricao' => $request->input('descricao'),
                    'categoria' => $request->input('categoria'),
                    'embalagem' => $request->input('embalagem'),
                    'quantidade_embalagem' => $request->input('quantidade_embalagem'),
                    'unidades' => $request->input('unidades'),
                ]);
                
                $produto->save();
            }
            return redirect()->route('produtos.create')->with('successMessage', 'Produto cadastrado com sucesso!');
        } catch (QueryException $e) {
            return redirect()->route('produtos.create')->with('errorMessage', 'Erro ao cadastrar o produto. Por favor, tente novamente.');
        } catch (\Exception $e) {
            return redirect()->route('produtos.create')->with('errorMessage', 'Ocorreu um erro inesperado. Por favor, tente novamente.');
        }
    }



    // Método para exibir o formulário de edição de um produto
    public function edit($id)
    {
        // Sua lógica para obter o produto com o ID informado e passá-lo para o formulário de edição
    }

    // Método para atualizar os dados de um produto no banco de dados
    public function update(Request $request, $id)
    {
        // Sua lógica para validar os dados do formulário e atualizar o produto com o ID informado
    }

    // Método para excluir um produto do banco de dados
    public function destroy($id)
    {
        // Sua lógica para excluir o produto com o ID informado do banco de dados
    }
}
