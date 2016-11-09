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
define('ACTION_SUCCESS', 'Action effectuée avec succès');
define('INFO_MULTIPLE_SELECT', 'Maintenir CTRL pour selection multiple');
define('RETURN_HOMEPAGE', 'Retourner a la page d\'accueil');
define('ID', 'Id');
define('NEXT', 'Suivant');
define('HOME', 'Page d\'accueil');
define('ORDER_DATE', 'Date de commande');

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
define('PROFILE', 'Profil');

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
define('USERS', 'Utilisateurs');

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
define('CHAPTER_LANGUAGE_CREATION_TITLE', 'Ajout d\'un langage au chapitre');
define('CHAPTER', 'Chapitre');
define('TC_IN', 'Tc in');
define('TC_OUT', 'Tc out');

// Maillist

define('EMPTY_EMAIL', 'Email vide');
define('INVALID_EMAIL_TOO_LONG', 'Email trop long');
define('MAILLIST_CREATION_TITLE', 'Création de maillist');

// Folder

define('FOLDER', 'Dossier');
define('PARENT_FOLDER', 'Dossier');
define('FOLDER_CREATION_TITLE', 'Création d\'un dossier');
define('FOLDER_LANGUAGE_CREATION_TITLE', 'Ajout d\'une langue a dossier');
define('FOLDER_MEDIA_CREATION_TITLE', 'Ajout d\'un media a dossier');
define('PARENT_FOLDER_EMPTY', 'Dossier parent non selectionné');
define('INFO_MOVE_DIRECTORY', 'Laisser vide si aucun déplacement');
define('INVALID_PARENT_ID', 'Dossier parent invalide');
define('FOLDER_PARENT', 'Dossier parent');
define('FOLDER_LIST_TITLE', 'Liste des dossiers');
define('FOLDER_EDIT_TITLE', 'Edition d\'un dossier');

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
define('MEDIA_PARENT', 'Programme');
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
define('MEDIA_INFO', 'Informations');
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
define('RIGHT_PREVIEW', 'Droit de Prévisualisation');
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
define('FIELD_NAME', 'Nom du champ');
define('TABLE_VALUE', 'Valeur table');
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

define('DASHBOARD', 'Dashboard');
define('ADMIN_INFORMATION', 'Attention: Toutes modifications doit être verifiées');
define('ROOT', 'Portal Root');

// Media FIle

define('MEDIA_FILE_UPLOAD_TITLE', 'Upload de média');
define('NO_TITLE', 'Sans titre');


define('SEARCH_MENU', 'Recherche');
define('FOLDER_MENU', 'Tous les dossiers');
define('PROGRAM_MENU', 'Tous les programmes');
define('CONTENT_MENU', 'Tous les contenus');

// NEW TRADUCTION <--- TO DELETE AFTER BEING DONE

define('DOWNLOAD', 'Téléchager');
define('ADDTOCART', 'Ajouter au panier');
define('CART', 'Panier');
define('ADDTOSHARELIST', 'Ajouter a la liste de partage');
define('DESIGN', 'Design');

define('LOGIN_PAGE', 'Page de connexion');
define('GENERAL', 'Général');
define('LOGIN_BLOCK', 'Bloc de connexion');
define('BUTTON', 'Bouton');
define('CSS_BACKGROUND_COLOR', 'Couleur de fond');
define('CSS_COLOR', 'Couleur du texte');
define('CSS_BACKGROUND_COLOR_HOVER', 'Couleur de fond dynamique');
define('CSS_COLOR_HOVER', 'Couleur du texte dynamique');
define('CSS_BORDER_COLOR', 'Couleur de bordure');
define('CSS_HEADER_COLOR', 'Couleur texte en-tête');
define('CSS_HEADER_BACKGROUND_COLOR', 'Couleur de fond en-tête');

