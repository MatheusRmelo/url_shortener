# Instale as dependências
`composer install` (PHP/Laravel)<br />
`npm install` (Node/Vue)<br />
# Configurando o .env
Copie o .env.example e renomeie para .env, depois rode o comando `php artisan key:generate`

Configure a consulta com o banco de dados no .env

### Para uso no docker
```
DB_CONNECTION=mysql
DB_HOST=database
DB_PORT=3306
DB_DATABASE=url_shortener
DB_USERNAME=admin
DB_PASSWORD=admin@123456
```
### Para uso local, adapte as conexões a sua instalação do MySQL ou Mariadb.
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```
# Rodando com docker
Execute o comando <br />
`docker compose up -d` <br />
depois rode as migrations<br />
`docker exec app php artisan migrate --force` <br />
OBS: --force é para rodar mesmo se env tiver para produção

Depois acesse a url **http://localhost** e pronto você já tem acesso ao sistema

# Rodando local
Execute as migrations `php artisan migrate`<br />
Depois  rode o serve em Laravel `php artisan serve` <br />
e por fim o vue com vite `npm run dev` ou `npm run build` para produção.<br />

OBS: Se o arquito hot existir na pasta public, ele vai tentar rodar em dev. Então se usar o npm run build exclua esse arquivo. Caminho `public/hot`

# Executando os testes
Depois de configurar o laravel local rode o comando <br />
`php artisan test`
