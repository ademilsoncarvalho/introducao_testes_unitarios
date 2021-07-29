<?php


namespace ProjetoTeste\Service;


use ProjetoTeste\Model\Carteira;
use ProjetoTeste\Model\Transacao;

class Deposito
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

    public function depositoCarteira($valor): Carteira
    {
        if ($valor <= 0)
            throw new \InvalidArgumentException("Valor não pode ser inferior a zero");

        $transacao = new Transacao();
        $transacao->setValor($valor);
        $transacao->setTipo(Transacao::ENTRADA);
        $this->carteira->adicionaTransacao($transacao);
        return $this->carteira;
    }

}