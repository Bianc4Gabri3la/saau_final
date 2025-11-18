# 📋 GUIA DE TESTE - SAAU TCC
## Sistema de Adoção de Animais - Laravel + MySQL

---

## 🔐 CREDENCIAIS DE ACESSO

**Administrador:**
- Email: `admin@saau.com`
- Senha: `admin123`

**Veterinário:**
- Email: `vet@saau.com`
- Senha: `vet123`

**Usuário Comum:**
- Email: `usuario@saau.com`
- Senha: `usuario123`

---

## 🎯 ROTEIRO DE DEMONSTRAÇÃO

### 1️⃣ ÁREA PÚBLICA (Sem Login)

**Página Inicial**
- ✅ Ver estatísticas (3 animais, 2 disponíveis, 1 adotado)
- ✅ Ver animais em destaque
- ✅ Navegação pelo menu

**Listagem de Animais**
- ✅ Ver todos os animais cadastrados (Rex, Mia, Bob)
- ✅ Filtrar por espécie (cachorro/gato)
- ✅ Ver detalhes de cada animal

**Detalhes do Animal**
- ✅ Ver foto, nome, idade, raça, descrição
- ✅ Ver status (disponível/adotado)
- ✅ Botão "Solicitar Adoção" (requer login)

**Eventos e Rifas**
- ✅ Ver eventos cadastrados
- ✅ Ver rifas ativas

**Histórias de Adoção**
- ✅ Ver histórias de sucesso

---

### 2️⃣ FAZER LOGIN COMO ADMIN

1. Clicar em "Entrar" no menu
2. Usar: `admin@saau.com` / `admin123`
3. Após login, ver menu "Admin" no topo

---

### 3️⃣ PAINEL ADMINISTRATIVO

**Dashboard**
- ✅ Ver estatísticas gerais
- ✅ Ver últimos animais cadastrados
- ✅ Ver pedidos de adoção recentes
- ✅ Ações rápidas

---

### 4️⃣ GERENCIAR ANIMAIS

**Listar Animais**
- Menu Admin → Animais
- ✅ Ver tabela com todos os animais
- ✅ Ver foto, nome, espécie, status

**Cadastrar Novo Animal**
- Clicar em "Cadastrar Novo Animal"
- Preencher:
  - Nome: `Luna`
  - Espécie: `Gato`
  - Raça: `Siamês`
  - Idade: `2`
  - Sexo: `Fêmea`
  - Porte: `Pequeno`
  - Cor: `Branco e marrom`
  - Descrição: `Gata carinhosa e brincalhona`
  - Status: `Disponível`
  - Foto: (fazer upload de uma imagem)
- ✅ Salvar e ver mensagem de sucesso

**Editar Animal**
- Clicar no botão de editar (lápis amarelo)
- Alterar algum campo (ex: idade)
- ✅ Salvar alterações

**Excluir Animal**
- Clicar no botão vermelho (lixeira)
- Confirmar exclusão
- ✅ Ver mensagem de sucesso

---

### 5️⃣ GERENCIAR PEDIDOS DE ADOÇÃO

**Ver Pedidos**
- Menu Admin → Pedidos de Adoção
- ✅ Ver lista de todos os pedidos
- ✅ Ver status (pendente/aprovado/rejeitado)

**Visualizar Detalhes**
- Clicar no botão "Ver" (olho azul)
- ✅ Ver informações do adotante
- ✅ Ver informações do animal
- ✅ Ver mensagem do adotante

**Aprovar/Rejeitar Pedido**
- Alterar status para "Aprovado" ou "Rejeitado"
- Adicionar observações (opcional)
- ✅ Salvar e ver animal marcado como "Adotado" (se aprovado)

---

### 6️⃣ GERENCIAR EVENTOS

**Listar Eventos**
- Menu Admin → Eventos
- ✅ Ver todos os eventos

**Criar Novo Evento**
- Clicar em "Criar Novo Evento"
- Preencher:
  - Título: `Feira de Adoção - Dezembro`
  - Descrição: `Grande feira de adoção no parque central`
  - Data: `2025-12-15`
  - Local: `Parque Central de Umuarama`
  - Marcar como "Ativo"
  - Upload de imagem (opcional)
