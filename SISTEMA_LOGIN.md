# 🔐 Sistema de Login - SAAU

## Como Funciona o Sistema de Autenticação

---

## 👥 DOIS TIPOS DE USUÁRIOS

### 1. **Adotante (Usuário Comum)**
- **Objetivo:** Solicitar adoção de animais
- **Onde faz login:** Site público (`/login`)
- **O que pode fazer:**
  - Ver animais disponíveis
  - Ver detalhes dos animais
  - **Solicitar adoção** (precisa estar logado)
  - Ver eventos, rifas, histórias
  
### 2. **Administrador / Veterinário**
- **Objetivo:** Gerenciar o sistema
- **Onde faz login:** Mesmo lugar (`/login`)
- **O que pode fazer:**
  - Tudo que o adotante pode
  - **Acessar painel admin** (`/admin/dashboard`)
  - Gerenciar animais, eventos, rifas
  - Aprovar/rejeitar pedidos de adoção
  - Registrar vacinas e doações
  - Criar usuários

---

## 🔑 COMO FUNCIONA

### Para o Adotante:

**1. Registrar-se**
- Acessa `/register`
- Preenche: Nome, E-mail, Senha
- Clica em "Registrar"
- ✅ Conta criada automaticamente como **usuário comum**

**2. Fazer Login**
- Acessa `/login`
- Preenche: E-mail, Senha
- Clica em "Entrar"
- ✅ Logado no sistema

**3. Solicitar Adoção**
- Navega para `/animais`
- Clica em um animal
- Vê o formulário de adoção (só aparece se estiver logado)
- Preenche: Nome completo, E-mail, Telefone, Cidade, Tipo de moradia, Mensagem
- Clica em "Enviar Pedido"
- ✅ Pedido enviado para o admin avaliar

**4. Sem Login**
- Se não estiver logado, vê mensagem:
  > "Faça login para solicitar adoção de [Nome do Animal]"
- Clica no link e é redirecionado para `/login`

---

### Para o Admin/Vet:

**1. Fazer Login**
- Acessa `/login` (mesmo lugar que o adotante)
- Preenche: E-mail, Senha
- Clica em "Entrar"
- ✅ Logado no sistema

**2. Acessar Painel Admin**
- Após login, vê menu "Painel Admin" no topo
- Clica em "Painel Admin"
- É redirecionado para `/admin/dashboard`
- ✅ Acesso ao painel administrativo

**3. Gerenciar Sistema**
- Menu dropdown "Admin" com todas as opções:
  - Dashboard
  - Animais
  - Pedidos de Adoção
  - Eventos
  - Rifas
  - Vacinas
  - Doações
  - Usuários
  - Histórias
  - Relatórios

---

## 🎯 DIFERENÇAS IMPORTANTES

| Aspecto | Adotante | Admin/Vet |
|---|---|---|
| **Página de Login** | `/login` | `/login` (mesma) |
| **Registro** | Pode se registrar (`/register`) | Criado pelo admin |
| **Após Login** | Volta para página anterior | Pode acessar `/admin` |
| **Permissões** | Apenas solicitar adoção | Gerenciar tudo |
| **Menu** | Só vê menu público | Vê menu público + admin |

---

## 📋 FLUXO COMPLETO DE ADOÇÃO

### Lado do Adotante:

1. **Navega no site** (sem login)
   - Vê animais disponíveis
   - Vê eventos, rifas, histórias
   - Lê FAQ, Como Funciona, Como Ajudar

2. **Encontra um animal**
   - Clica em "Ver Detalhes"
   - Lê todas as informações
   - Decide adotar

3. **Faz login/registro**
   - Se não tem conta: `/register`
   - Se já tem conta: `/login`

4. **Solicita adoção**
   - Preenche formulário
   - Envia pedido
   - Aguarda resposta do admin

### Lado do Admin:

1. **Faz login**
   - Acessa `/login`
   - Entra com credenciais de admin

2. **Acessa painel**
   - Clica em "Painel Admin"
   - Vê dashboard com estatísticas

3. **Visualiza pedidos**
   - Menu Admin → Pedidos de Adoção
   - Vê lista de todos os pedidos

4. **Avalia pedido**
   - Clica em "Ver Detalhes"
   - Lê informações do adotante
   - Decide aprovar ou rejeitar

5. **Atualiza status**
   - Seleciona: Pendente / Aprovado / Rejeitado
   - Adiciona observações (opcional)
   - Salva

6. **Adotante é notificado**
   - (Futuramente pode ter e-mail automático)

---

## 🔒 SEGURANÇA

### Proteção de Rotas

**Rotas Públicas** (qualquer um pode acessar):
- `/` - Home
- `/animais` - Lista de animais
- `/animal/{id}` - Detalhes do animal
- `/eventos` - Eventos
- `/rifas` - Rifas
- `/stories` - Histórias
- `/faq` - FAQ
- `/como-funciona` - Como Funciona
- `/como-ajudar` - Como Ajudar
- `/login` - Login
- `/register` - Registro

**Rotas Protegidas** (precisa estar logado):
- `/animal/{id}/adotar` - Enviar pedido de adoção

**Rotas Admin** (precisa ser admin/vet):
- `/admin/*` - Todas as rotas do painel admin

### Middleware

- `auth` - Verifica se está logado
- `auth` + verificação de role - Verifica se é admin/vet

---

## 👤 USUÁRIOS PRÉ-CADASTRADOS

### Para Testar como Admin:
- **E-mail:** admin@saau.com
- **Senha:** admin123
- **Tipo:** Administrador

### Para Testar como Veterinário:
- **E-mail:** vet@saau.com
- **Senha:** vet123
- **Tipo:** Veterinário

### Para Testar como Adotante:
- **E-mail:** usuario@saau.com
- **Senha:** usuario123
- **Tipo:** Usuário comum

**OU** crie uma nova conta em `/register`

---

## ✅ RESUMO

### ✅ Login do Adotante:
- **Onde:** Site público (`/login`)
- **Para que:** Solicitar adoção de animais
- **Acesso:** Apenas formulário de adoção

### ✅ Login do Admin:
- **Onde:** Mesmo lugar (`/login`)
- **Para que:** Gerenciar todo o sistema
- **Acesso:** Painel admin completo

### ✅ Diferenciação:
- **Automática** pelo campo `role` no banco de dados
- **Adotante:** role = 'user'
- **Admin:** role = 'admin'
- **Veterinário:** role = 'vet'

---

## 🎓 PARA SUA APRESENTAÇÃO

**Demonstre:**

1. **Fluxo do Adotante:**
   - Navegue sem login
   - Tente adotar (mostra que precisa login)
   - Faça login como usuário comum
   - Solicite adoção com sucesso

2. **Fluxo do Admin:**
   - Faça login como admin
   - Acesse painel admin
   - Veja o pedido de adoção
   - Aprove o pedido

**Destaque:**
- Sistema único de login para todos
- Diferenciação automática por role
- Segurança nas rotas
- Interface intuitiva

---

**🐾 Sistema de Login Completo e Funcional! 🔐**
