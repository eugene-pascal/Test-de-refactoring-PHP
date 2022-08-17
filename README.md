# Test de refactoring PHP 2022

Ce repository est un extract de Unisciences (Un), une application publique de consultation d'information de la section de Unisciences de l'Université de Lausanne.

https://applicationspub.unil.ch/interpub/noauth/php/Un/UnIndex.php?LanCode=37

Cette demo de l'application marche sur une seule page PHP (UnIndex.php). Les appels à d'autres pages ont été enlevés.

Le fichier utilise certaines librairies qui se trouvent dans d'autres répertoires (Sy,Bo).

:warning: **Important**: S'il vous plaît, ne faites pas de fork de ce repository et ne publiez pas votre solution à ce défi ou que ce soit. Si vous lisez ceci, cela signifie que vous avez été contacté personnellement par un membre de l'équipe LEGACY avec des instructions sur la façon de soumettre votre solution.

### Tâches

Votre tâche consiste à faire du refactoring de cette application.

Les points principaux à prendre en compte :

- Factoriser ce qui est factorisable.
- Enlever le code inutile. Attention aux modifications qui pourraient déborder sur d'autres pages.
- Utiliser les classes disponibles là où c'est possible. Si besoin, créer d'autres classes ou ajouter des méthodes aux classes existantes.
- Uniformiser le plus possible le code.
- Le cache APC n'est plus utilisé, enlever toute référence et utilisation.
- Essayer le plus possible de séparer la logique de l'affichage.
- Une modification récente a cassé l'affichage des personnes, corriger l'erreur.

### Informations

- La classe qui gère les requêtes SQL (SySQLStmt) a été modifié pour simuler une connection à la base de données en utilisant des fichiers JSON, **ne pas la modifier**.
- Ne pas modifier ce qui est marqué comme *** SIMULATED SQL QUERY ***
- Vous pouvez ignorer les dossiers : 
  - Un/css
  - Un/data
  - Un/fonts
  - Un/images


## Lancer l'application

Depuis la base du repository, accédez à Un.

    cd Un

Lancez un serveur PHP.

    php -S localhost:8888

Accédez à l'application sur:  http://localhost:8888/UnIndex.php

---

Nous vous remercions de vos commentaires et de l'intérêt que vous portez à notre institution. 

Bonne chance.

