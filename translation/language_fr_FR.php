<?php

// GLOBAL

define('VALIDATE', 'Valider');
define('LOGOUT', 'Déconnecté');
define('NULL', 'Vide');
define('YES', 'Oui');
define('NO', 'Non');
define('MENU', 'Menu');
define('ADMINISTRATOR', 'Administrateur');
define('EDIT', 'Editer');
define('DELETE', 'Supprimer');
define('CANCEL', 'Annuler');
define('ACTION_SUCCESS', 'Action effectué avec succès');
define('INFO_MULTIPLE_SELECT', 'Maintenir CTRL pour selection multiple');
define('RETURN_HOMEPAGE', 'Retourner a la page d\'accueil');
define('ID', 'Id');
define('NEXT', 'Suivant');

// Errors

define('ERROR', 'Erreur');
define('ID_NOT_FOUND', 'ID non trouvé');

// User

define('USERNAME', 'Nom d\'utilisateur');
define('PASSWORD', 'Mot de passe');
define('PASSWORD_BIS', 'Mot de passe bis');
define('ORGANIZATION', 'Entreprise');
define('ROLE', 'Role');
define('LANGUAGE', 'Langue');
define('FIRST_NAME', 'Prénom');
define('LAST_NAME', 'Nom');
define('EMAIL', 'Email');
define('ADDRESS', 'Adresse');
define('ZIPCODE', 'Code postal');
define('CITY', 'Ville');
define('COUNTRY', 'Pays');
define('PHONE', 'Téléphone');
define('MOBILE', 'Portable');
define('COMPANY', 'Companie');
define('JOB', 'Poste');
define('PROFILE', 'Profile');

// User management page

define('USER_CREATION_TITLE', 'Creation utilisateur');
define('USER_LIST_TITLE', 'Liste d\'utilisateur');
define('USER_EDIT_TITLE', 'Edition utilisateur');

define('USER_CREATION_DATABASE_ERROR', 'Creation d\'utilisateur impossible : Ajout impossible en database');
define('EMPTY_USERNAME', 'Nom d\'utilisateur vide');
define('DUPLICATE_USERNAME', 'Nom d\'utilisateur déjà existant');
define('INVALID_USERNAME_TOO_LONG', 'Nom d\'utilisateur trop long');
define('EMPTY_PASSWORD', 'Mot de passe vide');
define('PASSWORD_NOT_MATCH', 'Les mots de passes ne correspondent pas');
define('INVALID_FIRST_NAME_TOO_LONG', 'Prénom trop long');
define('INVALID_LAST_NAME_TOO_LONG', 'Nom trop long');
define('INVALID_ADDRESS_TOO_LONG', 'Adresse trop longue');
define('INVALID_ZIPCODE_TOO_LONG', 'Code postal trop long');
define('INVALID_CITY_TOO_LONG', 'Ville trop long');
define('INVALID_COUNTRY_TOO_LONG', 'Pays trop long');
define('INVALID_PHONE_TOO_LONG', 'Téléphone trop long');
define('INVALID_MOBILE_TOO_LONG', 'Portable trop long');
define('INVALID_COMPANY_TOO_LONG', 'Companie trop long');
define('INVALID_JOB_TOO_LONG', 'Poste trop long');
define('USERS_NOT_FOUND', 'Aucun utilisateurs trouvés');

// Role management page

define('ROLE_LIST_TITLE', 'Liste des roles');
define('ROLE_CREATION_TITLE', 'Création d\'un role');

define('ROLE_LANGUAGE_CREATION_TITLE', 'Ajout de traduction pour role');
define('ROLE_PERMIT_CREATION_TITLE', 'Ajout de permission pour role');
define('DATA', 'Contenu');
define('PERMIT', 'Permission');

define('EMPTY_ROLE', 'Role vide');
define('EMPTY_DATA', 'Contenu vide');
define('INVALID_DATA_TOO_LONG', 'Contenu trop long');

define('NB_PERMIT', 'Nb permission');
define('LANGUAGE_TRANSLATE', 'Traduction');

define('ROLE_EDIT_TITLE', 'Edition de role');

// Sharelist

define('SHARELIST_CREATION_TITLE', 'Création d\'une liste de partage');
define('SHARELIST_MEDIA_CREATION_TITLE', 'Ajout d\'un média pour liste de partage');
define('SHARELIST', 'Liste de partage');
define('REFERENCE', 'Référence');
define('USER', 'Utilisateur');

