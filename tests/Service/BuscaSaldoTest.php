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

        $saldo = (new BuscaSaldo())->buscaSaldoCarteira($carteira);

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

        $saldo = (new BuscaSaldo())->buscaSaldoCarteira($carteira);

        self::assertIsFloat($saldo);
        self::assertEquals($saldo, 20);
    }

    /**
     * @dataProvider getValoresTestCarteira
     */
    public function testCarteiraComTransacaoDeSaida($valor1, $valor2, $expected)
    {
        $carteira = new Carteira();

        $transacao = new Transacao();
        $transacao->setTipo(Transacao::ENTRADA);
        $transacao->setValor($valor1);

        $transacao2 = new Transacao();
        $transacao2->setTipo(Transacao::SAIDA);
        $transacao2->setValor($valor2);

        $carteira->adicionaTransacao($transacao);
        $carteira->adicionaTransacao($transacao2);

        $saldo = (new BuscaSaldo())->buscaSaldoCarteira($carteira);

        self::assertIsFloat($saldo);
        self::assertEquals($expected, $saldo);
    }

    public function getValoresTestCarteira(): array
    {
        return [
            'Valor Maior' => [10, 5, 5],
            'Valor Igual' => [10, 10, 0],
            'Valor Float' => [10.8, 5.9, 4.9],
        ];
    }

}
