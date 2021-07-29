<?php


namespace ProjetoTeste\Service;


use ProjetoTeste\Model\Carteira;
use ProjetoTeste\Model\Transacao;

class Saque
{
    private Carteira $carteira;
    private BuscaSaldo $buscaSaldo;

    /**
     * Saque constructor.
     * @param Carteira $carteira
     */
    public function __construct(Carteira $carteira, BuscaSaldo $buscaSaldo)
    {
        $this->carteira = $carteira;
        $this->buscaSaldo = $buscaSaldo;
    }

    public function saqueCarteira($valor): Carteira
    {
        if ($this->buscaSaldo->buscaSaldoCarteira() < $valor)
            throw new \InvalidArgumentException("Nao possui saldo");

        $transacao = new Transacao();
        $transacao->setValor($valor);
        $transacao->setTipo(Transacao::SAIDA);
        $this->carteira->adicionaTransacao($transacao);
        return $this->carteira;
    }


}