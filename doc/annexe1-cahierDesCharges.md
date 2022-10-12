**Cahier des charges![](Aspose.Words.65e3b41c-dc33-43a4-a07c-1c3eea5e1712.001.png)**

**Introduction et présentation du document.**

Ce document contractualise le logiciel, il contient les souhaits du client et pourra être modifié pour reformuler les besoins si nécessaire. Le cahier des charges a pour objectif de décrire les attentes du client afin de permettre au prestataire d’avoir une vision du travail à réaliser ainsi que l’ensemble des collaborateurs du projet.

Celui-ci est réparti tel que:

- **L'énoncé**, contenant une description détaillée du problème, les objectifs fixés avec le client, ou encore le contexte du projet.
- **Les pré-requis** sont les connaissances et compétences requises pour mener à bien le projet, en d’autres termes, les ressources matérielles et logicielles (langage de programmation par exemple).
- **Les priorités** sont l’ensemble des tâches à effectuer en priorité, elles ont été fixées avec le client en amont.

**L’Enoncé**

L’énoncé est une description détaillée du problème à résoudre, le contexte et les objectifs du projet. Il définit le contexte de la solution, le problème, son ou ses objectifs finaux.

- **Contexte** : Le client, Mr Fabrice Hoguin, représentant du groupe pédagogique des 2e année de BUT Informatique à l’IUT de Vélizy, ainsi que l’ensemble du groupe pédagogique, sollicitent nos compétences, dans le but de la réalisation d’une application web, dans un délai imparti et cela sous plusieurs exigences fournies dans un document.
- **Problème** : Nous devons réaliser une application web permettant à ses utilisateurs, le calcul et la conversion de données entrées par celui-ci.

L’application repose sur un serveur web *nginx* ou *apache* supportée par un *Rasperry pi*

*4*. Elle sera codée en *PHP* et possédera une base de données gérée par un *SGDB*. L’application devra avoir sa propre base de données sous Oracle sql.

Du côté simulation, le système permettra à un utilisateur inscrit, de lancer des simulations dans différents domaines. Il faudra mettre les résultats à disposition de l’utilisateur en les affichant sur la page.

D'autre part, concernant la gestion des utilisateurs, un visiteur pourra s’inscrire après vérification d’un *“captcha”* et ainsi accéder aux différents simulateurs. Il faudra également garder une trace des connexions à notre plateforme, ainsi que des échecs de connexions.

- **Objectifs**:

Créer un site web permettant la connexion, l’inscription et l’administration de celui-ci, pouvant proposer des outils divers uniquement aux utilisateurs inscrits.

Ce site devra contenir une page d’accueil, avec un logo, ainsi que les 3 modules expliqués ci-dessus.

Tout d’abord, lors de la première connexion, l’utilisateur doit pouvoir créer un compte. Pour cela, il doit pouvoir entrer des informations personnelles, ainsi qu’un mot de passe personnaliser et compléter un *“captcha”*. Dans le cas où le mot de passe est égaré, la possibilité de le récupérer sera impossible, une redirection sera disponible vers une page *“erreur 404”*, soit une page introuvable. L’utilisateur devra avoir accès aux différents modules de la page et pouvoir modifier son mot de passe, une fois connecté. Sans procéder à cette connexion, l’utilisateur ne pourra que visionner la page d'accueil du site, de connexion et d’inscription.

Le gestionnaire, étant l’unique administrateur de ce site, devra gérer l'intégralité des utilisateurs inscrits. Il pourra donc consulter la liste des utilisateurs, les données mentionnées dans la partie utilisateur (le mot de passe ne sera pas visible), l’historique de l’utilisation des modules par utilisateurs, ainsi que des données statistiques sur leur utilisation (les plus utilisées).

Enfin, lors d’une connexion échouée, un fichier *“log“* contenant le *“login”*, le mot de passe tenté, la date, ainsi que l’adresse ip de l'utilisateur devra être mis à jour. Ce fichier sera accessible uniquement par le gestionnaire.

**Les Pré-requis.**

Les pré-requis sont l’ensemble des connaissances requises, ressources matérielles et logicielles, des compétences nécessaires au développement d’un projet.

Dans un premier temps, les connaissances requises pour ce projet passent par la maîtrise des différents langages informatiques, tels que *PHP, HTML, CSS* et *SQL*. Ces langages seront indispensables dans la réalisation de ce projet, car l’application dépendra de la connaissances et des compétences de ces langages.

La maîtrise de gestionnaire de version tel que *Git* seront aussi importantes pour le déroulement de ce projet, afin de pouvoir garder un historique du travail réalisé, ainsi que de favoriser le travail collaboratif.

D’autre part, concernant les ressources matérielles, l’application web sera portée par un *RPi 4* dont la sécurité devra être optimale, empêchant les personnes ne possédant pas les droits ou autorisations, de s’introduire sur le serveur. De plus, un serveur web de type *Apache* ou *nginx*, ainsi qu’un serveur *SGBD Mysql* devront être installés.

**Les priorités.**

Dans cette partie du document, seras indiqué les priorités éventuelles du développement, fixées avec l’accord du client.

Pour l’instant, nous n’avons pas échangé sur les éventuelles priorités du projet avec le client.

**Version minimale du site web (V0.1):**

Dans cette version minimale nous avons 2 pages intitulées index.html et 404.html qui sont reliées entre elles.

La page d'accueil comportant, une entête (barre de navigation) contenant à son extrême gauche un logo et à sa droite 3 boutons, “Accueil”, “Nos services”, “Se connecter”.

- Le bouton "**Accueil**" permet de retourner à la page d’accueil du site et ce, depuis n’importe quel onglet du site. Sur cette page d'accueil, vous pouvez retrouver toutes les informations concernant les différents modules disponibles en bref.
- Le menu déroulant “**Nos Services**”, en entête, permet de sélectionner un des modules que notre site propose. Le bouton “en construction” renvoie sur la page “404.html”.
- Le bouton “**Se connecter**” renvoie également vers la page “404.html” .

En haut de page une image avec un slogan et le nom du site est affichée.

Au centre de cette page, une présentation des modules brève, une image par module, et des boutons “Y aller” qui amènent vers la page “404.html”

Enfin, un bas de page (footer), global, pour chaque page du site web.
