<?php


namespace ProjetoTeste\Service;


use ProjetoTeste\Model\Carteira;
use ProjetoTeste\Model\Transacao;

class Saque
{

    private BuscaSaldo $buscaSaldo;

    /**
     * Saque constructor.
     */
    public function __construct(BuscaSaldo $buscaSaldo)
    {
        $this->buscaSaldo = $buscaSaldo;
    }

    public function saqueCarteira(Carteira $carteira, $valor): Transacao
    {
        if ($this->buscaSaldo->buscaSaldoCarteira($carteira) < $valor)
            throw new \InvalidArgumentException("Nao possui saldo");

        $transacao = new Transacao();
        $transacao->setValor($valor);
        $transacao->setTipo(Transacao::SAIDA);
        $carteira->adicionaTransacao($transacao);
        return $transacao;
    }


}
