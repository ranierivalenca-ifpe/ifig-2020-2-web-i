# Sessões

Por causa do problema de confiabilidade dos cookies, eles não são uma a melhor alternativa para a construção de mecanismos de autenticação. Para lidar com isso, é preciso de um mecanismo que, **no lado do servidor**, seja capaz de identificar se um usuário está ou não autenticado. E para diferenciar qual cliente está ou não autenticado, utilizam-se cookies. Este é o princípio do mecanismo de **controle de sessão** implementado por praticamente todos os sistemas web.

O controle de sessão funciona da seguinte forma:
1. O servidor identifica se um cookie específico está sendo enviado pelo cliente.
    1.1. Caso esteja, ele pega o valor deste cookie e carrega as informações que estão armazenadas no próprio servidor *indexadas* pelo valor na **variável de sessão**.
    1.2. Caso não esteja, ele gera um valor aleatório, seta o cookie com este valor, e armazena a **variável de sessão** no próprio servidor, *indexada* pelo valor gerado.
2. O código executado no servidor pode ler e alterar as informações na **variável de sessão**.
3. Após a execução do código, as alterações feitas na **variável de sessão** são salvas no servidor.

Desta forma, o cookie armazenado no cliente funciona como uma chave para que o servidor possa acessar os dados daquele cliente. Mas calma, os cookies não podem ser alterados pelo cliente? Sim, mas neste caso o problema é minimizado pelo fato de que os valores gerados para o cookie geralmente são longos e aleatórios, de forma que dificilmente um cliente é capaz de "adivinhar" o cookie de um outro cliente sem ter acesso direto a ele.

## Sessões no PHP

No PHP, todo o processo de controle de sessão é feito através de uma única chamada à função `session_start()`. Esta chamada faz todo o processo de verificar e setar o cookie `PHPSESSID`, e seta a [variável superglobal `$_SESSION`](https://www.php.net/manual/pt_BR/reserved.variables.session.php), que é um array associativo de valores que ficam salvos no próprio servidor.

O código [`count-visits-session.php`](examples/count-visits-session.php) faz praticamente o mesmo que o `count-visits.php` mostrado anteriormente faz - conta a quantidade de vezes que um cliente visitou a página. A diferença aqui está no fato de que esta informação, que antes ficava salva diretamente no cookie, agora está salva **no lado do servidor**. Observe o código abaixo e veja as diferenças:
```php
<?php
session_start(); // inicia a sessão, setando a variável $_SESSION com os devidos valores, e setando o cookie PHPSESSID caso seja necessário
$visits = $_SESSION['visits'] ?? 0; // coloca na variável $visits o valor da variável de sessão no índice 'visits', caso exista, ou 0 caso contrário
$visits++;
$_SESSION['visits'] = $visits; // seta o valor do índice 'visits' na variável de sessão com o valor da variável $visits
?>
```

## Mecanismo de autenticação

Utilizando sessões, é possível criar mecanismos de autenticação menos vulneráveis, uma vez que a informação de que um usuário está ou não autenticado agora fica salva no servidor. O sistema de autenticação no diretório [`session-auth`](examples/session-auth/) no diretório de exemplos faz exatamente o mesmo que o anterior, feito com cookies, mas desta vez utilizando sessão.

Este sistema é apenas um exemplo de como funciona um mecanismo de autenticação simples. Num sistema real, a principal diferença fica por conta do script de autenticação - tipicamente um sistema pode ser acessado por vários usuários, e cada um destes usuários tem seu login e senha.

### Exemplo de sistema - Lista de tarefas

Um exemplo comum que pode ser citado é um sistema de lista de tarefas para usuários. As entidades num sistema mais simples deste seriam as seguintes:

##### `Usuario`
- **`email`**
- `senha`
- `nome`

##### `Tarefa`
- **`id`**
- `tarefa`
- *`email do Usuario`*

Neste sistema, é preciso:
- um sistema de cadastro de usuários, onde os usuários podem cadastrar seus dados (nome, login e senha);
- um sistema de autenticação, que verifica se o login e senha digitados correspondem a um dos usuários;
- um crud para tarefas que os usuários têm a fazer.

Vale notar que, após autenticado, a lista de tarefas de cada usuário será diferente, já que um usuário só deve ter acesso às suas tarefas.