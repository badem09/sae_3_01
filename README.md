# SAÉ (Situation d'Apprentissage et d'Évaluation) - Semestre 3 : Site web de simulation

# Intro

Ce projet à été réalisé en groupe dans le cadre de mes études en BUT Informatique.
Il consiste à implémenter concevoir, réaliser et développer un site web permettant à utilisateurs connectés d'accéder à 3 modules :
	
	- Un module de Probabilité : Ce module permet de calculer et de visualiser la probabilité P(x<t)  dans le cadre d'une loi normale (voir */doc/L3/Rapport_Module_Probabilité.md*).
	
	- Un module de Cryptographie : Ce module permet de chiffer et déchiffrer une texte (clé publique) selon une clé (privée) avec les technologies RC4 ou WEP (*voir /doc/L4/rapportModule2.md*).
	
	- Un module de Machine Learning : Ce module permet de charger les derniers articles publiés (scrapping) sur le site <a href =https://www.ft.com/> Financial Times </a> et de prédire le sentiment général qui leur est associé avec une modèle *sklearn* déjà entrainé (voir */src/python_module3/Modèle_ML.ipynb* pour plus de détails). 

Pour plus de détails sur le projets (recueil de besoin / cahier de charges), veuillez consulter le dossier */doc*.

Le projet possède également une version application mobile. Vous pourrez retrouver le code dans la branche *android*.

# Installation et mise en place

Pour mettre en place le site web, il faudra configurer votre serveur local. Vous pouvez utiliser le logiciel XAMPP. Control Panel. 
N'oubliez pas de configurer la base de données avec le script *bd.sql*.
