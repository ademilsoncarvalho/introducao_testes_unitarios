<?php

namespace ProjetoTeste\Tests\Service;

use ProjetoTeste\Model\Carteira;
use ProjetoTeste\Model\Transacao;
use ProjetoTeste\Service\Deposito;
use ProjetoTeste\Service\Transferencia;
use PHPUnit\Framework\TestCase;

class TransferenciaTest extends TestCase
{
    public function testTransferenciaComSucesso() {

        $origem = new Carteira();
        $servicoDeposito = new Deposito($origem);
        $servicoDeposito->depositoCarteira(70);
        $destino = new Carteira();

        $transferencia = new Transferencia($origem, $destino);
        $resposta = $transferencia->transferir(70);

        self::assertCount(2, $resposta);
        self::assertInstanceOf(Transacao::class, $resposta['origem']);
        self::assertInstanceOf(Transacao::class, $resposta['destino']);

        self::assertEquals($resposta['origem']->getValor(), 70);
        self::assertEquals($resposta['destino']->getValor(), 70);

        self::assertEquals($resposta['origem']->getTipo(), Transacao::SAIDA);
        self::assertEquals($resposta['destino']->getTipo(), Transacao::ENTRADA);

    }

}
