# 🐾 SAAU - Sistema de Adoção de Animais de Umuarama

Sistema completo de gerenciamento de adoção de animais desenvolvido em **PHP/Laravel + MySQL** para o TCC.

## 📋 Requisitos do Sistema

O sistema foi desenvolvido utilizando tecnologias modernas e robustas para garantir escalabilidade e manutenibilidade. Os requisitos mínimos para execução incluem PHP 8.1 ou superior, MySQL 8.0 ou superior, Composer para gerenciamento de dependências PHP, e um servidor web como Apache ou Nginx. Recomenda-se também ter Git instalado para controle de versão.

## 🚀 Instalação Rápida

Para instalar o sistema em um novo ambiente, primeiro clone ou extraia o projeto para o diretório desejado. Em seguida, navegue até o diretório do projeto e instale as dependências PHP executando o comando `composer install`. 

Após a instalação das dependências, configure o arquivo de ambiente copiando o arquivo `.env.example` para `.env` e ajustando as configurações do banco de dados. As principais variáveis a serem configuradas são `DB_DATABASE`, `DB_USERNAME` e `DB_PASSWORD`.

Com o ambiente configurado, crie o banco de dados MySQL executando `CREATE DATABASE saau_final CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;`. Execute as migrações do banco de dados com `php artisan migrate` e popule o banco com dados iniciais usando `php artisan db:seed`.

Gere a chave de aplicação com `php artisan key:generate` e crie o link simbólico para armazenamento de arquivos com `php artisan storage:link`. Por fim, inicie o servidor de desenvolvimento com `php artisan serve` e acesse o sistema em `http://localhost:8000`.

## 🔐 Credenciais de Acesso

O sistema possui três níveis de acesso pré-configurados. O administrador pode acessar com o email `admin@saau.com` e senha `admin123`, tendo acesso total ao sistema incluindo gerenciamento de animais, eventos, rifas e aprovação de adoções. O veterinário utiliza `vet@saau.com` com senha `vet123`, podendo gerenciar informações de saúde dos animais. Usuários comuns podem se registrar ou usar `usuario@saau.com` com senha `usuario123` para solicitar adoções.

## 📁 Estrutura do Projeto

A estrutura do projeto segue o padrão MVC do Laravel. O diretório `app/Models` contém os modelos de dados incluindo Animal, User, Event, Raffle, AdoptionRequest, AdoptionStory, Vaccine e Donation. Os controladores estão em `app/Http/Controllers`, divididos entre controladores públicos e administrativos. As views Blade ficam em `resources/views`, organizadas por funcionalidade. As migrações do banco de dados estão em `database/migrations` e os seeders em `database/seeders`. As rotas são definidas em `routes/web.php` e `routes/api.php`.

## 🎨 Funcionalidades Implementadas

O sistema oferece uma área pública onde visitantes podem visualizar animais disponíveis para adoção, consultar eventos e rifas, e ler histórias de adoção bem-sucedidas. Usuários autenticados podem solicitar a adoção de animais através de formulários detalhados.

O painel administrativo completo permite o gerenciamento de animais com operações CRUD incluindo upload de fotos. Os administradores podem aprovar ou rejeitar pedidos de adoção, gerenciar eventos com datas e locais, criar e controlar rifas beneficentes, e acompanhar doações recebidas. O dashboard apresenta estatísticas em tempo real sobre animais disponíveis, adotados e pedidos pendentes.

## 🔧 Configurações Importantes

O sistema utiliza UUID como chave primária em todas as tabelas para maior segurança e escalabilidade. O upload de imagens está configurado para aceitar arquivos JPG, PNG e GIF com tamanho máximo de 2MB, armazenados em `public/storage`. A autenticação é gerenciada pelo Laravel Sanctum com suporte a múltiplos níveis de acesso. O CORS está configurado para permitir requisições de diferentes origens quando necessário.

## 🗄️ Banco de Dados

O banco de dados MySQL contém oito tabelas principais interligadas por relacionamentos bem definidos. A tabela `users` armazena informações de usuários com diferentes roles. A tabela `animals` contém dados completos dos animais incluindo espécie, raça, idade, sexo, porte, cor, descrição, status de saúde e foto. As tabelas `vaccines`, `adoption_requests`, `adoption_stories`, `events`, `raffles` e `donations` complementam o sistema com funcionalidades específicas.

## 📸 Upload de Imagens

O sistema de upload de imagens está totalmente funcional. As fotos de animais são armazenadas em `public/storage/animals`, as imagens de eventos em `public/storage/events` e as imagens de rifas em `public/storage/raffles`. O sistema valida automaticamente o tipo e tamanho dos arquivos, gerando nomes únicos usando UUID para evitar conflitos. Ao editar ou excluir registros, as imagens antigas são automaticamente removidas do servidor.

## 🎯 Tecnologias Utilizadas

O backend foi desenvolvido em PHP 8.1 utilizando o framework Laravel 10, considerado um dos frameworks PHP mais modernos e populares. O banco de dados MySQL 8 garante robustez e confiabilidade no armazenamento de dados. A autenticação é gerenciada pelo Laravel Sanctum, proporcionando segurança sem complexidade excessiva. O frontend utiliza Bootstrap 5 para interface responsiva, Font Awesome para ícones e Blade como engine de templates integrada ao Laravel.

## 🔄 Migração do Sistema Original

Este sistema é uma migração completa do projeto original desenvolvido em Python/FastAPI + MongoDB + React. Todas as funcionalidades foram reimplementadas em PHP/Laravel mantendo a mesma lógica de negócio e melhorando a arquitetura. A migração incluiu conversão de banco NoSQL (MongoDB) para SQL (MySQL), reimplementação de APIs REST em Laravel, conversão de componentes React para views Blade, e manutenção de todas as regras de negócio originais.

## 📞 Suporte e Manutenção

Para problemas comuns, verifique primeiro se o servidor Laravel está rodando corretamente. Consulte os logs de erro em `storage/logs/laravel.log` para identificar problemas. Limpe o cache do Laravel com os comandos `php artisan cache:clear`, `php artisan config:clear` e `php artisan view:clear`. Verifique as permissões das pastas `storage` e `public/storage`, que devem ter permissão de escrita. Confirme que as configurações do banco de dados no arquivo `.env` estão corretas.

## 🎓 Apresentação TCC

Para a apresentação do TCC, recomenda-se demonstrar o fluxo completo de adoção começando pela navegação pública, passando pelo cadastro de usuário, solicitação de adoção, login administrativo e aprovação do pedido. Destaque o sistema de upload de imagens funcionando, o dashboard com estatísticas em tempo real, e o gerenciamento completo de eventos e rifas. Enfatize a migração bem-sucedida de Python/FastAPI para PHP/Laravel mantendo todas as funcionalidades.

## 📄 Licença

Sistema desenvolvido para fins acadêmicos como Trabalho de Conclusão de Curso (TCC). Todos os direitos reservados à SAAU - Sociedade de Amparo aos Animais de Umuarama.

---

**Desenvolvido com ❤️ para ajudar animais a encontrarem um lar! 🐾**
