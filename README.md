<p align="center"><img src="https://github.com/NoualAli/power_control/blob/master/public/images/brand.png" width="256"></p>
<p align="center">
    <img src="https://img.shields.io/badge/version-1.0-%125741"/>
</p>

## Prérequis
- git >= 2.0
- composer >= 2.0
- php >= 8.1
- npm >= 8.19

## Installation

Clonage du repo
```bash
git clone https://github.com/NoualAli/power_control
```
Installation des dépendences laravel
```bash
composer install
```

Installtion et compilation des dépendences javascript et css
```bash
npm install && npm run dev
```

Migration des tables de la base de données + peuplement <br/>
```bash
php artisan migrate --seed
```
**Note: la documentation assume que vous avez déjà une base de données créée et fonctionnelle**

Lancement du serveur interne de php / laravel
```bash
php artisan serve
```
