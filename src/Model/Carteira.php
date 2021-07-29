<?php

namespace ProjetoTeste\Model;

class Carteira
{

    /** @var Transacao[] */
    private $transacoes = [];

    /**
     * @return Transacao[]
     */
    public function getTransacoes(): array
    {
        return $this->transacoes;
    }

    public function adicionaTransacao(Transacao $transacao): void
    {
        $this->transacoes[] = $transacao;
    }

}
