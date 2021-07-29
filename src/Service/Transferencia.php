<?php

namespace ProjetoTeste\Service;

class Transferencia
{

    private Deposito $deposito;
    private Saque $saque;
    private BuscaSaldo $buscaSaldo;

    public function __construct(Saque $saque, Deposito $deposito, BuscaSaldo $buscaSaldo)
    {
        $this->saque = $saque;
        $this->deposito = $deposito;
        $this->buscaSaldo = $buscaSaldo;
    }

    public function transferir($valor)
    {
        if ($this->buscaSaldo->buscaSaldoCarteira() < $valor)
            throw new \InvalidArgumentException("Saldo insuficiente");
        $this->saque->saqueCarteira($valor);
        $this->deposito->depositoCarteira($valor);
    }

}