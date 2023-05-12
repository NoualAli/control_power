<p align="center"><img src="https://github.com/NoualAli/power_control/blob/master/public/app/images/brand.png" width="256"></p>
<p align="center">
    <img src="https://img.shields.io/badge/version-1.0-%125741"/>
</p>

## Sommaire
<ul>
    <li><a href="./README.md#prérequis">Prérequis</a></li>
    <li><a href="./README.md#installation-des-drivers-mssql-server-pour-php">Installation des drivers MSSQL Server pour PHP</a></li>
    <li><a href="./README.md#installation-de-lapplication">Installation de l'application</a></li>
    <ul>
        <li><a href="./README.md#clonage-du-repo">Clonage du repo</a></li>
        <li><a href="./README.md#installation-des-dépendences-laravel">Installation des dépendences laravel</a></li>
        <li><a href="./README.md#installtion-et-compilation-des-dépendences-javascript-et-css">Installtion et compilation des dépendences javascript et css</a></li>
        <li><a href="./README.md#migration-des-tables-de-la-base-de-données">Migration des tables de la base de données</a></li>
        <li><a href="./README.md#lancement-du-serveur-interne-de-php">Lancement du serveur interne de php</a></li>
    </ul>
    <li><a href="./README.md#modifier-le-fichier-phpini">Modifier le fichier php.ini</a></li>
    <ul>
        <li><a href="./README.md#activer-le-support-de-microsoft-sql-server">Activer le support de Microsoft SQL Server</a></li>
        <li><a href="./README.md#augmenter-la-capacité-de-memory_limit-et-max_execution_time">Augmenter la capacité de memory_limit et max_execution_time</a></li>
    </ul>
</ul>

## Prérequis
- PHP >= ^8.1
- NodeJs >= ^18.15
- Microsoft SQLServer 2019

## Installation des drivers MSSQL Server pour PHP
<a href="https://go.microsoft.com/fwlink/?linkid=2226724" target="_blank">Télécharger les drivers depuis microsoft</a>
<p>
    Vous trouverez dans ce dossier les deux drivers <b>SQLSRV</b> et <b>PDO_SQLSRV</b> pour les différentes versions de php, les différentes architéctures système (64 bits, et 32 bits). <br/>
    Pour chaque driver vous allez trouver une version Thread Safe (ts) et une version Non-Thread Safe (NTS), veillez à bien choisir la version qui sera compatible avec votre installation PHP <br/>
    Renommez vos fichiers comme suit:
</p>
<ul>
    <li>php_pdo_sqlsrv_8x_*.dll -> php_pdo_sqlsrv.dll</li>
    <li>php_sqlsrv_8x_*.dll -> php_sqlsrv.dll</li>
</ul>

<p>
    Puis placez les dans le dossier <b>C:\< path_to_php_installation >\ext</b>
</p>

    
## Modifier le fichier php.ini
    
#### Activer le support de Microsoft SQL Server
    
<ul>
    <li>extension=pdo_sqlsrv</li>
    <li>extension=sqlsrv</li>
</ul>

#### Augmenter la capacité de memory_limit et max_execution_time

<ul>
    <li>memory_limit = 512M</li>
    <li>max_execution_time = 120</li>
</ul>

**Augmenter la capacité de ces deux clé vous éviteras tout problème avec la génération des rapports de mission**
    
## Installation de l'application

#### Clonage du repo
```batch
git clone https://github.com/NoualAli/power_control
```

#### Installation des dépendences laravel
```batch
composer install
```

#### Installtion et compilation des dépendences javascript et css
- **Mode développement**
```batch
npm install | npm run dev
```
- **Mode production**
```batch
npm install | npm run build
```

#### Migration des tables de la base de données
```batch
php artisan migrate
```
**Note: la documentation assume que vous avez déjà une base de données créée et fonctionnelle**

#### Lancement du serveur interne de php
```batch
php artisan serve
```
**Uniquement en mode développement**
