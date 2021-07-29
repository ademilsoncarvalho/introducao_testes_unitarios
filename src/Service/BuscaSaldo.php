<?php


namespace ProjetoTeste\Service;

use ProjetoTeste\Model\Carteira;
use ProjetoTeste\Model\Transacao;

class BuscaSaldo
{

    private Carteira $carteira;

    /**
     * Saque constructor.
     * @param Carteira $carteira
     */
    public function __construct(Carteira $carteira)
    {
        $this->carteira = $carteira;
    }

    public function buscaSaldoCarteira(): float
    {

        $valorSaldo = 0;

        foreach ($this->carteira->getTransacoes() as $transacao) {

            if ($transacao->getTipo() == Transacao::ENTRADA)
                $valorSaldo += $transacao->getValor();
            else
                $valorSaldo -= $transacao->getValor();
        }

        return floatval($valorSaldo);
    }

}