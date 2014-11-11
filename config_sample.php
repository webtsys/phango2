<?php
/*********************

# Example config for Web-T-syS Phango 1.0

Well, I think that variables don't need explain but...

**********************/

//Don't touch, define a constant neccesary for diverses scripts...

define('PAGE', '1');

//Db config variables

//Host database. You have to write the domain name for the mysql server, normally localhost.
PhangoDef::$host_db['default'] = 'localhost';

//Database name. The database that phango use.
PhangoDef::$db['default'] = 'phango';

//Username for database
PhangoDef::$login_db['default'] = 'root';

//Password for database
PhangoDef::$pass_db['default'] = '';

//Type database server, for now, mysql or derivated
define('TYPE_DB','mysql');

//Use standard connection db?
define('USE_DB',0);

#Path variables

//Cookie_path, path of cookie, Example,if your domain is http://www.example.com/mysite, the content in content_path will be '/mysite/'. If your domain is http://www.example.com, you don't need change default $cookie_path
PhangoDef::$cookie_path = '/';

//The name of session...
define('COOKIE_NAME', 'webtsys_id');

//base url, without last slash. Put here tipically, the url of home page of your site.
PhangoDef::$base_url = 'http://www.example.com';

//base path, the REAL PATH in the server. 
PhangoDef::$base_path = '/var/www/htdocs/phango/';

//DEBUG, if you active DEBUG, phango send messages with error to stdout
define('DEBUG', '0');

#Language variables

//Language, define display language, you can create many new languages using check_language.php, for the code, use the l10n standard.
PhangoDef::$language = 'en-US';
//Avaliables languages, you can append a new language in the array.
PhangoDef::$arr_i18n = array('es-ES','en-US');

//Touch this variables only if you know that you make.
PhangoDef::$arr_i18n_ckeditor = array('es-ES' => 'es.js','en-US' => 'en.js');
PhangoDef::$arr_i18n_tinycme = array('es-ES' => 'es.js','en-ES' => 'en.js');

//Timezone, define timezone, you can choose timezones from this list: http://php.net/manual/es/timezones.php
define('MY_TIMEZONE', 'America/New_York');

//App index.Here you can say to phango what module want that is showed in home page.

PhangoDef::$app_index = 'welcome';

//In this array you can append the modules that you want execute. Delete media when your app goes to production.

PhangoDef::$activated_controllers = array('welcome', 'media');

//Constant for development, delete if you want to go to production.

define('THEME_MODULE', 1);

//Constant for the admin section

define('ADMIN_FOLDER', 'admin');

//Theme used by default. 

PhangoDef::$dir_theme = 'default';

//If the theme is on a module, use this variable. Example:  PhangoDef::$module_theme = 'modules/descuentos/'; 

PhangoDef::$module_theme = '';

//Default portal name

PhangoDef::$portal_name='My Web';
	
//Default portal_email
	
PhangoDef::$portal_email='example@example.com';

//Default date format on php format. More examples: http://php.net/manual/es/function.date.php

PhangoDef::$date_format='d-m-Y';
	
PhangoDef::$time_format='7200';

//Timezone, define timezone, you can choose timezones from this list: http://php.net/manual/es/timezones.php

PhangoDef::$timezone=MY_TIMEZONE;

//Default time format on php format. More examples: http://php.net/manual/es/function.date.php

PhangoDef::$ampm='H:i:s';

// Default editor used for textareas on TextBBForm

PhangoDef::$textbb_type='ckeditor';

//Captcha type used on many places for clases how login class.

PhangoDef::$captcha_type='';

//Mailer type used for send emails by send_mail function.
	
PhangoDef::$mailer_type='';

//A key for use in different encryption methods..., change for other, a trick is make a sha1sum with a random file.

PhangoDef::$prefix_key = 'bc24ffaf6dd55be07423bf37bdc24d65d5f7b275';

?>
