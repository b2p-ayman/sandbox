# Change log

## Version M.m.f (2021-07-31)

### Features

* 461 - titre de l'issue 461
* 168 - titre de l'issue 168

### Fixes

* 464 - titre de l'issue 464
* Fix de la #456 pour l'accès aux images des utilisateurs anonymes

### Configuration

* migrations Doctrine :
    * Version20210324152048 : Migration concernant la #168. Ajout d'une relation professional_type_id dans plusieurs tables.

* config/packages/parameters.yml.dist :
    * Modification du paramètre `patient_external_source` :
        * Ajout du sous paramètre `groups_codes` qui représente la table de correspondance de nos groupe de niveau 1 avec la source externe de patients

### Miscellaneous

* 460 - Augmentation de la taille maximum d'upload de fichier (1Mo->20Mo)
* 487 - Retour du nom de l'activité suite à la création d'une prescription

