# Instalação Básica

No exemplo de instalação e configuração usaremos a linguagem php, sendo assim seguir os passos a seguir para configuração inicial do projeto.

Requisitos: 

    PHP >= 7.4
    Composer >= 2.0.2
Em um diretório novo vamos iniciar o projeto php usando composer, com o comando a seguir :

    composer init
Ao executar esse comando será solicitado algumas informações acerca do projeto como nome, autor, descrição, para níveis didáticos você pode seguir teclando enter(caso deseje saber mais sobre composer visitar a documentação https://getcomposer.org/doc/00-intro.md)

Ao final desse processo deverá ter um arquivo chamado composer.json, nele contém as informações do projeto e também é responsável por armazenar as informações referente as dependências.

Agora vamos partir para a instalação da nossa biblioteca de testes, que no caso do php será o PhpUnit, estamos usando no exemplo a versão 9.

    composer require --dev phpunit/phpunit ^9

Agora que o que precisamos está instalado vamos começar a organizar a aplicação.

A partir desse ponto recomendo a utilização de uma IDE, como por exemplo Vscode ou Phpstorm.

Primeiro passa na organização vamos criar uma pasta src que terá nosso código e uma tests que terá nossos testes.

Para configurar o autoload das classes do projeto vamos usar a PSR4, indicada pelo [PHPFIG](https://www.php-fig.org/psr/psr-4/) como boa prática segue exemplo do que deve ser adicionado no composer.json:
    
    "autoload": {
            "psr-4": {
                "ProjetoTeste\\": "src/",
                "ProjetoTeste\\Tests\\": "tests/"
            }
        }

Com isso já temos nosso código rodando, com dois namespaces, um para aplicação e outro para teste.

Usar comando a seguir para executar os testes:

    ./vendor/bin/phpunit tests --colors --testdox

Nesse primeiro momento ele vai retornar que não existem testes ainda, eles serão criados nas etapas a seguir.
