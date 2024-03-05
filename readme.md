#  Install

## Installation du projet

```cmd
git clone https://gitlab.com/dwwm_pe2_clermont/examenangular
 cd examangular
 composer install
```


## Création de mes clefs
```cmd
php bin/console lexik:jwt:generate-keypair
```

## Création de la base de données
1) Modifier les variables d'environnements dans le fichier .env
2) Création de la base de donnée 
```cmd
php bin/console doctrine:database:create
php bin/console make:migration
php bin/console d:m:m 
```
## Chargement des fixtures
```cmd
php bin/console d:f:l
```
## Utilisation

```cmd
symfony serve
```

## Documentation

https://localhost:8000/api/docs