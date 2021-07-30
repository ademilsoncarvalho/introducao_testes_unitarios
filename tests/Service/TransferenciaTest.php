<?php

namespace ProjetoTeste\Tests\Service;

use ProjetoTeste\Model\Carteira;
use ProjetoTeste\Model\Transacao;
use ProjetoTeste\Service\BuscaSaldo;
use ProjetoTeste\Service\Deposito;
use ProjetoTeste\Service\Saque;
use ProjetoTeste\Service\Transferencia;
use PHPUnit\Framework\TestCase;

class TransferenciaTest extends TestCase
{
    public function testInstanciaTransferenciaComSucesso() {

        $origem = new Carteira();
        $deposito = new Deposito();
        $deposito->depositoCarteira($origem,70);
        $destino = new Carteira();

        $buscaSaldo = new BuscaSaldo();
        $saque = new Saque($buscaSaldo);
        $transferencia = new Transferencia($buscaSaldo, $saque, $deposito);
        $resposta = $transferencia->transferir($origem, $destino, 70);

        self::assertCount(2, $resposta);
        self::assertInstanceOf(Transacao::class, $resposta['origem']);
        self::assertInstanceOf(Transacao::class, $resposta['destino']);

    }

    public function testValorPositivoTransferenciaComSucesso() {

        $origem = new Carteira();
        $deposito = new Deposito();
        $deposito->depositoCarteira($origem,70);
        $destino = new Carteira();

        $buscaSaldo = new BuscaSaldo();
        $saque = new Saque($buscaSaldo);
        $transferencia = new Transferencia($buscaSaldo, $saque, $deposito);
        $resposta = $transferencia->transferir($origem, $destino, 70);

        self::assertEquals($resposta['origem']->getValor(), 70);
        self::assertEquals($resposta['destino']->getValor(), 70);

    }


    public function testTipoTransferenciaComSucesso() {

        $origem = new Carteira();
        $deposito = new Deposito();
        $deposito->depositoCarteira($origem,70);
        $destino = new Carteira();

        $buscaSaldo = new BuscaSaldo();
        $saque = new Saque($buscaSaldo);
        $transferencia = new Transferencia($buscaSaldo, $saque, $deposito);
        $resposta = $transferencia->transferir($origem, $destino, 70);

        self::assertEquals($resposta['origem']->getTipo(), Transacao::SAIDA);
        self::assertEquals($resposta['destino']->getTipo(), Transacao::ENTRADA);

    }

}
