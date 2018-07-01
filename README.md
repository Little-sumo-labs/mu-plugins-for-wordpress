MU-PLUGINS pour Wordpress
=============
Un MU Plugin ou Must-Use Plugin, est un plugin qui  “doit être utilisé“ (d'ou le "Must-Use")

En simplifiant, on peut résumer cela en “un plugin à utiliser avant tous les autres“.

Très souvent, les MU plugins se composent d’un seul fichier PHP dans lequel vous ajoutez du code

Ils sont placés dans un répertoire spécifique, nommé "mu-plugins", que vous devrez créer dans le dossier "wp-content".


## Compatibilité
Ces petites fonctionnalités sont compatible avec les dernières versions de Wordpress, y compris la plus récente (Wordpress 4.9.6)

## Installation
Comme il est dit dans l'introduction, pour installer ces fichiers, il faut créer le dossier "mu-plugins" dans "wp-content", à côté de "plugins" & "themes".

A partir de là, ces mu-plugins sont visible dans l'administration de Wordpress, dans la partie extensions.

Une nouvelle sous-partie apparaît, sous le terme "Indispensables" (ou mustuse)


## A prendre en compte
Certaines de ces modifications peuvent être utilisé en l'état. D'autres devront être modifier, selon les besoins.

A utiliser directement, votre installation WP ne risque rien.

N'hésitez pas à me poser des questions, si vous en avez.


## Listes des mu-plugins
### wp-add-buttons-tinyMCE.php
Ajoute de nouveaux boutons dans l'éditeur tinyMCE.
[Must Use Plugins](https://www.wpexplorer.com/wordpress-tinymce-tweaks/)

### wp-change-credit-footer.php
Supprime les crédits de base du footer, et ajoute d'autres crédits.

### wp-change-widget-dashboard.php
Pour les utilisateurs autre que l'administrateur, supprime les widgets du tableau de bord, et ajoute de nouveaux widgets 

### wp-delete-page-menu.php
Suppression de page du menu d'administration de WP

### wp-delete-version.php
Supprime le numéro de version de Wordpress, pour une question de sécurité.

### wp-disable-update.php
7 façons de désactiver les notifications de mise à jour et les correctifs de maintenance dans WordPress.
Pour les utilisateurs autre que l'administrateur.

### wp-help-tabs.php
Supprime les onglets d'aide, pour les utilisateurs non-administrateurs

### wp-hide-admin-bar.php
Masque la barre d'administration (fonctionne depuis WordPress 3.1, jusqu'à la dernière version).

### wp-login-page.php
Liste des modifications effectué sur la page de Login :
- La case "Remember Me" est toujours coché
- Les messages d'erreurs de connexion seront toujours les mêmes

### wp-remove-columns.php
Suppression de colonnes (donc la colonnes de médias) dans la list view

### wp-remove-metaboxes.php
Suppression des Metabox inutiles dans les Posts

## Liens utiles
* [Must Use Plugins](https://codex.wordpress.org/Must_Use_Plugins)
* [A collection of functions to clean up WordPress](https://github.com/vincentorback/clean-wordpress-admin)
* [Personnaliser le Back Office de WordPress - WPTech](https://www.youtube.com/watch?v=RSQUQauXCbk)

Contributing
------------
See [Contributing](CONTRIBUTING.md).