<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\Auth;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;
use App\Models\Produto;


class ApiProdutos extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return view('create');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function create(Request $request)
{
        var_dump($request->all());
        die();
        $userId = $request->all();
        // var_dump(Session::get('variableName'));
        // var_dump(session()->get('userId'));
        // session()->save();

        // var_dump(session('userId'));
        var_dump($userId);
        // die();
        // Valide os dados do formulário
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'categoria' => 'required|string',
            'embalagem' => 'required|string',
            'quantidade_embalagem' => 'required|integer',
            'unidades' => 'required|integer',
        ]);

        // Crie um novo produto com os dados validados
        $produto = Produto::create([
            'nome' => $validatedData['nome'],
            'descricao' => $validatedData['descricao'],
            'categoria' => $validatedData['categoria'],
            'embalagem' => $validatedData['embalagem'],
            'quantidade_embalagem' => $validatedData['quantidade_embalagem'],
            'unidades' => $validatedData['unidades'],
            'user_id' => $userId, // Obtenha o ID do usuário autenticado
        ]);

        // return response()->json(['message' => 'Produto gravado com sucesso!', 'produto' => $produto]);

        $url = route('home');
        return redirect($url);
    
}


}
