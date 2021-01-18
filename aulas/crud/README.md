# CRUD

O termo **CRUD** é um *acrônimo* para **Create, Read, Delete and Update**, que significa literalmente "Criar, ler, deletar e atualizar". Estas são as quatro operações básicas em praticamente qualquer Sistema Web, pois são também as operações realizadas em bacos de dados relacionais. Então, um *CRUD* é um sistema que **manipula dados** em uma base de dados qualquer.

Apesar do termo *CRUD* ser o mais comum, outros termos podem ser utilizados para representar as mesmas quatro operações:
- **ABCD**: Add, Browse, Change and Delete
- **BREAD**: Browse, Read, Edit, Add and Delete
- **VADE(R)**: View, Add, Delete, Edit (e Restore, para sistemas com processos transacionais)
- **VEIA**: Visualizar, Excluir, Inserir, Alterar

É importante ressaltar que estas operações precisam ser feitas sobre uma mesma base de dados. Uma base de dados, neste caso, pode ser um esquema de banco de dados ou, como vem sendo trabalhado até aqui nesta disciplina, um arquivo CSV ou de algum outro formato.

## Entidades e Relacionamentos

O conceito de entidade e relacionamento vem do estudo de bancos de dados relacionais. Uma **entidade** é uma representação de algo do mundo real, com seus atributos e propriedades, e os **relacionamentos** são as relações entre estas entidades.

Para explicar melhor os conceitos de entidade e relacionamento, leve em consideração o seguinte cenário:

> Uma empresa precisa de um cadastro de funcionários, onde os seguintes dados destes funcionários precisam ser salvos: nome, sobrenome, e-mail e cpf. Cada um destes funcionários pode ter como dependentes os pais, o/a cônjuge e filhos. Para cada dependente, precisam ser salvos: nome, sobrenome, tipo de parentesco e cpf.
> Cada dependente só pode ser cadastrado em nome de um funcionário, então no caso de duas pessoas casadas que trabalham na mesma empresa, cada filho só pode estar cadastrada como dependente de um deles.

Neste cenário, pode-se perceber que existem duas *entidades*: `Funcionário` (com os atributos `nome`, `sobrenome`, `email` e `cpf`) e `Dependente` (com os atributos `nome`, `sobrenome`, `parentesco` e `cpf`); também é possível notar que existe um *relacionamento* entre estas entidades: cada `Funcionário` pode ter nenhum, um ou mais `Dependente`s, enquanto cada `Dependente` está ligado a exatamente um `Funcionário`. Então funcionários podem existir sem dependentes, mas dependentes só existem se estiverem relacionados a um funcionário. Este é um típico cenário de um relacionamento `1:n`, ou seja, **`1` funcionário pode ter `n` dependentes**, mas **cada dependente está ligado a apenas `1` funcionário**.

Em *Banco de Dados* estuda-se que cada entidade deve ter *uma chave que a identifica unicamente* (conhecida como **chave primária**), e que esta chave precisa ser um atributo (ou um conjunto de atributos) desta entidade. Por exemplo, no caso das entidades `Funcionário` e `Dependente`, uma boa chave seria o **cpf**, já que é um dado que este é um dado único para pessoas.

Como existe um relacionamento entre estas entidades, e é um relacionamento `1:n`, uma estratégia comum adotada em bancos de dados relacionais é a seguinte:
- construir um repositório para salvar os dados da entidade do lado `1`;
- construir um repositório para salvar os dados da entidade do lado `n`;
- adicionar um *atributo* à entidade do lado `n` de forma que este dado a relaciona com a entidade do lado `1`; este atributo, em banco de dados, é chamado de **chave estrangeira**, e deve ter o valor da *chave primária* da entidade do lado `1`.

Assim, pode-se descrever as entidades deste sistema da seguinte forma:

##### `Funcionário`
- **`cpf`**
- `nome`
- `sobrenome`
- `email`

##### `Dependente`
- **`cpf`**
- `nome`
- `sobrenome`
- `parentesco`
- *`cpf do funcionário`*

Observe atentamente os atributos da entidade `Dependente`. O atributo `cpf do funcionário` é um atributo que não pertence diretamente à entidade, mas que no modelo de dados relacionais é necessário para que seja possível relacionar um registro de `Dependente` a um registro de `Funcionário` ou vice-versa.

Como estas entidades são diferentes e, por estar sendo usado o modelo relacional, estarão armazenadas em repositórios diferentes, será preciso um *CRUD* para cada uma. Desta forma pode-se generalizar que *CRUD*s são feitos **por entidade**; um Sistema Web não é apenas *um CRUD*, mas um conjunto destes, cada um adaptado para as necessidades da aplicação e para as entidades que manipulam.

### CRUDs em relacionamentos `1:n`

A nível de interface, quando pensa-se em um relacionamento `1:n`, há dois tipos de abordagens bastante comuns:
1. Um CRUD para manipular as entidades do lado `1` e cada uma destas entidades possui um link para um outro CRUD que manipula as entidades do lado `n` *que estão relacionadas àquela entidade `1`*.
2. Um CRUD para manipular as entidades do lado `1` e, no formulário utilizado para criar ou editar uma entidade do lado `n` existe um elemento `<select>` onde cada elemento `<option>` corresponde a uma entidade do lado `n`.

O exemplo explorado anteriormente pode facilmente ser implementado utilizado a abordagem (1), já que cada funcionário pode ter uma quantidade qualquer de dependentes. Para explicar a abordagem (2), pode-se a partir do mesmo cenário observar uma outra entidade, `Parentesco`, já que o dado do atributo `parentesco` na entidade `Dependente` não pode ser um dado arbitrário, mas sim um dentre uma lista (`pai`, `mãe`, `cônjuge` ou `filho(a)`).

# Referências e mais conteúdos

- https://pt.wikipedia.org/wiki/CRUD
- https://pt.wikipedia.org/wiki/Modelo_entidade_relacionamento