### Perguntas
- Quais tecnologias você domina ou tem conhecimento?
- Qual o maior problema técnico que você resolveu? E como resolveu?
- Qual o projeto atual que você está trabalhando e quais tecnologias você Utiliza?
- Quais os seus conhecimentos versionamento de código (Git)?
- Sobre DevOps, quais plataformas você tem conhecimento (aws, azure, google cloud...), ou, quais SO (Linux) tem conhecimento?

### Objetivo
O objetivo deste teste é desenvolver um sistema de Chamados/Demandas e conhecer melhor as suas habilidades técnicas.
### Critérios
Nossas aplicações hoje são desenvolvidas em PHP, Laravel Framework, e o frontend é desenvolvido em VueJS 2, basedo nessas tecnologias, orientamos seguir os seguintes critérios:
- Utilização do php 7.2ˆ (ou superior) desejável a utilização de Laravel Framework.
- Desejável utilizar conceitos de API (Rest ou rPC).
- Implementar CRUD para todos os módulos (GET, PUT, POST, DELETE) (Usuários/Demandas...).
- Frontend (desejável VueJS).
- Documentar passo a passo para subir a aplicação (pode ser em arquivo .MD ou word).
### Requisitos
- Login
- Cadastros
	- Usuário
		- Nome
		- E-mail
		- Senha
	- Demandas/Chamados
		- Número (*Poderá utilizar a chave primária da base de dados)
		- Título
		- Descrição
		- Data de Abertura
		- Data de Fechamento
		- Usuário que abriu a demanda/chamado
		- Usuário atendeu a demanda/chamado
		- Status (Aberto, Andamento, Finalizado)
	- Interação de Demandas/Chamados
		- Número da Demanda
		- Usuário que fez a interação
		- Descrição
		- Data

# backend

## Project setup
```
composer install

composer dump

cp .env.example .env

php artisan key:generate

/* Usar somente se estiver utilizando uma base de dados limpa */
php artisan migrate


```

# Comandos úteis
List routes
```
php artisan route:list
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
