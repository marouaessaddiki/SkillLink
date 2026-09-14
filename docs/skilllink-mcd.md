# MCD SkillLink

Le MCD fourni pour SkillLink contient `USER`, `OFFER`, `MISSION`, `CATEGORY`, `REVIEW` et `NOTIFICATION`. Il correspond au cahier des charges.

Dans l'implementation Laravel existante, `OFFER` est represente par le modele et la table `Application/applications` pour conserver les routes et le code metier deja en place. Les equivalences sont:

- `OFFER.message` -> `applications.cover_letter`
- `OFFER.price` -> `applications.proposed_price`
- `OFFER.date_submission` -> `applications.date_submission`
- `OFFER.status` -> `applications.status`

## Entites

- **USER**: utilisateur de la plateforme, client, freelance ou administrateur.
- **ROLE**: role Laratrust attribue a un utilisateur.
- **CATEGORY**: categorie d'une mission.
- **MISSION**: besoin publie par un client.
- **OFFER**: offre envoyee par un freelance pour une mission. Elle est implementee par `Application`.
- **REVIEW**: evaluation d'un utilisateur apres une mission terminee.
- **NOTIFICATION**: notification envoyee a un utilisateur.

## Relations

```mermaid
erDiagram
    USER }o--o{ ROLE : has
    USER ||--o{ MISSION : publishes
    CATEGORY ||--o{ MISSION : classifies
    MISSION ||--o{ OFFER : receives
    USER ||--o{ OFFER : submits
    MISSION ||--o{ REVIEW : has
    USER ||--o{ REVIEW : writes
    USER ||--o{ REVIEW : receives
    USER ||--o{ NOTIFICATION : receives

    USER {
        bigint id PK
        string name
        string email
        string password
    }
    ROLE {
        bigint id PK
        string name UK
        string display_name
    }
    CATEGORY {
        bigint id PK
        string name UK
        text description
    }
    MISSION {
        bigint id PK
        bigint client_id FK
        bigint category_id FK
        string title
        text description
        decimal budget
        date deadline
        enum status
    }
    OFFER {
        bigint id PK
        bigint mission_id FK
        bigint freelance_id FK
        text message
        decimal price
        datetime date_submission
        enum status
    }
    REVIEW {
        bigint id PK
        bigint mission_id FK
        bigint reviewer_id FK
        bigint reviewee_id FK
        tinyint rating
        text comment
    }
    NOTIFICATION {
        uuid id PK
        string notifiable_type
        bigint notifiable_id
        json data
        datetime read_at
    }
```

## Regles metier

- Un client publie ses propres missions.
- Une mission appartient a une categorie et possede le statut `open`, `in_progress`, `completed` ou `cancelled`.
- Un freelance ne peut envoyer qu'une seule application par mission ouverte.
- L'acceptation d'une application passe la mission a `in_progress` et rejette les autres applications en attente.
- Seul le freelance affecte peut terminer une mission.
- Les reviews sont possibles apres completion et sont uniques par mission et reviewer.
