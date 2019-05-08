# frontfoodfun
Front office du restaurant food fun

Développé en symfony

1.Prérequis:
  -Php 7 mininum
  -Composer
  -Mysql
  -Apache

2.Installation locale
  -Télécharger les fichier sources
  -Copier vers un serveur WAMP
  -Changer l'environnement en mod dev: ouvrir le fichier .env et  APP_ENV=dev
  -Activez le mode_rewrite,http_proxy d'apache
  -Ouvrir le fichier .htaccess dans public et décommentez les lignes 59 à 73
  -Installez un virtualhost pour le nouveau site pour apache (pour faire marcher l'url rewriting en local)
  

3.Importer la base de données et modifier DATABASE_URL dans le fichier .env
