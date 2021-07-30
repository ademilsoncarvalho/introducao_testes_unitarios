# Provedores de Dados

Ao começar a testar seus métodos em algum momento vai perceber que precisa testar um mesmo método com diferentes dados,
não somente os declarados na função, nesse ponto entram os provedores de dados.

Como o nome diz são provedores de dados, que basicamente é possível definir na sua função de teste que ela vai receber
os dados, através de um provedor, esse provedor por sua vez é uma função definida na classe de teste, que retorna um
objeto iterável, no caso do php um array, com os parâmetros que a função espera, vamos ver um exemplo.

No exemplo a seguir tesmos um classe de dados usado um provedor de dados:

    <?php
    use PHPUnit\Framework\TestCase;
    
    class DataTest extends TestCase
    {
        /**
         * @dataProvider additionProvider
         */
        public function testAdd($a, $b, $expected)
        {
            $this->assertEquals($expected, $a + $b);
        }
    
        public function additionProvider()
        {
            return [
                [0, 0, 0],
                [0, 1, 1],
                [1, 0, 1],
                [1, 1, 3]
            ];
        }
    }
    ?>

Como explicado acima, o provedor de dados vai retornar um objeto iterável, que nesse exemplo é a função **
additionProvider** que retorna um array,

Por sua vez, o teste que precisa usar os dados do provedor inclui uma anotação **additionProvider**
indicando seu provedor, que nesse caso é o teste nomeado como **testAdd**.

Para cada item devolvido do provedor, será executado o teste com os dados informados, no exemplo acima será executado 4
vezes, cada linha voce poderia por valores diferentes para testar vários cenários usando o mesmo teste, isso faz o
provedor de dados ser uma das funcionalidades mais utilizadas quando de trata de testes.

Além disso uma dica para deixar mais claro seus testes, voce pode nomear para cada linha o nome do conuunto de dados
informado, exemplo:

    public function additionProvider()
    {
        return [
            'adding zeros'  => [0, 0, 0],
            'zero plus one' => [0, 1, 1],
            'one plus zero' => [1, 0, 1],
            'one plus one'  => [1, 1, 3]
        ];
    }

Leia mais sobre provedores de
dados [aqui](https://phpunit.readthedocs.io/pt_BR/latest/writing-tests-for-phpunit.html#provedores-de-dados)

