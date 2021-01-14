# Trabalhando com formulários

Para construir Sistemas Web, é preciso que o cliente possa não apenas pedir dados e arquivos do servidor, mas que ele também seja capaz de *enviar dados* para o servidor. A forma mais comum de enviar dados a um servidor é através de **formulários em HTML**. A tag `<form><!-- ... --></form>` cria um [formulário](https://www.w3schools.com/html/html_forms.asp), e possui alguns atributos muito importantes, entre eles destacam-se `action` (a url para onde o formulário será enviado), `method` (método com o qual o *request* será enviado - `"GET"` ou `"POST"`) e `enctype` (tipo de codificação que será utilizada no pacote; este atributo geralmente é utilizado para upload de arquivos, com o valor `"multipart/form-data"`.

Dentro de um formulário podem ser utilizados [alguns tipos de elementos](https://www.w3schools.com/html/html_form_elements.asp), sendo provavelmente o mais comum deles o [`<input>`](https://www.w3schools.com/html/html_form_input_types.asp). Observe o exemplo em [form-example.html](form-example.html); o formulário gerado será similar à imagem abaixo:
![image](https://user-images.githubusercontent.com/2471326/63200941-89523800-c059-11e9-9022-8522cce0f155.png)

Agora, analise mais cuidadosamente o seguinte trecho do código:
```html
<form action="adicionar.php" method="POST">
    <fieldset>
        <legend>Dados pessoais</legend>
        <input type="text" name="nome" placeholder="Nome">
        <input type="text" name="sobrenome" placeholder="Sobrenome">
        <input type="submit" value="Ok">
    </fieldset>
</form>
```

Neste código é possível que o formulário deve ser enviado ao arquivo `adicionar.php` pelo método *POST*. Os dados enviados serão `nome` e `sobrenome`, com os valores que forem digitados pelo usuário no formulário. Para acessar os dados em `adicionar.php`, pode-se utilizar `$_POST['nome']` e `$_POST['sobrenome']`, conforme o código a seguir:
```php
<?php
$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
?>
<h2>Dados recebidos:</h2>
<ul>
    <li>Nome: <strong><?= $nome ?></strong></li>
    <li>Sobrenome: <strong><?= $sobrenome ?></strong></li>
</ul>
```

No exemplo, os dados recebidos no PHP são apenas escritos dentro de um código HTML, mas eles poderiam ser tratados conforme o programador deseje. Tais dados podem ser utilizados para enviar um e-mail, acessar uma outra URL, fazer uma busca num banco de dados ou mesmo podem ser salvos em um arquivo.

Outra forma de enviar dados ao servidor é através de URLs construídas passando dados pelo método `GET`, através de uma *query string* após o caractere `?`. Para saber um pouco mais sobre URLs, veja [este link](https://pt.wikipedia.org/wiki/URL).

# Referências

- https://www.w3schools.com/tags/ref_httpmethods.asp
- https://developer.mozilla.org/pt-BR/docs/Web/Guide/HTML/Forms/Meu_primeiro_formulario_HTML