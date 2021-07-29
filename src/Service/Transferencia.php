<?php

namespace ProjetoTeste\Service;

use ProjetoTeste\Model\Carteira;

class Transferencia
{
    private Carteira $destino;

    private Carteira $origem;

    public function __construct(Carteira $origem, Carteira $destino)
    {
        $this->origem = $origem;
        $this->destino = $destino;
    }

    public function transferir($valor)
    {
        $buscaSaldo = new BuscaSaldo();
        if ($buscaSaldo->buscaSaldoCarteira($this->origem) < $valor)
            throw new \InvalidArgumentException("Saldo insuficiente");

        $saque = new Saque($this->origem, $buscaSaldo);
        $transacaOrigem = $saque->saqueCarteira($valor);
        $deposito = new Deposito($this->destino);
        $transacaDestino = $deposito->depositoCarteira($valor);

        return [
            'origem' => $transacaOrigem,
            'destino' => $transacaDestino
        ];

    }

}
