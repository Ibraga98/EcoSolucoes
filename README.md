EcoSoluções - E-commerce Sustentável

 Descrição do Projeto
O EcoSoluções é uma plataforma de comércio eletrónico focada na sustentabilidade. Este projeto foi desenvolvido para oferecer funcionalidades completas, como registo de utilizadores, gestão de produtos, comentários, carrinho de compras e contagem de visitas. Inclui também recursos adicionais, como a definição de perfis de utilizadores, para melhorar a experiência.

---

 Funcionalidades
1. Registo de Utilizadores:
    - Dois tipos de utilizadores: Normal e Administrador.
    - Gestão segura de credenciais e permissões.
2. Produtos:
    - Listagem dinâmica de produtos.
    - Detalhes de produtos com comentários e avaliações.
3. Carrinho de Compras:
    - Adicionar, remover e visualizar produtos no carrinho.
4. Comentários:
    - Os utilizadores podem comentar e avaliar produtos.
5. Ofertas de Emprego:
    - Listagem de vagas disponíveis.
6. Perfis de Utilizadores:
    - Atualização de informações e preferências.
7. Contagem de Visitas:
    - Rastreia o número de visitas ao site.

---

 Estrutura do Projeto
```plaintext
/project-root
├── /css
│   ├── footer.css        # Estilo do rodapé
│   ├── form.css          # Estilo dos formulários
│   ├── layout.css        # Layout de componentes
│   ├── styles.css        # Estilos globais
├── /js
│   ├── cart-handler.js   # Gestão do carrinho
│   ├── products.js       # Carregamento e exibição de produtos
│   ├── scripts.js        # Validações e funcionalidades gerais
├── /php
│   ├── add-comment.php       # Adiciona comentários
│   ├── add-to-cart.php       # Adiciona produtos ao carrinho
│   ├── cart.php              # Visualiza o carrinho
│   ├── contador.php          # Rastreia visitas ao site
│   ├── db_connect.php        # Conexão com a base de dados
│   ├── login.php             # Gestão de login
│   ├── logout.php            # Termina sessão
│   ├── product-details.php   # Exibe detalhes do produto
│   ├── products.php          # Lista produtos
│   ├── profile.php           # Gestão de perfis de utilizadores
│   ├── remove-from-cart.php  # Remove itens do carrinho
├── db.sql                  # Esquema da base de dados
├── index.php              # Página inicial
├── register.html           # Página de registo
├── login.html              # Página de login
├── products.html           # Página de listagem de produtos
├── cart.html               # Página do carrinho
├── jobs.html               # Página de ofertas de emprego
└── README.md               # Documentação do projeto
```

---

 Requisitos do Sistema
- Servidor Web: Apache ou similar (compatível com PHP).
- PHP: Versão 7.4 ou superior.
- Base de Dados: MySQL/MariaDB.
- Navegador Compatível: Chrome, Firefox, Edge ou Safari.

---

Configuração do Projeto

 1. Configurar o Servidor Local
1. Instalar o XAMPP, WAMP ou equivalente.
2. Copiar os ficheiros do projeto para o diretório do servidor (ex.: `htdocs` no XAMPP).

 2. Configurar a Base de Dados
  1. Criar uma base de dados chamada `negocio_eletronico`.
  2. Importar o ficheiro `db.sql` para criar as tabelas necessárias.

 3. Configurar o Ficheiro `db_connect.php`
   1. Atualizar as credenciais de conexão à base de dados:
   ```php
   $servername = "localhost";
   $username = "root";
   $password = ""; // Deixar vazio, se aplicável
   $dbname = "negocio_eletronico";
   ```



Como Usar

1. Registo e Login
- Registar-se na página Register.
- Fazer login na página Login para aceder a funcionalidades como comentários e carrinho.

2. Gestão de Produtos
- Navegar até Products para visualizar e adicionar produtos ao carrinho.

3. Comentários e Avaliações
- Nos detalhes de um produto, adicionar comentários ou avaliações.

 4. Carrinho de Compras
- Adicionar produtos ao carrinho e finalizar compras na página Cart.

 5. Ofertas de Emprego
- Visualizar as vagas disponíveis na página Jobs.

---

Funcionalidades Extras
1. Perfis de Utilizadores:
    - Atualizar o perfil na página Profile.
2. Contagem de Visitas:
    - O sistema rastreia o número de visitas ao site.
3. Estilos Melhorados:
    - O design responsivo garante boa experiência em dispositivos móveis.


 Funcionalidades Futuras
- Integração com métodos de pagamento.
- Sistema de administração para gerir produtos e utilizadores.
- Melhorias no painel de perfil.



 Autores
Ivanilson Braga 

-
