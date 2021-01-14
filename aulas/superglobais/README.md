# Constantes

Em PHP, assim como em outras linguagens de programação, é possível definir **constantes**. Ao contrário das variáveis, as constantes possuem um valor fixo ao longo de toda execução do código. Sua função? Remover do código algo que pode ser mudado na programação em um momento posterior, ou por alguma razão específica:
```php
<?php
define('VERSION', '1.0.0');

echo "A versão atual do sistema é " . VERSION;
?>
```

Neste exemplo, a constante `VERSION` pode ser alterada a cada nova versão do sistema que for lançada, e esta informação pode estar presente em mais de um lugar no código. Dessa forma, a manutenção desta informação é bastante facilitada. Note também que a constante está escrita com **todas as letras em maiúsculas**. Esta é uma forma bastante comum de diferenciar variáveis (e atributos em classes) de constantes na maior parte das linguagens de programação.

# Escopo e Variáveis superglobais

## Escopo

**Escopo** em computação refere-se a um *contexto* onde variáveis e funções "existem". Obviamente que o conceito de escopo é bem mais amplo que este, mas para esta disciplina, por hora, é suficiente. Para exemplificar melhor este conceito, veja o exemplo a seguir:
```php
<?php
function media($_notas) {
    $soma = array_sum($_notas);
    $quant = sizeof($_notas);
    return $soma / $quant;
}

$notas = [9, 6, 4, 8];
echo media($notas);

echo $soma; # isso gerará um warning - a variávei $soma não está disponível neste contexto
?>
```

Em PHP, variáveis definidas *fora* de funções (e classes) possuem escopo **global**. Isso quer dizer que podem ser acessadas em qualquer ponto do código, **exceto dentro de funções** (ao menos não diretamente, como será explicado a seguir). Então, no exemplo acima, a variável `$notas` pode ser reutilizada em outros pontos do código, enquanto as variáveis `$_notas`, `$soma` e `$quant` "existem" *apenas dentro da função `media()`*.

É possível utilizar variáveis globais dentro de funções através da utilização da palavra reservada `global`, ou usando a *variável superglobal* `$GLOBALS` (mais sobre as superglobais será explicado a seguir). Veja o exemplo a seguir:

```php
<?php
function consumo() {
    global $km;
    if (!is_numeric($km) || !is_numeric($GLOBALS['litros'])) {
        return 0;
    }
    return floatval($km) / floatval($GLOBALS['litros']);
}

$km = 100;
$litros = 12;

echo consumo();
?>
```

## Superglobais

Tendo compreendido o que é **escopo**, é possível perceber que algumas variáveis não estarão disponíveis em certos contextos, a menos que sejam utilizados certos artifícios. Esse não é o caso das **variáveis superglobais**. As variáveis superglobais do PHP são as seguintes:
- [$GLOBALS](https://www.php.net/manual/pt_BR/reserved.variables.globals.php) - acesso a variáveis globais dentro de contextos onde elas não estariam disponíveis.
- [$\_SERVER](https://www.php.net/manual/pt_BR/reserved.variables.server.php) - acesso a dados do servidor, do pacote HTTP do request e outros mais.
- [$\_GET](https://www.php.net/manual/pt_BR/reserved.variables.get.php) - acesso a dados enviados pelo pacote com o método GET.
- [$\_POST](https://www.php.net/manual/pt_BR/reserved.variables.post.php) - acesso a dados enviados pelo pacote com o método POST.
- [$\_FILES](https://www.php.net/manual/pt_BR/reserved.variables.files.php) - acesso a arquivos que tenham sido enviados num processo de *upload*.
- [$\_COOKIE](https://www.php.net/manual/pt_BR/reserved.variables.cookie.php) - acesso aos *cookies* enviados no pacote.
- [$\_SESSION](https://www.php.net/manual/pt_BR/reserved.variables.session.php) - acesso aos dados da sessão do cliente atual.
- [$\_REQUEST](https://www.php.net/manual/pt_BR/reserved.variables.request.php) - acesso aos dados vindos por algum dos métodos POST, GET ou pelos COOKIES.
- [$\_ENV](https://www.php.net/manual/pt_BR/reserved.variables.environment.php) - variáveis de ambiente enviadas para o php sendo executado atualmente.

Três destas variáveis superglobais serão de extrema importância para o andamento da disciplina, mas neste momento apenas duas delas serão melhor detalhadas: `$_GET` e `$_POST`. Com estas duas variáveis pode-se ter acesso a dados enviados pelo cliente durante seu request. Essas variáveis estão diretamente relacionadas aos [métodos do protocolo HTTP](https://www.w3.org/Protocols/rfc2616/rfc2616-sec9.html):
- [GET](https://developer.mozilla.org/pt-BR/docs/Web/HTTP/Methods/GET) - método usado para recuperar informações e solicitar arquivos.
- [POST](https://developer.mozilla.org/pt-BR/docs/Web/HTTP/Methods/POST) - método usado para enviar dados maiores, sobretudo vindos de formulários.

Estas variáveis comportam-se como *arrays associativos*, onde os índices são os *nomes dos dados* que foram enviados, e os valores são os valores atribuídos a estes dados. Por exemplo, na url `https://www.google.com/search?q=php&sourceid=chrome`, os dados `q` e `sourceid` estão sendo enviados via método GET (ou seja, diretamente na URL), e seus valores são `php` e `chrome` respectivamente. Este *request* está sendo feito para o arquivo `search`, hospedado no servidor `www.google.com`.

Este formato de envio de dados, `nome=valor[&nome0=valor0]*` é chamado de [*query string*](https://en.wikipedia.org/wiki/Query_string), e é utilizado tanto para enviar dados via o método GET quanto POST, sendo que no caso deste último a *query string* é colocada **dentro do pacote http**.

Veja o exemplo a seguir:
```php
<?php
echo "Seja bem vindo, " . $_GET['nome'];
?>
```

Se este for o conteúdo do arquivo `welcome.php`, hospedado num servidor local (sendo servido usando o servidor embutido do PHP, na porta 3000), um request para `http://localhost:3000/welcome.php?nome=Ranieri` geraria o resultado `Seja bem vindo, Ranieri`.


# Referências e mais conteúdos
- https://www.php.net/manual/pt_BR/language.constants.syntax.php
- https://www.php.net/manual/pt_BR/language.constants.predefined.php
- https://pt.wikipedia.org/wiki/Escopo_(computação)
- https://www.w3schools.com/tags/ref_httpmethods.asp
