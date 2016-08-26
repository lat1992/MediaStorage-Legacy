<?php

// GLOBAL

define('VALIDATE', '確認');
define('LOGOUT', '離開');
define('NULL', '空');
define('YES', '是');
define('NO', '否');
define('MENU', '菜單');
define('ADMINISTRATOR', '管理員');
define('EDIT', '編輯');
define('DELETE', '刪除');
define('CANCEL', '取消');
define('ACTION_SUCCESS', '操作成功');
define('INFO_MULTIPLE_SELECT', '多選請按住CTRL鍵');
define('RETURN_HOMEPAGE', '回到首頁');
define('ID', 'ID');
define('NEXT', '下一頁');

// Errors

define('ERROR', '錯誤');
define('ID_NOT_FOUND', '無法找到ID');

// User

define('USERNAME', '用戶名');
define('PASSWORD', '密碼');
define('PASSWORD_BIS', '確認密碼');
define('ORGANIZATION', '組織');
define('ROLE', '用戶群');
define('LANGUAGE', '語言');
define('FIRST_NAME', '名字');
define('LAST_NAME', '姓氏');
define('EMAIL', 'EMAIL');
define('ADDRESS', '地址');
define('ZIPCODE', '郵政編號');
define('CITY', '城市');
define('COUNTRY', '國家');
define('PHONE', '座機電話');
define('MOBILE', '手機電話');
define('COMPANY', '公司');
define('JOB', '職位');
define('PROFILE', '個人資料');

// User management page

define('USER_CREATION_TITLE', '新增用戶');
define('USER_LIST_TITLE', '用戶列表');
define('USER_EDIT_TITLE', '編輯用戶');

define('USER_CREATION_DATABASE_ERROR', '無法新增用戶：無法連接數據庫');
define('EMPTY_USERNAME', '用戶名爲空');
define('DUPLICATE_USERNAME', '用戶名已存在');
define('INVALID_USERNAME_TOO_LONG', '用戶名過長');
define('EMPTY_PASSWORD', '密碼爲空');
define('PASSWORD_NOT_MATCH', '密碼或用戶名錯誤');
define('INVALID_FIRST_NAME_TOO_LONG', '名字過長');
define('INVALID_LAST_NAME_TOO_LONG', '姓氏過長');
define('INVALID_ADDRESS_TOO_LONG', '地址過長');
define('INVALID_ZIPCODE_TOO_LONG', '郵遞編號過長');
define('INVALID_CITY_TOO_LONG', '城市名過長');
define('INVALID_COUNTRY_TOO_LONG', '國家名過長');
define('INVALID_PHONE_TOO_LONG', '座機號碼過長');
define('INVALID_MOBILE_TOO_LONG', '手機號碼過長');
define('INVALID_COMPANY_TOO_LONG', '公司名過長');
define('INVALID_JOB_TOO_LONG', '職稱過長');
define('USERS_NOT_FOUND', '無法找到用戶');

// Role management page

define('ROLE_LIST_TITLE', '用戶群列表');
define('ROLE_CREATION_TITLE', '新增用戶群');

define('ROLE_LANGUAGE_CREATION_TITLE', '為用戶群添加翻譯');
define('ROLE_PERMIT_CREATION_TITLE', '為用戶群添加權限');
define('DATA', '内容');
define('PERMIT', '權限');

define('EMPTY_ROLE', '用戶群為空');
define('EMPTY_DATA', '内容爲空');
define('INVALID_DATA_TOO_LONG', '内容過長');

define('NB_PERMIT', '權限數量');
define('LANGUAGE_TRANSLATE', '翻譯');

define('ROLE_EDIT_TITLE', '編輯用戶群');

// Sharelist

define('SHARELIST_CREATION_TITLE', '新增分享清單');
define('SHARELIST_MEDIA_CREATION_TITLE', '為分享清單添加媒體');
define('SHARELIST', '分享清單列表');
define('REFERENCE', '參考碼');
define('USER', '用戶');

// Organization

define('NAME', '名稱');
define('GROUP', '組織');
define('ORGANIZATION_CREATION_TITLE', '新增組織');
define('EMPTY_REFERENCE', '參考碼爲空');
define('INVALID_REFERENCE_TOO_LONG', '參考碼過長');
define('EMPTY_NAME', '名稱爲空');
define('INVALID_NAME_TOO_LONG', '名稱過長');

// Group

define('GROUP_CREATION_TITLE', '新增集團');
define('GROUP_EDIT_TITLE', '編輯集團');
define('GROUP_DELETE_TITLE', '刪除集團');
define('GROUP_LANGUAGE_CREATION_TITLE', '為集團添加語言');
define('FILESERVER', '文件服務器');
define('EMPTY_FILESERVER', '文件服務器地址為空');
define('INVALID_FILESERVER_TOO_LONG', '文件服務器地址過長');
define('DUPLICATE_REFERENCE', '參考碼已被使用');

define('NB_ORGANIZATION', '組織數量');
define('NB_LANGUAGE', '語言數量');
define('GROUP_LIST_TITLE', '集團清單');

// Language

