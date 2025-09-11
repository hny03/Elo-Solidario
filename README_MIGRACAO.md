# 🚀 Elo Solidário - Versão Completa com Backend

## 📋 Sobre esta Versão

Esta é a versão **COMPLETA e ATUALIZADA** do projeto Elo Solidário, que inclui:

✅ **Frontend Atualizado** - Versão mais recente com header, footer e navegação completa
✅ **Backend PHP** - Sistema de login e cadastro com MySQL
✅ **Banco de Dados** - Estrutura MySQL pronta para importar
✅ **Arquivos de Teste** - Para verificar conexão com o banco
✅ **Documentação** - Guia completo de migração para InfinityFree

## 📁 Estrutura do Projeto

```
Elo-Solidario-Atualizado/
├── index.html                    # Página inicial (raiz do site)
├── html/                         # Páginas HTML
│   ├── cadastro.html            # Página de cadastro
│   ├── login.html               # Página de login
│   ├── perfil.html              # Página de perfil
│   └── sobre-nos.html           # Página sobre nós
├── css/                         # Arquivos de estilo
│   ├── cadastro.css
│   ├── header-footer.css
│   ├── index.css
│   ├── login.css
│   ├── perfil.css
│   └── sobrenos.css
├── javascript/                  # Scripts JavaScript
│   ├── cadastro.js
│   ├── login.js
│   ├── criarPost.js
│   ├── editarPost.js
│   ├── editarUsuario.js
│   ├── excluirPost.js
│   └── sobrenos.js
├── backend/                     # Backend PHP
│   ├── config.php              # Configuração do banco
│   ├── Usuario.php             # Classe de usuário
│   ├── cadastro.php            # API de cadastro
│   ├── login.php               # API de login
│   └── teste_conexao.php       # Teste de conexão
├── img/                        # Imagens principais
│   ├── EloSolidario.png        # Logo principal
│   ├── maos-coloridas.jpg      # Imagem de fundo
│   ├── facebook.png
│   ├── instagram.png
│   └── profile.png
├── imagens/                    # Outras imagens
│   ├── logo/                   # Logos das organizações
│   └── ícones diversos
├── bd_elo_solidario_corrigido.sql  # Banco de dados para importar
├── teste_banco.html               # Página para testar conexão
└── README_MIGRACAO.md            # Este arquivo
```

## 🔧 Como Fazer o Deploy no InfinityFree

### 1. Preparar o Banco de Dados

1. **Acesse o cPanel do InfinityFree**
2. **Vá em "MySQL Databases"**
3. **Crie um novo banco** (ex: `elo_solidario`)
4. **Anote as credenciais:**
   - Host: `sql204.infinityfree.com`
   - Database: `if0_39911081_[nome_do_banco]`
   - Username: `if0_39911081`
   - Password: `[sua_senha_do_cpanel]`

### 2. Importar o Banco de Dados

1. **Acesse o phpMyAdmin**
2. **Selecione seu banco de dados**
3. **Clique em "Importar"**
4. **Escolha o arquivo:** `bd_elo_solidario_corrigido.sql`
5. **Clique em "Executar"**

### 3. Configurar a Conexão

1. **Edite o arquivo:** `backend/config.php`
2. **Substitua as credenciais:**
```php
private $host = 'sql204.infinityfree.com';
private $db_name = 'if0_39911081_[SEU_BANCO]';  // Substitua pelo nome real
private $username = 'if0_39911081';
private $password = '[SUA_SENHA]';              // Substitua pela sua senha
```

### 4. Fazer Upload dos Arquivos

1. **Use FTP (FileZilla) ou File Manager**
2. **Envie TODOS os arquivos** para a pasta `htdocs`
3. **Mantenha a estrutura de pastas**

### 5. Testar a Aplicação

1. **Acesse:** `http://seusite.com/teste_banco.html`
2. **Clique em "Testar Conexão"**
3. **Verifique se aparece "Conexão Bem-sucedida"**

## 🌐 URLs de Acesso

- **Página Inicial:** `http://seusite.com/`
- **Cadastro:** `http://seusite.com/html/cadastro.html`
- **Login:** `http://seusite.com/html/login.html`
- **Teste de Conexão:** `http://seusite.com/teste_banco.html`

## ⚠️ Problemas Comuns

### Página em Branco
- ✅ **Solução:** Certifique-se de que o `index.html` está na raiz (`htdocs`)

### Erro de Conexão com Banco
- ✅ **Solução:** Verifique as credenciais no `config.php`
- ✅ **Dica:** Use o `teste_banco.html` para diagnosticar

### Imagens Não Carregam
- ✅ **Solução:** Verifique se as pastas `img/` e `imagens/` foram enviadas

### CSS Não Carrega
- ✅ **Solução:** Verifique se a pasta `css/` foi enviada corretamente

## 📞 Suporte

Se encontrar problemas:
1. Use o arquivo `teste_banco.html` para diagnosticar
2. Verifique os caminhos dos arquivos
3. Confirme se todas as pastas foram enviadas
4. Teste as credenciais do banco de dados

---

**Versão:** Completa com Backend
**Data:** Setembro 2025
**Status:** ✅ Pronto para Deploy

