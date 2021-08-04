<?php

namespace ProjetoTeste\Tests\Service;

use PHPUnit\Framework\TestCase;
use ProjetoTeste\Model\Carteira;
use ProjetoTeste\Model\Transacao;
use ProjetoTeste\Service\BuscaSaldo;
use ProjetoTeste\Service\Deposito;
use ProjetoTeste\Service\Saque;

class SaqueTest extends TestCase
{

    public function testQuantidadeTransacoesSaque()
    {
        $carteira = new Carteira();
        $servicoDeposito = new Deposito();
        $transacao = $servicoDeposito->depositoCarteira($carteira,70);

        $serviceBuscaSaldo = new BuscaSaldo();
        $servicoSaque = new Saque($serviceBuscaSaldo);
        $transacao = $servicoSaque->saqueCarteira($carteira, 10);

        self::assertIsArray($carteira->getTransacoes());
        self::assertCount(2, $carteira->getTransacoes());
    }

    public function testValorTransacaoSaqueComValorNaCarteira()
    {
        $carteira = new Carteira();
        $servicoDeposito = new Deposito();
        $transacao = $servicoDeposito->depositoCarteira($carteira,70);

        $serviceBuscaSaldo = new BuscaSaldo();
        $servicoSaque = new Saque($serviceBuscaSaldo);
        $carteiraPosSaque = $servicoSaque->saqueCarteira($carteira,10);

        self::assertIsArray($carteira->getTransacoes());
        self::assertEquals(10, $carteira->getTransacoes()[1]->getValor());

    }

    public function testTipoTransacaoSaqueComValorNaCarteira()
    {
        $carteira = new Carteira();
        $servicoDeposito = new Deposito();
        $transacao = $servicoDeposito->depositoCarteira($carteira,70);

        $serviceBuscaSaldo = new BuscaSaldo();
        $servicoSaque = new Saque($serviceBuscaSaldo);
        $transacao = $servicoSaque->saqueCarteira($carteira, 10);

        self::assertIsArray($carteira->getTransacoes());
        self::assertEquals(Transacao::SAIDA, $carteira->getTransacoes()[1]->getTipo());
    }

    public function testSaqueSemValorNaCarteira()
    {
        $carteira = new Carteira();
        $serviceBuscaSaldo = new BuscaSaldo();
        $servicoSaque = new Saque($serviceBuscaSaldo);

        $this->expectException(\InvalidArgumentException::class);
        $servicoSaque->saqueCarteira($carteira, 10);
    }

    public function testTipoTransacaoSaqueComValorNaCarteiraUsandoStub()
    {
        $carteira = new Carteira();
        // Cria um esboço para a classe SomeClass.
        $buscaSaldoStub = $this->createMock(BuscaSaldo::class);
        // Configura o esboço.
        $buscaSaldoStub->method('buscaSaldoCarteira')
            ->willReturn(40.0);

        $servicoSaque = new Saque($buscaSaldoStub);
        $transacao = $servicoSaque->saqueCarteira($carteira, 10);

        self::assertIsArray($carteira->getTransacoes());
        self::assertEquals(Transacao::SAIDA, $transacao->getTipo());
    }

    public function testTipoTransacaoSaqueComValorNaCarteiraUsandoMock()
    {
        $carteira = new Carteira();

        $mock = $this->getMockBuilder(BuscaSaldo::class)->getMock();

        // Configura o esboço.
        $mock->expects($this->once())->method('buscaSaldoCarteira')
            ->with($this->equalTo($carteira))
            ->willReturn(40.0);

        $servicoSaque = new Saque($mock);
        $transacao = $servicoSaque->saqueCarteira($carteira, 10);

        self::assertIsArray($carteira->getTransacoes());
        self::assertEquals(Transacao::SAIDA, $transacao->getTipo());
    }

}
