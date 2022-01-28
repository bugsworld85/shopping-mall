# Shopping Mall Test Code

## Warning:

- I did not fix the Register user endpoint.

## Requirements

### API

- Docker

### Client

- Node 16.x
- NPM 8.x

## Running in localhost

```shell
git clone git@github.com:bugsworld85/shopping-mall.git
cd shopping-mall
# backend API. Make sure you are actually inside the docker container when doing the backend.
cd api
composer up
sail up # localhost:9000
# on another terminal, still connected to the same docker container
sail artisan migrate
sail artisan db:seed
sail artisan db:seed --class=TestDatabaseSeeder
sail artisan create:user # in case you need to create your own user with specific roles.
sail artisan db:seed --class=ShopVisitSeeder # in case you want to add more visits into shops.

# frontend
cd ../client # given you are still inside `api`
npm install
npm run dev
```