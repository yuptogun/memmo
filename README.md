# memmo

y u no memo ???

## overview

actually it has started as [a humble side project of my personal website](https://memmo.yuptogun.com).

> there's even [a full walkthrough](https://bit.ly/3UIEwe4) of how it was originally built -- give it a read if you speak Korean.

## how to contribute

### dev env setup

Sail it dude

```sh
cp -n .env.example .env
docker run --rm -v "$(pwd):/app" -w /app composer install
./vendor/bin/sail up -d

./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate

./vendor/bin/sail npm i
./vendor/bin/sail npm run dev
```