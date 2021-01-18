# Alterando cabeçalhos

Como sabe-se, PHP é uma linguagem com recursos específicos para trabalhar com Sistemas Web, sobretudo com o modelo cliente-servidor. Por conta disso, PHP trabalha com o protocolo HTTP, recebendo dados vindos nos cabeçalhos dos pacotes de **request** e enviando dados nos cabeçalhos dos pacotes de **response**.

Para lidar com os cabeçalhos do *request*, podem ser utilizadas as variáveis superglobais `$_GET`, `$_POST` ou `$_SERVER`, a depender do que se deseja. Já para enviar cabeçalhos específicos no *response*, pode-se utilizar a função [`header()`](https://www.php.net/manual/pt_BR/function.header.php).

Ao chamar esta função, que recebe obrigatoriamente um parâmetro do tipo String que indica o que será adicionado no cabeçalho do pacote de resposta. Pode-se ainda passar outros dois parâmetros opcionais (para mais informações, veja a [documentação da função](https://www.php.net/manual/pt_BR/function.header.php)).

E quais cabeçalhos podem ser manipulados e enviados com esta função? Vale a pena dar uma olhada na [especificação do protocolo HTTP 1.1](http://www.faqs.org/rfcs/rfc2616.html) para entender seus cabeçalhos. Nesta disciplina, o mais comum que será trabalhado é o cabeçalho `Location`. Ao enviar este cabeçalho, o código de resposta do HTTP automaticamente é mudado para um status de redirecionamento (`3xx`), tipicamente `302`. Nesse caso, o browser entende que deve fazer um redirecionamento, ou seja, fazer um novo request, para o caminho especificado neste cabeçalho. Por exemplo, observe o exemplo a seguir:

```php
<?php
include 'configs.php';
$linhas = file(FILENAME);

$id = $_GET['id'] ?? false;

if ($id !== false) {
    unset($linhas[$id]);
    file_put_contents('arquivo.txt', implode('', $linhas));
}

header('Location: index.php');
?>
```

O código acima faz o esperado em um típico script de remoção de dados de um arquivo CSV, de acordo com o que vem sendo trabalhado na disciplina até agora:
- inclui um arquivo de configurações, onde deve estar definida a constante `FILENAME`, usada na linha a seguir;
- abre o arquivo definido em `FILENAME` e salva suas linhas no array `$linhas`;
- coloca na variável `$id` o dado vindo pela url (pelo método GET) no parâmetro `id` ou o valor booleano `false` caso `$_GET['id']` não exista;
- caso o valor da variável `$id` seja diferente do booleano `false` (tanto valor quanto tipo) faz um procedimento para remover uma linha do arquivo;
- **adiciona um cabeçalho ao pacote de *response* que será enviado ao cliente de volta, informando que o cliente deve ser redirecionado para a página `index.php`**.