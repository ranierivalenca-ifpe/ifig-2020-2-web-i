# O HTTP é stateless!

O protocolo HTTP é um protocolo [**stateless**](https://en.wikipedia.org/wiki/Stateless_protocol). Isso significa que cada *request* HTTP é **independente** dos demais, e não há persistência de nenhuma informação entre os *requests*. Ou seja, quando um usuário acessa um sistema e pede vários arquivos distintos, do ponto de vista do servidor não há uma forma de saber, diretamente pelo protocolo, se os *requests* estão vindo do mesmo cliente ou se de clientes diferentes.

# Cookies

Em computação, sobretudo em Desenvolvimento Web, *cookies* são pequenos pedaços de informação enviados pelo cliente ao servidor a cada *request* que é feito, no cabeçalho do pacote HTTP.

Os cookies são *setados* pelo servidor em algum *response* a partir do cabeçalho `Set-Cookie: nome=valor` e, a partir deste ponto, podem ficar salvos no cliente. Quando um cookie está salvo no cliente, ele é enviado dentro do cabeçalho de cada *request* que for feito para o domínio. O escopo onde os cookies são enviados pode ser ajustado durante o estabelecimento do cookie pelo servidor, através de certas diretivas:
- `Domain`: os cookies passam a ser enviados também em requisições feitas a subdomínios.
- `Path`: pode-se limitar em quais caminhos dentro do domínio o cookie é enviado.

Outra característica importante sobre os cookies é o seu *tempo de vida*. Por padrão, um cookie fica armazenado no cliente até que ele seja fechado. Apesar disso, a duração dos cookies pode ser estendida pelas diretivas `Max-Age` (tempo máximo que um cookie permanece ativo) ou `Expires` (até quando um cookie estará ativo).

Mais informações sobre cookies podem ser encontradas [no MDN](https://developer.mozilla.org/en-US/docs/Web/HTTP/Cookies), [no MDN em português (tradução em progresso na data de escrita deste documento)](https://developer.mozilla.org/pt-BR/docs/Web/HTTP/Cookies), [na Wikipedia](https://pt.wikipedia.org/wiki/Cookie_(informática)) ou em buscas simples pela web =)

## Cookies na prática (em PHP)

### Setando cookies

Para criar cookies em PHP, pode-se setá-los diretamente com os cabeçalhos do HTTP usando a função `header`:
```php
<?php
header('Set-Cookie: cookie-no-header=1');
?>
```

Mas há uma forma mais simples de fazer isso, através da função [`setcookie()`](https://www.php.net/manual/en/function.setcookie.php):
```php
<?php
setcookie('cookie-no-setcookie', 'mais legal', time() + 60*60*24*30);
?>
```

No primeiro exemplo o cookie é setado da forma mais simples possível, apenas com um nome e um valor. Naquele caso, assim que o browser for fechado o cookie será excluído. No segundo caso, o cookie está sendo setado com a diretiva `expires`, cujo valor é o terceiro parâmetro da função `setcookie`. No exemplo, o cookie está sendo setado para expirar num [*timestamp* ](https://www.unixtimestamp.com) igual ao *timestamp* atual (`time()`) mais `2592000` segundos, ou 30 dias (`30` dias * `24` horas por dia * `60` minutos por hora * `60` segundos por minuto). Obviamento o mesmo poderia ser feito usando a função `header()`, mas a função `setcookie()` facilita a legibilidade do código.

### Lendo cookies

Os cookies recebidos por um script PHP podem ser acessados pela variável superglobal [`$_COOKIE`](https://www.php.net/manual/pt_BR/reserved.variables.cookies.php), que é um array associativo e funciona da mesma forma que as superglobais `$_GET` e `$_POST` já estudadas.

O exemplo a seguir lista os cookies que estão sendo enviados para o script:
```php
<?php
echo "<pre>";
foreach($_COOKIE as $name => $value) {
    echo $name . " = " . $value . PHP_EOL;
}
echo "</pre>";
?>
```

### Usando cookies - um exemplo simples

Observe o código [`count-visits.php`](examples/count-visits.php). Com este código relativamente simples é possível contar a quantidade de vezes que um usuário visitou uma página:
```php
<?php
$visits = $_COOKIE['visits'] ?? 0; // coloca na variável $visits o valor do cookie 'visits' ou 0, caso o cookie não tenha sido enviado pelo request
$visits++;
setcookie('visits', $visits); // seta o cookie 'visits' com o valor da variável $visits
?>
```

### Como *NÃO* utilizar cookies

Como já explicado, o HTTP é stateless. Mas, também como já mostrado, é possível "persistir" pequenos pedaços de informação no lado do cliente, de forma que a cada *request* estas informações são enviadas para o servidor através dos cookies. Tendo isso em mente, pode-se pensar em sistemas que verificam se um dado cliente tem ou não permissão para acessar uma área específica do sistema através dos cookies que são enviados pelo *request*.

Com base nisso, foi construído um sistema de autenticação baseado em cookies, no diretório [`cookie-auth`](examples/cookie-auth/) dentro dos exemplos desta aula.

A premissa do sistema é simples: a página `index.php` só pode ser acessada por usuários autenticados. E como verificar se um *request* feito por um cliente usando o protocolo HTTP, que é stateless, é de um cliente autenticado? Bom, a primeira ideia é verificar se algum cookie está setado e se está um valor esperado. Neste exemplo, o valor do cookie `autorizado` está sendo guardado na variável `$autorizado` caso ele esteja sendo enviado; caso não esteja sendo enviado, a variável fica com o valor `false`. Então, é verificado se o valor deste cookie é `1`, e caso não seja o cliente é encaminhado para uma página de login.

A página de login pede por uma senha num formulário, que é submetido a um script de verificação (`auth.php`) - caso a senha seja igual a um valor predefinido, o cookie `autorizado` é setado para o valor `1`, significando "autenticado"; caso contrário, este cookie é setado para o valor `0`, significando "não autenticado", e então o cliente é encaminhado de volta à `index.php`.

O grande problema deste sistema consiste justamente no fato que o faz funcionar: os cookies ficam armazenados no cliente. Desta forma, esta é uma informação que deve ser utilizada para o próprio cliente, mas não é uma informação que pode-se considerar *segura* nem, principalmente, **confiável**, visto que um cabeçalho HTTP pode ser modificado antes de chegar ao servidor, seja por um programa externo de captura de tráfego de dados, seja pelo próprio navegador através de plugins simples.