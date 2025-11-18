# 🔐 Sistema de Login Separado - SAAU

## ✅ Implementação Completa

O sistema agora possui **DOIS logins completamente separados**:

---

## 👥 DOIS SISTEMAS DE LOGIN

### 1. Login do Adotante (`/login`)

**Quem usa:** Pessoas que querem adotar animais

**Acesso:**
- URL: `http://localhost:8000/login`
- Link no menu: "Entrar" (ícone de usuário)

**O que pode fazer:**
- ✅ Ver animais disponíveis
- ✅ Ver detalhes dos animais
- ✅ **Solicitar adoção** (formulário só aparece após login)
- ✅ Ver eventos, rifas, histórias
- ✅ Navegar em todas as páginas públicas

**O que NÃO pode fazer:**
- ❌ Acessar painel administrativo
- ❌ Ver menu "Painel Admin"
- ❌ Gerenciar animais, eventos, etc.

**Registro:**
- Pode se registrar em `/register`
- Conta criada automaticamente como `role='user'`

---

### 2. Login do Admin/Vet (`/admin/login`)

**Quem usa:** Administradores e Veterinários da SAAU

**Acesso:**
- URL: `http://localhost:8000/admin/login`
- Link no menu: "Admin" (ícone de escudo)

**O que pode fazer:**
- ✅ Tudo que o adotante pode
- ✅ **Acessar painel administrativo** (`/admin/dashboard`)
- ✅ Gerenciar animais (criar, editar, deletar)
- ✅ Gerenciar eventos e rifas
- ✅ Aprovar/rejeitar pedidos de adoção
- ✅ Registrar vacinas e doações
- ✅ Criar usuários
- ✅ Baixar relatórios CSV
- ✅ Aprovar histórias de adoção

**O que NÃO pode fazer:**
- ❌ Se registrar (conta criada apenas pelo admin)

**Registro:**
- Não pode se auto-registrar
- Contas criadas apenas por outro admin em `/admin/users/create`

---

## 🔒 SEGURANÇA E PROTEÇÃO

### Middleware `CheckAdmin`

Todas as rotas `/admin/*` estão protegidas por middleware que:

1. **Verifica se está logado**
   - Se não: redireciona para `/admin/login`

2. **Verifica se é admin ou vet**
   - Checa se `role === 'admin'` OU `role === 'vet'`
   - Se for usuário comum (`role === 'user'`):
     - Faz logout automático
     - Redireciona para `/admin/login`
     - Mostra mensagem: "Acesso negado. Apenas administradores e veterinários podem acessar esta área."

### Proteção de Rotas

**Rotas Públicas** (sem login):
- `/` - Home
- `/animais` - Listagem
- `/animal/{id}` - Detalhes
- `/eventos`, `/rifas`, `/stories`
- `/faq`, `/como-funciona`, `/como-ajudar`
- `/login` - Login adotante
- `/register` - Registro adotante
- `/admin/login` - Login admin

**Rotas Protegidas** (precisa login de adotante):
- `/animal/{id}/adotar` - Enviar pedido

**Rotas Admin** (precisa login de admin/vet):
- `/admin/dashboard`
- `/admin/animals/*`
- `/admin/events/*`
- `/admin/raffles/*`
- `/admin/vaccines/*`
- `/admin/donations/*`
- `/admin/users/*`
- `/admin/adoption-requests/*`
- `/admin/stories/*`
- `/admin/reports/*`

---

## 🎯 FLUXO COMPLETO

### Fluxo do Adotante:

**1. Navegar sem login**
```
Home → Animais → Detalhes do Animal
```
- Vê mensagem: "Faça login para solicitar adoção"

**2. Fazer login**
```
Clica em "Entrar" → /login → Preenche e-mail e senha → Entrar
```
- Redirecionado de volta para página do animal

**3. Solicitar adoção**
```
Vê formulário → Preenche dados → Envia pedido
```
- Pedido salvo no banco
- Admin pode ver em `/admin/adoption-requests`

**4. Logout**
```
Clica no nome → Sair
```
- Logout via `/logout`
- Redirecionado para home

---

### Fluxo do Admin:

**1. Fazer login**
```
Clica em "Admin" → /admin/login → Preenche e-mail e senha → Entrar no Painel Admin
```
- Se credenciais corretas E role é admin/vet:
  - Login bem-sucedido
  - Redirecionado para `/admin/dashboard`
- Se credenciais corretas MAS role é user:
  - Logout automático
  - Mensagem de erro
  - Volta para `/admin/login`

**2. Acessar painel**
```
Vê menu "Painel Admin" → Dropdown com todas as opções
```
- Dashboard, Animais, Pedidos, Eventos, etc.

**3. Gerenciar sistema**
```
Menu Admin → Qualquer opção → CRUD completo
```

**4. Logout**
```
Clica no nome → Sair
```
- Logout via `/admin/logout`
- Redirecionado para `/admin/login`

---

## 📋 DIFERENÇAS VISUAIS

### Menu para Visitante (não logado):
```
Início | Adotar | Eventos | Rifas | Histórias | Como Funciona | Como Ajudar | FAQ | [Entrar] | [Admin]
```

