<?php


namespace ProjetoTeste\Service;


use ProjetoTeste\Model\Carteira;
use ProjetoTeste\Model\Transacao;

class Deposito
{

    public function depositoCarteira(Carteira $carteira, $valor): Transacao
    {
        if ($valor <= 0)
            throw new \InvalidArgumentException("Valor não pode ser inferior a zero");

        $transacao = new Transacao();
        $transacao->setValor($valor);
        $transacao->setTipo(Transacao::ENTRADA);
        $carteira->adicionaTransacao($transacao);
        return $transacao;
    }

}
