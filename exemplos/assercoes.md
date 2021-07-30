# Asserções

A asseerção faz perta do terceiro passo do padrão [AAA](https://martinfowler.com/bliki/GivenWhenThen.html) (Arrange, Act, Assert), sendo assim faz parte
da estrura básica de uma função de teste.

Assserção nada mais é que verificar se um determinado resultado está de acordo com o esperado.

Basicamente seria, "Válida se esse dado informado é o que estou esperando”

Exemplo, um determinado serviço, deveria retornar true(boll), sendo assim
poderia ser criado um assertTrue($retornoServico), os frameworks de teste 
como PhpUnit geralmente já vem com vários asserções criadas, facilitando a vida do desenvolvedor.

Exemplos mais usados : **assertEmpty, assertInstanceOf, assertEquals, assertTrue, assertFalse**

Confira a lista completa [**aqui**](https://phpunit.readthedocs.io/pt_BR/latest/assertions.html#uso-estatico-vs-nao-estatico-de-metodos-de-assercao)

Além disso também é possível criar seus próprios asserts, leia mais sobre isso [**aqui**](https://phpunit.readthedocs.io/pt_BR/latest/extending-phpunit.html#escreva-assercoes-personalizadas)
