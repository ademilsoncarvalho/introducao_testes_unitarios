<?php

namespace ProjetoTeste\Service;

use ProjetoTeste\Model\Carteira;

class Transferencia
{
    private BuscaSaldo $buscaSaldo;

    private Saque $saque;

    private Deposito $deposito;

    /**
     * Transferencia constructor.
     *
     * @param \ProjetoTeste\Service\BuscaSaldo $buscaSaldo
     * @param \ProjetoTeste\Service\Saque $saque
     * @param \ProjetoTeste\Service\Deposito $deposito
     */
    public function __construct(BuscaSaldo $buscaSaldo, Saque $saque, Deposito $deposito)
    {
        $this->buscaSaldo = $buscaSaldo;
        $this->saque = $saque;
        $this->deposito = $deposito;
    }


    public function transferir(Carteira $origem, Carteira $destino, $valor)
    {
        if ($this->buscaSaldo->buscaSaldoCarteira($origem) < $valor)
            throw new \InvalidArgumentException("Saldo insuficiente");

        $transacaOrigem = $this->saque->saqueCarteira($origem, $valor);
        $transacaDestino = $this->deposito->depositoCarteira($destino, $valor);

        return [
            'origem' => $transacaOrigem,
            'destino' => $transacaDestino
        ];

    }

}
