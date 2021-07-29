<?php

namespace ProjetoTeste\Tests\Service;

use ProjetoTeste\Model\Carteira;
use ProjetoTeste\Model\Transacao;
use ProjetoTeste\Service\BuscaSaldo;
use PHPUnit\Framework\TestCase;

class BuscaSaldoTest extends TestCase
{

    public function testCarteiraComUmaTransacao()
    {

        $carteira = new Carteira();

        $transacao = new Transacao();
        $transacao->setTipo(Transacao::ENTRADA);
        $transacao->setValor(10);

        $carteira->adicionaTransacao($transacao);

        $saldo = (new BuscaSaldo($carteira))->buscaSaldoCarteira();

        self::assertIsFloat($saldo);
        self::assertEquals($saldo, 10);
    }

    public function testCarteiraComMaisDeUmaTransacao()
    {

        $carteira = new Carteira();

        $transacao = new Transacao();
        $transacao->setTipo(Transacao::ENTRADA);
        $transacao->setValor(10);

        $transacao2 = new Transacao();
        $transacao2->setTipo(Transacao::ENTRADA);
        $transacao2->setValor(10);

        $carteira->adicionaTransacao($transacao);
        $carteira->adicionaTransacao($transacao2);

        $saldo = (new BuscaSaldo($carteira))->buscaSaldoCarteira();

        self::assertIsFloat($saldo);
        self::assertEquals($saldo, 20);
    }

    public function testCarteiraComTransacaoDeSaida()
    {

        $carteira = new Carteira();

        $transacao = new Transacao();
        $transacao->setTipo(Transacao::ENTRADA);
        $transacao->setValor(50);

        $transacao2 = new Transacao();
        $transacao2->setTipo(Transacao::SAIDA);
        $transacao2->setValor(10);

        $carteira->adicionaTransacao($transacao);
        $carteira->adicionaTransacao($transacao2);

        $saldo = (new BuscaSaldo($carteira))->buscaSaldoCarteira();

        self::assertIsFloat($saldo);
        self::assertEquals($saldo, 40);
    }

}
