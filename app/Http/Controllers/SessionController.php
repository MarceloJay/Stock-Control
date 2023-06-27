<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{
    
    function session($key = null, $default = null)
    {
        echo "<h1>Teste session</h1>";
        die();
        // Se nenhum argumento for passado, retorna toda a sessão
        if ($key === null) {
            return Session::all();
        }

        // Se o valor for passado, armazena na sessão
        if ($default !== null) {
            Session::put($key, $default);
            return;
        }

        // Obtém o valor da sessão com base na chave
        if (Session::has($key)) {
            return Session::get($key);
        }

        // Valor padrão a ser retornado se a chave não existir na sessão
        return $default;
    }
}
