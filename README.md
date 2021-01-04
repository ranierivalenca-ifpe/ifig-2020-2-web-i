## ifig-2020-1-web-i-manha
# Desenvolvimento para Web I - 2020.2

Neste repositório ficarão disponíveis os códigos feitos em sala de aula, assim como as resoluções dos exercícios (feitas em sala de aula ou não).

Os códigos não serão naturalmente comentados, mas sintam-se à vontade para enviar pull-requests com comentários.

## Sobre a disciplina

### Quais linguagens preciso saber?
Para começar, nesta disciplina você **precisa** saber *HTML*. Um pouco de *CSS* também é bom, apesar de vermos um tiquinho na disciplina. Você também precisa compreender como funciona o modelo *cliente-servidor*, além de conhecer o protocolo *HTTP*.

### O que devo aprender nesta disciplina?
Esta disciplina trata de conceitos de CRUD (Create, Read, Update, Delete), as operações mais básicas em uma Aplicação Web, na linguagem [**PHP**](https://php.net) (PHP Hyper Processor). Neste semestre, vamos também tentar trazer alguns recursos novos do PHP 7.4  (novidades [aqui](https://stitcher.io/blog/new-in-php-74) ou [aqui](https://kinsta.com/pt/blog/php-7-4/)), versão lançada há pouco tempo. Além disso, trabalhamos com **JavaScript** para front-end, passando por conceitos de DOM (Document Object Model), algumas coisas de [jquery](https://jquery.com) e talvez um pouco de ECMAScript 6 ([ref1](https://www.w3schools.com/js/js_es6.asp), [ref2](http://es6-features.org/)).

### Qual o horário de atendimento?
O professor estará disponível em seu servidor do Discord, [Clique aqui para acessar](https://discord.gg/GKG39CRdFB), das 11h30 às 12h30 e em horários excepcionais, divulgados no próprio servidor.


### Conteúdos:

#### PHP
- Introdução à disciplina, modelo cliente-servidor e servidor embutido do PHP
- Revisão de HTML e CSS
- Construção de tabelas dinâmicas com PHP
- Construção de tabelas dinâmicas com dados contidos num arquivo
- Inserção de dados informados pelo usuário num arquivo
- Remoção de dados de um arquivo
- Mecanismo de sessão
- Mecanismo de autenticação
- Conexão com banco de dados

#### JavaScript
- DOM (*Document Object Model*)
- *Interval* e *Timeout* em JavaScript
- JQuery

## FAQ

### Como rodar uma aplicação PHP?
È importante lembrar que PHP é uma linguagem interpretada, e portanto seus scrits são executados pelo *programa PHP*. Portanto, para executar um código em PHP devemos executar o comando `php caminho_do_script.php`.

### E se eu quiser ver minha aplicação PHP no browser?
Um uso comum de scripts escritos em PHP é gerar códigos em HTML, que frequentemente são visualizados num browser (Chrome, Firefox, etc). Para ver o resultado de um código PHP em um browser, é preciso que o código esteja disponível num servidor. Esse servidor pode ser o [Apache](https://httpd.apache.org/), o [NGINX](https://www.nginx.com/) ou algum outro desenvolvido para este propósito.

Mas talvez o servidor mais simples (e funcional para trabalhar com PHP) seja o próprio [servidor embutido do PHP](https://www.php.net/manual/pt_BR/features.commandline.webserver.php). Para executá-lo, basta entrar num diretório (`cd caminho_do_diretorio`), que será o *document root*, e digitar o comando `php -S localhost:8000`; assim, um servidor será iniciado na porta `8000`, ouvindo apenas requests vindos do `localhost`. Se quiser que o servidor escute todos os requests de qualquer ponto da rede, basta trocar o `localhost` por `0.0.0.0`; da mesma forma, pode-se trocar a porta para qualquer número. Assim, este comando também poderia ser `php -S 0.0.0.0:8765`: teríamos um servidor escutando todas as interfaces na porta `8765`.

### Quero comentar os códigos para aprender mais e ajudar meus colegas de classe. Como fazer?
Se você quer fazer isso, comece lendo [este artigo do Digital Ocean](https://www.digitalocean.com/community/tutorials/como-criar-um-pull-request-no-github-pt) (que inclusive está em português =^.^=). Você pode tentar fazer isso sozinho ou consultar o professor no horário de atendimento.
