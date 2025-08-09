## Estoque Açaí (PHP + MySQL)

Aplicação web com interface moderna para gerenciar estoque de itens relacionados a açaí. Permite cadastrar, listar, buscar, editar e remover produtos com controle de preço, quantidade e unidade. O projeto foi pensado para ser simples de subir no XAMPP e já vem com dados iniciais.

### Demonstração
![Tela do Sistema](./estoque_acai/assets/img.jpg)

### Funcionalidades
- Cadastro de produtos (nome, categoria, descrição, preço, quantidade, unidade)
- Listagem com busca por nome ou categoria
- Edição e exclusão de itens
- Criação automática do banco e da tabela no primeiro acesso
- Inserção automática de 10 itens iniciais de açaí
- Interface responsiva (Bootstrap 5 + Bootstrap Icons + Google Fonts)
- Proteção CSRF em formulários

### Requisitos
- XAMPP com Apache e MySQL ativos
- PHP 8+ (padrão no XAMPP recente)

### Instalação (XAMPP - Windows)
1. Copie a pasta `estoque_acai` para `C:\xampp\htdocs\estoque_acai`.
2. Configure o acesso ao banco em `estoque_acai/config.php`:
   ```php
   define('DB_USER', 'root');
   define('DB_PASS', 'root'); // ajuste conforme sua instalação
   define('DB_HOST', 'localhost');
   define('DB_PORT', '3306');
   define('BASE_URL', '/estoque_acai'); // ajuste se mudar a pasta
   ```
3. Inicie Apache e MySQL no XAMPP Control Panel.
4. Acesse `http://localhost/estoque_acai/` no navegador.
   - No primeiro acesso, o sistema cria o banco `estoque_acai`, a tabela `produtos` e insere 10 registros de exemplo.

### Estrutura do Projeto
```
/ (raiz do workspace)
├─ assets/                 # (opcional) pasta geral para imagens do repositório
├─ estoque_acai/
│  ├─ assets/
│  │  ├─ img.jpg           # Imagem usada como logo na navbar
│  │  └─ style.css         # Estilos customizados
│  ├─ partials/
│  │  ├─ header.php        # Navbar e início do layout
│  │  └─ footer.php        # Scripts e rodapé
│  ├─ .htaccess            # Regras básicas e segurança
│  ├─ config.php           # Configurações gerais (DB e BASE_URL)
│  ├─ db.php               # Conexão PDO e bootstrap do schema/dados
│  ├─ helpers.php          # Flash messages, CSRF e helpers
│  ├─ index.php            # Listagem e busca
│  ├─ create.php           # Criação de item
│  ├─ edit.php             # Edição de item
│  └─ delete.php           # Remoção de item
└─ README.md
```

### Banco de Dados
- Banco: `estoque_acai`
- Tabela: `produtos`
  - Campos: `id (PK)`, `nome`, `categoria`, `descricao`, `preco DECIMAL(10,2)`, `quantidade INT`, `unidade`, `criado_em`, `atualizado_em`
- Dados iniciais (10 itens): tigelas de açaí (300/500ml), variações com granola/banana, polpa 1kg, granola 1kg, copos e tampas 500ml, etc.

### Personalização
- Trocar logo: substitua o arquivo `estoque_acai/assets/img.jpg` pela sua imagem
- Estilos: edite `estoque_acai/assets/style.css`
- Navegação: `estoque_acai/partials/header.php`
- Rodapé: `estoque_acai/partials/footer.php`
- URL base: `BASE_URL` em `estoque_acai/config.php` se a pasta mudar

### Solução de Problemas
- Access denied (MySQL):
  - Verifique `DB_USER` e `DB_PASS` em `estoque_acai/config.php`.
  - Alternativa: criar usuário dedicado e usar no `config.php`:
    ```sql
    CREATE USER 'estoque'@'localhost' IDENTIFIED BY 'acai123';
    CREATE DATABASE IF NOT EXISTS estoque_acai CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
    GRANT ALL PRIVILEGES ON estoque_acai.* TO 'estoque'@'localhost';
    FLUSH PRIVILEGES;
    ```
    Em seguida:
    ```php
    define('DB_USER', 'estoque');
    define('DB_PASS', 'acai123');
    ```
- Página não abre:
  - Confirme a pasta em `C:\xampp\htdocs\estoque_acai`
  - Inicie Apache e MySQL no XAMPP Control Panel
  - Veja o log: `C:\xampp\apache\logs\error.log`

### Licença
Uso livre para estudos e projetos internos.