define('LANGUAGE_CREATION_TITLE', '新增語言');
define('CODE', '代號');
define('EMPTY_CODE', '代號為空');
define('INVALID_CODE_TOO_LONG', '代號過長');
define('LANGUAGE_LIST_TITLE', '語言清單');
define('LANGUAGE_EDIT_TITLE', '編輯語言');

// Tag

define('TAG', '標簽');
define('TAG_CREATION_TITLE', '新增標簽');
define('TAG_LANGUAGE_CREATION_TITLE', '為標簽添加翻譯');

// Cart

define('CART_CREATION_TITLE', 'Création d\'un panier');

// Chapter

define('CHAPTER_CREATION_TITLE', '新增章節');
define('CHAPTER_LANGUAGE_CREATION_TITLE', '為章節添加翻譯');
define('CHAPTER', '章節');
define('TC_IN', '起點時間');
define('TC_OUT', '結束時間');

// Maillist

define('EMPTY_EMAIL', 'EMAIL爲空');
define('INVALID_EMAIL_TOO_LONG', 'EMAIL過長');
define('MAILLIST_CREATION_TITLE', '新增EMAIL發送列表');

// Folder

define('FOLDER', '文件夾');
define('PARENT_FOLDER', '母文件夾');
define('FOLDER_CREATION_TITLE', '新增文件夾');
define('FOLDER_LANGUAGE_CREATION_TITLE', '為文件夾添加翻譯');
define('FOLDER_MEDIA_CREATION_TITLE', '為文件夾添加媒體');
define('PARENT_FOLDER_EMPTY', '未選擇母文件夾');
define('INFO_MOVE_DIRECTORY', '如不移動，請留空');
define('INVALID_PARENT_ID', '母文件夾選擇錯誤');
define('FOLDER_PARENT', '母文件夾');
define('FOLDER_LIST_TITLE', '文件夾清單');

// Media

define('INVALID_EPISODE_NUMBER_TOO_LONG', '集數字符過長');
define('INVALID_IMAGE_VERSION_DATA_TOO_LONG', '視訊版本字符過長');
define('INVALID_SOUND_VERSION_DATA_TOO_LONG', '音訊版本字符過長');
define('MEDIA_INFO_CREATION_TITLE', '為媒體添加信息');

define('TITLE', '標題');
define('SUBTITLE', '子標題');
define('DESCRIPTION', '描述');
define('EPISODE_NUMBER', '集數');
define('IMAGE_VERSION', '視訊版本');
define('SOUND_VERSION', '音訊版本');
define('HANDOVER_DATE', '處理日期');

define('MEDIA', '媒體');
define('MEDIA_PARENT', '母媒體');
define('MEDIA_TYPE', '媒體類型');
define('MEDIA_TYPE_PROGRAMME', '節目');
define('MEDIA_TYPE_CONTENT', '内容');
define('MEDIA_TYPE_ESSENCE', 'Essence');
define('MEDIA_REFERENCE', '參考碼');
define('MEDIA_RIGHT_VIEW', '可視');
define('MEDIA_RIGHT_DOWNLOAD', '可下載');
define('MEDIA_CREATION_TITLE', '新增媒體');

define('MEDIA_EXTRA_FIELD_CREATION_TITLE', '新增額外欄位');
define('MEDIA_EXTRA_FIELD', '額外欄位');
define('TYPE', '類型');
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
define('FIELD', '欄位');

define('SEARCH', '尋找');
define('CONTENT', '内容');

define('ORGANIZATION_LIST_TITLE', '組織清單');
define('ORGANIZATION_EDIT_TITLE', '編輯組織');

define('MAIL_LIST_TITLE', 'EMAIL清單');
define('MAIL_CREATION_TITLE', '新增EMAIL');
define('MAIL_EDIT_TITLE', '編輯EMAIL');

define('REFERENCE_CLIENT', '客戶參考碼');
define('RIGHT_VIEW', '可視權限');
define('MEDIA_FILE', '媒體檔案');
define('RIGHT_DOWNLOAD', '可下載權限');
define('RIGHT_ADDTOCART', '可購買權限');
define('FILENAME', '檔案名稱');
define('FILEPATH', '檔案路徑');

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
define('PROGRAM', '節目');
define('CREATE_MEDIA_CONTENT', 'Créer un Contenu');
define('EDIT_MEDIA_CONTENT', 'Editer un Contenu');
define('CONTENT_LIST_TITLE', 'Liste des Contenus');
define('LINK_MEDIA_PROGRAM', 'Lier a un programme');
define('LINK_MEDIA_CONTENT', 'Lier a un contenu');

define('EMPTY_MEDIA_REFERENCE', 'Référence vide');
define('INVALID_MEDIA_REFERENCE_TOO_LONG', 'Reference trop longue');
define('MANDATORY', 'Obligatoire');

define('DASHBOARD', '儀表板');
define('ADMIN_INFORMATION', '注意：在做出任何修改前，請先確認清楚。');
define('ROOT', '超級管理員門戶');

// Media FIle

define('MEDIA_FILE_UPLOAD_TITLE', 'Upload de média');