- ✅ Salvar

**Editar/Excluir Evento**
- ✅ Testar edição
- ✅ Testar exclusão

---

### 7️⃣ GERENCIAR RIFAS

**Listar Rifas**
- Menu Admin → Rifas
- ✅ Ver todas as rifas

**Criar Nova Rifa**
- Clicar em "Criar Nova Rifa"
- Preencher:
  - Título: `Rifa de Natal 2025`
  - Descrição: `Ajude a SAAU comprando um bilhete`
  - Prêmio: `Cesta de Natal`
  - Valor do Bilhete: `10.00`
  - Total de Bilhetes: `100`
  - Data do Sorteio: `2025-12-20`
  - Status: `Ativa`
  - Upload de imagem (opcional)
- ✅ Salvar

**Editar/Excluir Rifa**
- ✅ Testar edição
- ✅ Testar exclusão

---

## 🎨 PONTOS FORTES PARA DESTACAR NA APRESENTAÇÃO

### ✅ Migração Completa
- Sistema original: Python/FastAPI + MongoDB + React
- Sistema novo: PHP/Laravel + MySQL + Blade
- **100% funcional** com todas as features

### ✅ Tecnologias Modernas
- **Backend:** Laravel 10 (framework PHP mais popular)
- **Banco:** MySQL 8 (SGBD relacional robusto)
- **Frontend:** Bootstrap 5 (responsivo)
- **Autenticação:** Laravel Sanctum
- **Upload:** Sistema de upload de imagens funcional

### ✅ Funcionalidades Implementadas
1. ✅ Cadastro e gerenciamento de animais
2. ✅ Sistema de adoção com workflow completo
3. ✅ Gerenciamento de eventos
4. ✅ Gerenciamento de rifas
5. ✅ Histórias de adoção
6. ✅ Dashboard administrativo
7. ✅ Controle de acesso (admin/veterinário/usuário)
8. ✅ Upload de imagens
9. ✅ Interface responsiva

### ✅ Boas Práticas
- Código organizado (MVC)
- Validação de dados
- Mensagens de sucesso/erro
- Confirmação antes de deletar
- Paginação de resultados
- UUID como chave primária
- CORS configurado

---

## 🚀 COMANDOS ÚTEIS

**Iniciar servidor:**
```bash
cd /home/ubuntu/saau-final
php artisan serve
```

**Acessar banco de dados:**
```bash
mysql -u root saau_final
```

**Ver logs de erro:**
```bash
tail -f storage/logs/laravel.log
```

**Limpar cache:**
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

---

## 📊 ESTRUTURA DO BANCO DE DADOS

**Tabelas Criadas:**
1. `users` - Usuários do sistema
2. `animals` - Animais para adoção
3. `vaccines` - Vacinas dos animais
4. `events` - Eventos da SAAU
5. `raffles` - Rifas beneficentes
6. `adoption_requests` - Pedidos de adoção
7. `adoption_stories` - Histórias de sucesso
8. `donations` - Doações recebidas

**Relacionamentos:**
- Animal → Vaccines (1:N)
- Animal → AdoptionRequests (1:N)
- Animal → AdoptionStory (1:1)

---

## 🎯 CHECKLIST FINAL ANTES DA APRESENTAÇÃO

- [ ] Servidor Laravel rodando
- [ ] Banco MySQL com dados de teste
- [ ] Login admin funcionando
- [ ] Upload de imagens funcionando
- [ ] Todas as páginas carregando
- [ ] Menu de navegação funcionando
- [ ] CRUD de animais completo
- [ ] CRUD de eventos completo
- [ ] CRUD de rifas completo
- [ ] Pedidos de adoção funcionando
- [ ] Layout com cores da SAAU

---

## 📞 SUPORTE

Em caso de problemas:
1. Verificar se o servidor está rodando
2. Verificar logs de erro
3. Limpar cache do Laravel
4. Verificar permissões de pastas (storage, public)

---

**BOA SORTE NA APRESENTAÇÃO! 🎓🐾**