// Organization

define('NAME', 'Nom');
define('GROUP', 'Groupe d\'entreprise');
define('ORGANIZATION_CREATION_TITLE', 'Création d\'entreprise');
define('EMPTY_REFERENCE', 'Référence vide');
define('INVALID_REFERENCE_TOO_LONG', 'Référence trop long');
define('EMPTY_NAME', 'Nom vide');
define('INVALID_NAME_TOO_LONG', 'Nom trop long');

// Group

define('GROUP_CREATION_TITLE', 'Création d\'un groupe d\'entreprise');
define('GROUP_EDIT_TITLE', 'Edition d\'un groupe d\'entreprise');
define('GROUP_DELETE_TITLE', 'Suppression d\'un groupe d\'entreprise');
define('GROUP_LANGUAGE_CREATION_TITLE', 'Ajout d\'une langue a groupe d\'entretprise');
define('FILESERVER', 'Serveur de fichier');
define('EMPTY_FILESERVER', 'Serveur de fichier vide');
define('INVALID_FILESERVER_TOO_LONG', 'Serveur de fichier trop long');
define('DUPLICATE_REFERENCE', 'Référence déja existante');

define('NB_ORGANIZATION', 'Nb Entreprise');
define('NB_LANGUAGE', 'Nb Langage');
define('GROUP_LIST_TITLE', 'Liste des groupes');

// Language

define('LANGUAGE_CREATION_TITLE', 'Création d\'un langage');
define('CODE', 'Code');
define('EMPTY_CODE', 'Code vide');
define('INVALID_CODE_TOO_LONG', 'Code trop long');
define('LANGUAGE_LIST_TITLE', 'Liste des langages');
define('LANGUAGE_EDIT_TITLE', 'Editer un langage');

// Tag

define('TAG', 'Tag');
define('TAG_CREATION_TITLE', 'Création d\'un tag');
define('TAG_LANGUAGE_CREATION_TITLE', 'Ajout d\'une langue a tag');

// Cart

define('CART_CREATION_TITLE', 'Création d\'un panier');

// Chapter

define('CHAPTER_CREATION_TITLE', 'Création d\'un chapitre');
define('CHAPTER_LANGUAGE_CREATION_TITLE', 'Ajout d\'un language au chapitre');
define('CHAPTER', 'Chapitre');
define('TC_IN', 'Tc in');
define('TC_OUT', 'Tc out');

// Maillist

define('EMPTY_EMAIL', 'Email vide');
define('INVALID_EMAIL_TOO_LONG', 'Email trop long');
define('MAILLIST_CREATION_TITLE', 'Création de maillist');

// Folder

define('FOLDER', 'Dossier');
define('PARENT_FOLDER', 'Dossier parent');
define('FOLDER_CREATION_TITLE', 'Création d\'un dossier');
define('FOLDER_LANGUAGE_CREATION_TITLE', 'Ajout d\'une langue a dossier');
define('FOLDER_MEDIA_CREATION_TITLE', 'Ajout d\'un media a dossier');
define('PARENT_FOLDER_EMPTY', 'Dossier parent non selectionné');
define('INFO_MOVE_DIRECTORY', 'Laisser vide si aucun déplacement');
define('INVALID_PARENT_ID', 'Dossier parent invalide');
define('FOLDER_PARENT', 'Dossier parent');
define('FOLDER_LIST_TITLE', 'Liste des dossiers');

// Media

define('INVALID_EPISODE_NUMBER_TOO_LONG', 'Numéro episode trop long');
define('INVALID_IMAGE_VERSION_DATA_TOO_LONG', 'Version d\'image trop long');
define('INVALID_SOUND_VERSION_DATA_TOO_LONG', 'Version de son trop long');
define('MEDIA_INFO_CREATION_TITLE', 'Ajout d\'info a un media');

define('TITLE', 'Titre');
define('SUBTITLE', 'Sous Titre');
define('DESCRIPTION', 'Description');
define('EPISODE_NUMBER', 'N° episode');
define('IMAGE_VERSION', 'Version d\'image');
define('SOUND_VERSION', 'Version du son');
define('HANDOVER_DATE', 'Date de prise en charge');

