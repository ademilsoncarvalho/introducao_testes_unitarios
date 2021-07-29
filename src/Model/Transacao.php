<?php

namespace ProjetoTeste\Model;

class Transacao
{

    const ENTRADA = 'E';
    const SAIDA = 'S';

    /** @var float */
    private $valor;
    /** @var String */
    private $tipo;

    /**
     * @return float
     */
    public function getValor(): float
    {
        return $this->valor;
    }

    /**
     * @param float $valor
     */
    public function setValor(float $valor): void
    {
        $this->valor = $valor;
    }

    /**
     * @return String
     */
    public function getTipo(): string
    {
        return $this->tipo;
    }

    /**
     * @param String $tipo
     */
    public function setTipo(string $tipo): void
    {
        $this->tipo = $tipo;
    }

}