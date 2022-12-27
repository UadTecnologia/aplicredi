# backend

## Project setup
```
composer install

composer dump

cp .env.example .env

php artisan key:generate

/* Usar somente se estiver utilizando uma base de dados limpa */
php artisan migrate

/* Usar somente se estiver utilizando uma base de dados limpa */
php artisan module:seed Demandas

```

# Comandos úteis
List routes
```
php artisan route:list
```
Cria status interações demandas
```
/* Usar somente se estiver utilizando uma base de dados limpa */
php demandas:insere-status-interacoes
```

### Compiles and hot-reloads for development
```
php artisan serve
```
# frontend

## Project setup
```
npm install
```

### Compiles and hot-reloads for development
```
npm run serve
```
or
```
npm run watch
```

### Compiles and minifies for production
```
npm run prod
```
