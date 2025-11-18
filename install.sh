#!/bin/bash

echo "🐾 INSTALADOR SAAU - Sistema de Adoção de Animais"
echo "=================================================="
echo ""

# Verificar PHP
if ! command -v php &> /dev/null; then
    echo "❌ PHP não encontrado. Por favor, instale PHP 8.1 ou superior."
    exit 1
fi

echo "✅ PHP encontrado: $(php -v | head -n 1)"

# Verificar Composer
if ! command -v composer &> /dev/null; then
    echo "❌ Composer não encontrado. Por favor, instale o Composer."
    exit 1
fi

echo "✅ Composer encontrado"

# Verificar MySQL
if ! command -v mysql &> /dev/null; then
    echo "⚠️  MySQL não encontrado. Certifique-se de ter MySQL instalado."
fi

echo ""
echo "📦 Instalando dependências..."
composer install --no-interaction --prefer-dist

echo ""
echo "🔧 Configurando ambiente..."

if [ ! -f .env ]; then
    cp .env.example .env
    echo "✅ Arquivo .env criado"
fi

php artisan key:generate

echo ""
echo "📊 Configuração do Banco de Dados"
echo "=================================="
read -p "Nome do banco de dados [saau_final]: " DB_NAME
DB_NAME=${DB_NAME:-saau_final}

read -p "Usuário MySQL [root]: " DB_USER
DB_USER=${DB_USER:-root}

read -sp "Senha MySQL: " DB_PASS
echo ""

# Atualizar .env
sed -i "s/DB_DATABASE=.*/DB_DATABASE=$DB_NAME/" .env
sed -i "s/DB_USERNAME=.*/DB_USERNAME=$DB_USER/" .env
sed -i "s/DB_PASSWORD=.*/DB_PASSWORD=$DB_PASS/" .env

echo ""
echo "🗄️  Criando banco de dados..."
mysql -u$DB_USER -p$DB_PASS -e "CREATE DATABASE IF NOT EXISTS $DB_NAME CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

if [ $? -eq 0 ]; then
    echo "✅ Banco de dados criado"
else
    echo "❌ Erro ao criar banco de dados"
    exit 1
fi

echo ""
echo "🔄 Executando migrações..."
php artisan migrate --force

echo ""
echo "🌱 Populando banco com dados iniciais..."
php artisan db:seed --force

echo ""
echo "🔗 Criando link simbólico para storage..."
php artisan storage:link

echo ""
echo "🎨 Criando diretórios de upload..."
mkdir -p public/storage/animals
mkdir -p public/storage/events
mkdir -p public/storage/raffles
chmod -R 777 public/storage

echo ""
echo "✨ Instalação concluída com sucesso!"
echo ""
echo "🚀 Para iniciar o servidor, execute:"
echo "   php artisan serve"
echo ""
echo "🔐 Credenciais de acesso:"
echo "   Admin: admin@saau.com / admin123"
echo "   Vet: vet@saau.com / vet123"
echo "   Usuário: usuario@saau.com / usuario123"
echo ""
echo "📖 Consulte o arquivo GUIA_TESTE_TCC.md para mais informações"
echo ""
