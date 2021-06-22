# Pallabot (Discord Bot)
Bienvenue sur le repository de Pallabot, le bot discord de la communauté Palladium-Corporation !

Pour plus d'informations, visitez [Kraland Interactif](http://www.kraland.org/).

## Utilisation
- Cloner ce repository
- Installer les dépendances avec `composer install`
- Mettre le token de votre bot discord dans `.env`
- Lancer le bot avec la commande suivante `php palladium bot:start`

## Commandes disponibles
- `!help` : affiche une aide sur les commandes disponibles
- `!action` : affiche le nombre d'actions de la Palladium Corporation en circulation

## Ajouter des commandes au bot
Pour que le bot puisse réagir aux différentes commandes sur votre discord, vous devez créer des classes _invokables_
dans le namespace `App\DiscordCommands`.

Puis les enregistrer dans `App\Commands\DiscordCommand` dans la méthode `getCommands`.

La configuration doit respecter certains paramètres c'est pourquoi il faut créer un nouvel
objet `CommandEntity` et l'ajouter à l'array de retour de cette méthode.

Vous pouvez prendre exemple sur ce qui est déjà en place et l'améliorer comme bon vous semble.