### Menu para Adotante (logado):
```
Início | Adotar | Eventos | Rifas | Histórias | Como Funciona | Como Ajudar | FAQ | [João ▼]
                                                                                      └─ Sair
```

### Menu para Admin/Vet (logado):
```
Início | Adotar | Eventos | Rifas | Histórias | Como Funciona | Como Ajudar | FAQ | [Painel Admin ▼] | [Admin ▼]
                                                                                     ├─ Dashboard           └─ Sair
                                                                                     ├─ Animais
                                                                                     ├─ Pedidos
                                                                                     ├─ Eventos
                                                                                     ├─ Rifas
                                                                                     ├─ Vacinas
                                                                                     ├─ Doações
                                                                                     ├─ Usuários
                                                                                     ├─ Histórias
                                                                                     └─ Relatórios
```

---

## 🧪 COMO TESTAR

### Teste 1: Login do Adotante

**1. Acesse:** `http://localhost:8000`

**2. Clique em "Entrar"**
- Deve ir para `/login`
- Vê formulário de login do adotante

**3. Registre-se:**
- Clique em "Registrar"
- Preencha: Nome, E-mail, Senha
- Clique em "Registrar"
- Conta criada com `role='user'`

**4. Faça login:**
- E-mail e senha que acabou de criar
- Clique em "Entrar"
- Logado com sucesso

**5. Tente acessar admin:**
- Digite na URL: `/admin/dashboard`
- **Deve ser bloqueado!**
- Logout automático
- Redirecionado para `/admin/login`
- Mensagem de erro

**6. Solicite adoção:**
- Vá para `/animais`
- Clique em um animal
- **Agora vê o formulário!**
- Preencha e envie

---

### Teste 2: Login do Admin

**1. Acesse:** `http://localhost:8000`

**2. Clique em "Admin"**
- Deve ir para `/admin/login`
- Vê formulário de login admin (diferente visualmente)

**3. Faça login:**
- E-mail: `admin@saau.com`
- Senha: `admin123`
- Clique em "Entrar no Painel Admin"
- Logado com sucesso

**4. Acesse painel:**
- Redirecionado automaticamente para `/admin/dashboard`
- Vê menu "Painel Admin" no topo
- Vê todas as estatísticas

**5. Gerencie sistema:**
- Menu Painel Admin → Qualquer opção
- Tudo funciona!

**6. Veja pedidos de adoção:**
- Menu Painel Admin → Pedidos de Adoção
- Vê o pedido que o adotante enviou
- Pode aprovar ou rejeitar

---

### Teste 3: Tentativa de Acesso Indevido

**1. Faça login como adotante:**
- `/login` com conta de usuário comum

**2. Tente acessar:**
- `/admin/dashboard`
- `/admin/animals`
- Qualquer rota `/admin/*`

**3. Resultado esperado:**
- ❌ Acesso negado
- Logout automático
- Redirecionado para `/admin/login`
- Mensagem: "Acesso negado. Apenas administradores e veterinários podem acessar esta área."

---

## 👤 USUÁRIOS DE TESTE

### Adotante (Usuário Comum):
- **E-mail:** usuario@saau.com
- **Senha:** usuario123
- **Role:** user
- **Pode:** Solicitar adoção
- **Não pode:** Acessar painel admin

### Administrador:
- **E-mail:** admin@saau.com
- **Senha:** admin123
- **Role:** admin
- **Pode:** Tudo (solicitar adoção + gerenciar sistema)

### Veterinário:
- **E-mail:** vet@saau.com
- **Senha:** vet123
- **Role:** vet
- **Pode:** Tudo (solicitar adoção + gerenciar sistema)

---

## ✅ RESUMO

| Aspecto | Adotante (`/login`) | Admin (`/admin/login`) |
|---|---|---|
| **URL** | `/login` | `/admin/login` |
| **Link no Menu** | "Entrar" 👤 | "Admin" 🛡️ |
| **Pode se Registrar** | ✅ Sim (`/register`) | ❌ Não |
| **Role no Banco** | `user` | `admin` ou `vet` |
| **Acesso Público** | ✅ Sim | ✅ Sim |
| **Acesso Admin** | ❌ Bloqueado | ✅ Total |
| **Menu Visível** | Apenas público | Público + Admin |
| **Logout** | `/logout` | `/admin/logout` |
| **Redirecionamento** | Página anterior | `/admin/dashboard` |

---

## 🎓 PARA SUA APRESENTAÇÃO

**Demonstre os dois fluxos:**

**1. Fluxo do Adotante:**
- Mostre o link "Entrar" no menu
- Faça login como usuário comum
- Tente adotar um animal
- Mostre que NÃO vê menu admin
- Tente acessar `/admin/dashboard` na URL
- Mostre que é bloqueado

**2. Fluxo do Admin:**
- Faça logout
- Mostre o link "Admin" no menu
- Faça login como admin
- Mostre o painel completo
- Mostre o pedido de adoção que foi enviado
- Aprove o pedido

**Destaque:**
- Segurança robusta
- Separação clara de responsabilidades
- Interface intuitiva
- Proteção automática de rotas

---

**🐾 Sistema de Login Separado e Seguro! 🔐**
