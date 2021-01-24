# Mon concessionnaire avec Laravel

## Installation du projet

```bash
# Clone du projet
git clone https://github.com/william-suppo/garage-laravel.git
```

## Installation de composer

```bash
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === '756890a4488ce9024fc62c56153228907f1545c228516cbf63f885e036d37e9a59d27d63f46af1d4d07ee0f76181c7d3') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
```

## Commandes utiles

```bash
# Mettre à jour les dépendances
php composer.phar update
# Utiliser La commande artisan
php artisan
# Lancer les tests
./vendor/bin/phpunit
```

## Et docker ?

Je vous invite à suivre l'installation de [Sail](https://laravel.com/docs/8.x/sail#introduction) !

## Synopsis

> Une marque est définie par un nom et elle peut disposé du statut premium.

>Un véhicule est défini par un nom, un prix, un status (dispo, bloqué ou réservé), un compteur kilométrique et un type (moto, auto, utilitaire, luxe, etc).
Il appartient à une marque.

> Un utilisateur est défini par un nom, un mot de passe, un email, un porte-monnaie, un score et un rôle.
Il peut louer des véhicules sur une plage de temps données.

:mega: Here we go :mega:
