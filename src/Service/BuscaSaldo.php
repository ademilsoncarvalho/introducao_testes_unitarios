<?php


namespace ProjetoTeste\Service;

use ProjetoTeste\Model\Carteira;
use ProjetoTeste\Model\Transacao;

class BuscaSaldo
{


    public function buscaSaldoCarteira(Carteira $carteira): float
    {

        $valorSaldo = 0;

        foreach ($carteira->getTransacoes() as $transacao) {

            if ($transacao->getTipo() == Transacao::ENTRADA)
                $valorSaldo += $transacao->getValor();
            else
                $valorSaldo -= $transacao->getValor();
        }

        return floatval($valorSaldo);
    }

}
