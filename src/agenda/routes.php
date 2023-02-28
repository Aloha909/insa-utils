<?php
require_once __DIR__.'/router.php';

require __DIR__.'/../template/footer.php';

require_once __DIR__.'/../origin_path.php';

require_once __DIR__.'/db.php';
require_once __DIR__.'/utils.php';
require_once __DIR__.'/php/auth.php';
require_once __DIR__.'/php/class.php';

setlocale(LC_ALL, 'fr_FR');
date_default_timezone_set("Europe/Paris");

// Not authenticated pages
any(getRootPath() . 'agenda', 'views/home.php');
any(getRootPath() . 'agenda/auth', 'views/auth.php');
any(getRootPath() . 'agenda/classes', 'views/classes.php');
any(getRootPath() . 'agenda/class/$class/join', 'views/class/join.php');

// User pages
any(getRootPath() . 'agenda/unsubscribe', 'views/unsubscribe.php');
any(getRootPath() . 'agenda/account', 'views/account.php');

// Class related pages
any(getRootPath() . 'agenda/all', 'views/class/all.php');
any(getRootPath() . 'agenda/requests', 'views/class/requests.php');
any(getRootPath() . 'agenda/subjects', 'views/class/subjects.php');

// Managers
any(getRootPath() . 'agenda/manage/todo', 'views/manage/manage_todo.php');
any(getRootPath() . 'agenda/manage/subjects', 'views/manage/manage_subjects.php');
any(getRootPath() . 'agenda/manage/requests', 'views/manage/manage_requests.php');
any(getRootPath() . 'agenda/manage/disable_email', 'views/manage/manage_disable_email.php');
any(getRootPath() . 'agenda/manage/account', 'views/manage/manage_account.php');

// JS API
any(getRootPath() . 'agenda/jsapi/status', 'views/jsapi/jsapi_status.php');
any(getRootPath() . 'agenda/jsapi/checkcsrf', 'views/jsapi/jsapi_checkcsrf.php');






