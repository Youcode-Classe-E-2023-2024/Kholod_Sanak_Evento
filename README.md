# Evento - Plateforme de Gestion et Réservation d'Événements

La société "Evento" ambitionne de développer une plateforme novatrice dédiée à la gestion et à la réservation des places d'événements. L'objectif est de fournir une expérience utilisateur optimale aux participants, organisateurs et administrateurs. Cette plateforme permettra aux utilisateurs de découvrir, réserver et générer des tickets pour une variété d'événements, tandis que les organisateurs auront la possibilité de créer et de gérer leurs propres événements.

## Fonctionnalités

### Utilisateur

- **Inscription :** Les utilisateurs peuvent s'inscrire sur la plateforme en fournissant leur nom, leur adresse e-mail et un mot de passe.
- **Connexion :** Les utilisateurs peuvent se connecter à leur compte en utilisant leurs identifiants.
- **Réinitialisation de mot de passe :** En cas d'oubli, les utilisateurs peuvent réinitialiser leur mot de passe en recevant un e-mail de réinitialisation.
- **Exploration d'événements :** Les utilisateurs peuvent consulter la liste des événements disponibles sur la plateforme avec pagination pour faciliter la navigation.
- **Filtrage par catégorie :** Les utilisateurs peuvent filtrer les événements par catégorie.
- **Recherche :** Les utilisateurs peuvent rechercher des événements par titre.
- **Consultation des détails d'événements :** Les utilisateurs peuvent visualiser les détails d'un événement, y compris sa description, sa date, son lieu et le nombre de places disponibles.
- **Réservation :** Les utilisateurs peuvent réserver une place pour un événement.
- **Génération de ticket :** Une fois la réservation confirmée, les utilisateurs peuvent générer un ticket.
- **Connexion via Google :** Les utilisateurs peuvent se connecter à leur compte en utilisant leur compte Google.
- **Réception de ticket par e-mail :** Les utilisateurs reçoivent un e-mail contenant le ticket une fois leur réservation confirmée.
- **Génération de ticket au format PDF :** Les utilisateurs peuvent générer leur ticket au format PDF une fois leur réservation confirmée.

### Organisateur

- **Création d'événements :** Les organisateurs peuvent créer de nouveaux événements en spécifiant leur titre, leur description, leur date, leur lieu, leur catégorie et le nombre de places disponibles.
- **Gestion d'événements :** Les organisateurs peuvent gérer leurs événements existants.
- **Accès aux statistiques :** Les organisateurs ont accès à des statistiques sur les réservations de leurs événements.
- **Acceptation automatique ou validation manuelle :** Les organisateurs peuvent choisir entre une acceptation automatique des réservations ou une validation manuelle.

### Administrateur

- **Gestion des utilisateurs :** Les administrateurs peuvent gérer les utilisateurs en restreignant leur accès.
- **Gestion des catégories d'événements :** Les administrateurs peuvent ajouter, modifier ou supprimer des catégories d'événements.
- **Validation des événements :** Les administrateurs peuvent valider les événements créés par les organisateurs avant leur publication sur la plateforme.
- **Accès aux statistiques :** Les administrateurs ont accès à des statistiques globales sur l'utilisation de la plateforme.

## Installation

1. Clonez ce dépôt sur votre machine locale.
2. Assurez-vous que PHP et Composer sont installés sur votre machine.
3. Copiez le fichier .env.example et renommez-le en .env.
4. Configurez votre base de données dans le fichier .env.
5. Exécutez `composer install` pour installer les dépendances PHP.
6. Exécutez `php artisan key:generate` pour générer une nouvelle clé d'application.
7. Exécutez `php artisan migrate` pour exécuter les migrations et créer les tables de base de données.
8. Exécutez `php artisan serve` pour démarrer le serveur de développement.

## Contribution

Les contributions sont les bienvenues ! Pour des suggestions, des corrections de bugs ou des fonctionnalités supplémentaires, veuillez ouvrir une nouvelle issue ou une pull request.

## Licence

Ce projet est sous licence MIT. Voir le fichier LICENSE pour plus de détails.
