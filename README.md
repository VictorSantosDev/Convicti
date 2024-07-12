## RUN PROJECT

### Leia com atenção os comandos abaixo para execução

```bash
## Dependendo da verão do docker instalado utilize o "docker compose" sem traço

# ******Criação******

# construção e inicialização
- docker-compose up -d

# instalação das dependências
- docker-compose exec app_convicti composer install

# migração das tabelas do laravel para o banco relacional
- docker-compose exec app_convicti php artisan migrate

# gere a chave secreta do jwt
- docker-compose exec app_convicti php artisan jwt:secret

# permissão ncessária para desenvolvimento local
- docker exec -it --user=root app_convicti chmod -R 777 /var/www

# ******Semar******

# semear tabelas no banco de dados relacional
- docker-compose exec app_convicti php artisan db:seed

# ******Testes******

# crie a tabelas do banco de testing usando o comando abaixo
- docker-compose exec app_convicti php artisan migrate --env=testing

```

### INFO

```info

    VERSION PHP: 8.2
    VERSION MYSQL: 8.1
    VERSION LARAVEL: 11

```

### SEM DOCKER

Para rodar o projeto na máquina sem o uso de docker você precisa baixar as dependências abaixo do projeto.

- PHP 8.2
- MySQL 8.1
- Composer

### Desenvolvido

```bash
    
    - Victor emanuel Almeida Santos
    - victor_santos1162@hotmail.com
    - Desenvolvedor Back-End

```