define('NO_DESCRIPTION_AVAILABLE', 'Aucune description disponible.');
define('ACTION', 'Action');
define('USAGE', 'Usage');
define('SOURCE_FILE', 'Fichier source');
define('WATCHING_FILE', 'Fichier de visionage');
define('CUT_FILE', 'Réalisation d\'une découpe');
define('TRANSCODE', 'Transcodage');
define('TOP_MENU', 'Menu du haut');
define('SIDE_MENU', 'Menu du coté');
define('PROFILE_BUTTON', 'Bouton du profil');
define('LOGOUT_BUTTON', 'Bouton de deconnexion');
define('TOP_MENU_FOLDER_LINK', 'Lien des dossier menu du haut');
define('HOMEPAGE', 'Page principale');
define('FOLDER_SECTION_LINE', 'Separation ligne dossier');
define('FOLDER_TITLE_BLOCK', 'Bloc titre');
define('FOLDER_DESCRIPTION_BLOCK', 'Bloc description');
define('PROGRAM_SECTION_LINE', 'Separation ligne programme');
define('PROGRAM_TITLE_BLOCK', 'Bloc titre');
define('PROGRAM_DESCRIPTION_BLOCK', 'Bloc description');
define('CONTENT_SECTION_LINE', 'Separation ligne contenu');
define('CONTENT_TITLE_BLOCK', 'Bloc titre');
define('CONTENT_DESCRIPTION_BLOCK', 'Bloc description');
define('CONTENT_PAGE', 'Page de contenu');
define('CONTENT_ACTION_BLOCK', 'Bloc action');
define('CONTENT_ACTION_BUTTON', 'Bouton du bloc action');
define('FILE_BLOCK', 'Bloc de media');
define('UPLOAD', 'Upload');
define('LINKED_FILE', 'Fichier lié');
define('NO_DATA_AVAILABLE', 'Aucunes données disponibles');

// UPLOAD BOX
define('DROP_FILES_HERE', 'Déposez les fichiers ici');
define('DROP_FILE_HERE', 'Déposez le fichier ici');
define('UPLOAD_A_FILE', 'Upload');
define('PROCESSSING_DROPPED_FILES', 'Traitement des fichiers déposés ...');
define('RETRY', 'Recommencer');
define('CLOSE', 'Fermer');
define('OK', 'Ok');
define('THUMBNAIL', 'Image');
define('PREVIEW', 'Prévisualisation de l\'image');

define('DESCRIPTIVE', 'Descriptif');
define('OVERVIEW', 'Aperçu');
define('TIMECODE_IN', 'IN');
define('TIMECODE_OUT', 'OUT');
define('MORE_OPTION', 'Plus d\'option');
define('DELIVERY', 'Livraison');
define('NO_CONTENT_PREVIEW', 'Aucune prévisualisation disponible');
define('MULTIPLE_QUALIFICATION', 'Qualification multiple');
define('QUALIFY', 'Qualifier');

define('MAIL_SUBJECT_DELIVERY', '[MediaStorage]Demande de livraison');
define('MAIL_BODY_DELIVERY', 'Le client %s (id: %d) (Email: %s) de la plateforme MediaStorage %s (id: %d) a demandé une livraison de %d.<br/>MediaStorage');

define('VALIDATE_THE', 'Valider les ');
define('GENERAL_CONDITION', 'conditions générales');
define('GENERAL_CONDITION_TITLE', 'Conditions Générales');
define('FORGOT_PASSWORD', 'Mot de passe oublié');
define('CONTACT_ADMIN', 'Contactez-nous');

define('INVALID_TC_IN_EMPTY', 'Tc in vide');
define('INVALID_TC_OUT_EMPTY', 'Tc out vide');
define('INVALID_NAME_EMPTY', 'Nom vide');
define('INVALID_PASSWORD', 'Mot de passe invalide');
define('INVALID_USERNAME', 'Nom d\'utilisateur invalide');
define('CART_HISTORY_TITLE', 'Historique des commandes');
define('DISPLAY_IN_CARD', 'Afficher dans la cartouche');