define('MEDIA', 'Média');
define('MEDIA_PARENT', 'Parent');
define('MEDIA_TYPE', 'Type du média');
define('MEDIA_TYPE_PROGRAMME', 'Programme');
define('MEDIA_TYPE_CONTENT', 'Contenu');
define('MEDIA_TYPE_ESSENCE', 'Essence');
define('MEDIA_REFERENCE', 'Référence');
define('MEDIA_RIGHT_VIEW', 'Droit de lecture');
define('MEDIA_RIGHT_DOWNLOAD', 'Droit de téléchargement');
define('MEDIA_CREATION_TITLE', 'Ajout d\'un media');

define('MEDIA_EXTRA_FIELD_CREATION_TITLE', 'create media_extra_field');
define('MEDIA_EXTRA_FIELD', 'media_extra_field');
define('TYPE', 'Type');
define('ELEMENT', 'Element');
define('EMPTY_ELEMENT', 'Element vide');
define('INVALID_ELEMENT_TOO_LONG', 'Element trop long');
define('MEDIA_EXTRA_ARRAY_CREATION_TITLE', 'create media_info_array');

define('MEDIA_EXTRA_CREATION_TITLE', 'create media_extra');
define('MEDIA_INFO', 'media_info');
define('MEDIA_EXTRA_ARRAY', 'media_extra_array');

define('EMPTY_TYPE', 'Type vide');
define('INVALID_TYPE_TOO_LONG', 'Type trop long');
define('MEDIA_TYPE_CREATION_TITLE', 'media_type_creation_title');

define('MEDIA_TYPE_FIELD_CREATION_TITLE', 'media_type_field_creation_title');
define('FIELD', 'Champ');

define('SEARCH', 'Recherche');
define('CONTENT', 'Contenu');

define('ORGANIZATION_LIST_TITLE', 'Liste des organizations');
define('ORGANIZATION_EDIT_TITLE', 'Modification d\'organizations');

define('MAIL_LIST_TITLE', 'Liste des mails');
define('MAIL_CREATION_TITLE', 'Ajouter un email');
define('MAIL_EDIT_TITLE', 'Modifier un email');

define('REFERENCE_CLIENT', 'Référence Client');
define('RIGHT_VIEW', 'Droit de visionnage');
define('MEDIA_FILE', 'Fichier du média');
define('RIGHT_DOWNLOAD', 'Droit de téléchargement');
define('RIGHT_ADDTOCART', 'Droit de commande');
define('FILENAME', 'Nom du fichier');
define('FILEPATH', 'Chemin du fichier');

define('EMPTY_FILENAME', 'Nom de fichier vide');
define('INVALID_FILENAME_TOO_LONG', 'Nom de fichier trop long');
define('EMPTY_FILEPATH', 'Chemin de fichier vide');
define('INVALID_FILEPATH_TOO_LONG', 'Chemin de fichier trop long');

define('TEXT', 'Texte');
define('DATE', 'Date');
define('ARRAY_MUTIPLE', 'Table choix multiple');
define('ARRAY_UNIQUE', 'Table choix unique');
define('T_BOOLEAN', 'Case à coché');
define('MEDIA_EXTRA_FIELD_LIST_TITLE', 'Champs');
define('INVALID_TRANSLATE_TOO_LONG', 'La traduction est trop long');
define('BAD_CHOICE', 'Tentative de modifier les valeurs importants');
define('CREATE_MEDIA_PROGRAM', 'Créer un programme');
define('EDIT_MEDIA_PROGRAM', 'Editer un programme');
define('PROGRAM_LIST_TITLE', 'Liste des programmes');
define('PROGRAM', 'Programme');
define('CREATE_MEDIA_CONTENT', 'Créer un Contenu');
define('EDIT_MEDIA_CONTENT', 'Editer un Contenu');
define('CONTENT_LIST_TITLE', 'Liste des Contenus');
define('LINK_MEDIA_PROGRAM', 'Lier a un programme');
define('LINK_MEDIA_CONTENT', 'Lier a un contenu');

define('EMPTY_MEDIA_REFERENCE', 'Référence vide');
define('INVALID_MEDIA_REFERENCE_TOO_LONG', 'Reference trop longue');
define('MANDATORY', 'Obligatoire');

// Media FIle

define('MEDIA_FILE_UPLOAD_TITLE', 'Upload de média');