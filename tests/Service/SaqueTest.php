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
        $servicoDeposito = new Deposito($carteira);
        $carteira = $servicoDeposito->depositoCarteira(70);

        $serviceBuscaSaldo = new BuscaSaldo($carteira);
        $servicoSaque = new Saque($carteira, $serviceBuscaSaldo);
        $carteiraPosSaque = $servicoSaque->saqueCarteira(10);

        self::assertIsArray($carteira->getTransacoes());
        self::assertCount(2, $carteiraPosSaque->getTransacoes());
    }

    public function testValorTransacaoSaqueComValorNaCarteira()
    {
        $carteira = new Carteira();
        $servicoDeposito = new Deposito($carteira);
        $carteira = $servicoDeposito->depositoCarteira(70);

        $serviceBuscaSaldo = new BuscaSaldo($carteira);
        $servicoSaque = new Saque($carteira, $serviceBuscaSaldo);
        $carteiraPosSaque = $servicoSaque->saqueCarteira(10);

        self::assertIsArray($carteira->getTransacoes());
        self::assertEquals(10, $carteiraPosSaque->getTransacoes()[1]->getValor());

    }

    public function testTipoTransacaoSaqueComValorNaCarteira()
    {
        $carteira = new Carteira();
        $servicoDeposito = new Deposito($carteira);
        $carteira = $servicoDeposito->depositoCarteira(70);

        $serviceBuscaSaldo = new BuscaSaldo($carteira);
        $servicoSaque = new Saque($carteira, $serviceBuscaSaldo);
        $carteiraPosSaque = $servicoSaque->saqueCarteira(10);

        self::assertIsArray($carteira->getTransacoes());
        self::assertEquals(Transacao::SAIDA, $carteiraPosSaque->getTransacoes()[1]->getTipo());
    }

    public function testSaqueSemValorNaCarteira()
    {
        $carteira = new Carteira();
        $serviceBuscaSaldo = new BuscaSaldo($carteira);
        $servicoSaque = new Saque($carteira, $serviceBuscaSaldo);

        $this->expectException(\InvalidArgumentException::class);
        $servicoSaque->saqueCarteira(10);
    }

}
