<?php

namespace ProjetoTeste\Tests\Service;

use ProjetoTeste\Model\Carteira;
use ProjetoTeste\Model\Transacao;
use ProjetoTeste\Service\Deposito;
use PHPUnit\Framework\TestCase;

class DepositoTest extends TestCase
{

    public function testMultiplosDepositoCarteira()
    {

        $carteira = new Carteira();
        $servicoDeposito = new Deposito();
        $servicoDeposito->depositoCarteira($carteira,10);
        $servicoDeposito->depositoCarteira($carteira,50);
        $transacao = $servicoDeposito->depositoCarteira($carteira, 70);

        self::assertInstanceOf(Transacao::class, $transacao);
        self::assertIsArray($carteira->getTransacoes());
        self::assertCount(3, $carteira->getTransacoes());
    }

    public function testUmDepositoCarteira()
    {
        $carteira = new Carteira();
        $servicoDeposito = new Deposito();
        $transacao = $servicoDeposito->depositoCarteira($carteira,70);

        self::assertInstanceOf(Transacao::class, $transacao);
        self::assertCount(1, $carteira->getTransacoes());
    }

    public function testValorTransacaoDeposito()
    {
        $valor = 70;
        $carteira = new Carteira();
        $servicoDeposito = new Deposito();
        $transacao = $servicoDeposito->depositoCarteira($carteira, $valor);

        self::assertInstanceOf(Transacao::class, $transacao);
        self::assertCount(1, $carteira->getTransacoes());
        self::assertEquals($carteira->getTransacoes()[0]->getValor(), $valor);
    }

    public function testTipoTransacaoDeposito()
    {

        $valor = 70;
        $carteira = new Carteira();
        $servicoDeposito = new Deposito();
        $transacao = $servicoDeposito->depositoCarteira($carteira, $valor);

        self::assertInstanceOf(Transacao::class, $transacao);
        self::assertCount(1, $carteira->getTransacoes());
        self::assertEquals(Transacao::ENTRADA, $carteira->getTransacoes()[0]->getTipo());
    }

    public function testExcecaoValorNegativoDeposito()
    {

        $valor = -1;
        $carteira = new Carteira();
        $servicoDeposito = new Deposito();

        $this->expectException(\InvalidArgumentException::class);
        $servicoDeposito->depositoCarteira($carteira, $valor);
    }
}
