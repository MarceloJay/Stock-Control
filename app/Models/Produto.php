<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = [
        'nome',
        'descricao',
        'categoria',
        'embalagem',
        'quantidade_embalagem',
        'unidades',
        'user_id', // Adicione a coluna 'user_id' aos fillable
    ];

    protected $casts = [
        'quantidade_embalagem' => 'integer',
        'unidades' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCategoriaLabelAttribute()
    {
        // Defina os rótulos correspondentes às categorias
        $categorias = [
            'bebidas' => 'Bebidas',
            'alimentos' => 'Alimentos',
            'limpeza' => 'Produtos de Limpeza',
            // Adicione mais categorias conforme necessário
        ];

        return $categorias[$this->categoria] ?? 'N/A';
    }

    public function getEmbalagemLabelAttribute()
    {
        // Defina os rótulos correspondentes às opções de embalagem
        $embalagens = [
            'fardo' => 'Fardo',
            'caixa' => 'Caixa',
            'unitario' => 'Unitário',
            // Adicione mais opções de embalagem conforme necessário
        ];

        return $embalagens[$this->embalagem] ?? 'N/A';
    }

    public function getQuantidadeTotalAttribute()
    {
        $unidadesPorEmbalagem = [
            'fardo' => [4, 5, 6, 9, 8, 10, 12, 20, 24],
            'caixa' => [4, 5, 6, 9, 8, 10, 12, 20, 24],
        ];

        if (array_key_exists($this->embalagem, $unidadesPorEmbalagem)) {
            $opcoesEmbalagem = $unidadesPorEmbalagem[$this->embalagem];
            $unidades = $opcoesEmbalagem[array_rand($opcoesEmbalagem)];
            return $this->quantidade_embalagem * $unidades;
        } else {
            return $this->quantidade_embalagem;
        }
    }
}

