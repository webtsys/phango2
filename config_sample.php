<?php
/*********************

# Example config for Web-T-syS Phango 1.0

Well, I think that variables don't need explain but...

**********************/

//Don't touch, define a constant neccesary for diverses scripts...

define('PAGE', '1');

//Db config variables

//Host database. You have to write the domain name for the mysql server, normally localhost.
PhangoVar::$host_db['default'] = 'localhost';

//Database name. The database that phango use.
PhangoVar::$db['default'] = 'phango';

//Username for database
PhangoVar::$login_db['default'] = 'root';

//Password for database
PhangoVar::$pass_db['default'] = '';

//Type database server, for now, mysql or derivated
define('TYPE_DB','mysql');

//Use standard connection db?
define('USE_DB',0);

#Path variables

//Cookie_path, path of cookie, Example,if your domain is http://www.example.com/mysite, the content in content_path will be '/mysite/'. If your domain is http://www.example.com, you don't need change default $cookie_path
PhangoVar::$cookie_path = '/';

//The name of session...
define('COOKIE_NAME', 'webtsys_id');

//base url, without last slash. Put here tipically, the url of home page of your site.
PhangoVar::$base_url = 'http://www.example.com';

//base url for media, if you want put this on other server, without last slash. Put here tipically, the same value thar $base_url.
PhangoVar::$media_url = PhangoVar::$base_url;

//base path, the REAL PATH in the server. 
PhangoVar::$base_path = '/var/www/htdocs/phango/';

//media path, the REAL PATH in the server media. Normally you can mount with nfs or other methods the media disk if is on other server. 
PhangoVar::$media_path = PhangoVar::$base_path;

//addons path, if use composer, you can find your modules installed here for load manually.
PhangoVar::$addons_composer_path = PhangoVar::$base_path.'vendor/bin/';

//Path where the index.php alive.
PhangoVar::$application_path = PhangoVar::$base_path.'application/';

//DEBUG, if you active DEBUG, phango send messages with error to stdout
define('DEBUG', '0');

#Language variables

//Language, define display language, you can create many new languages using check_language.php, for the code, use the l10n standard.
PhangoVar::$language = 'en-US';
//Avaliables languages, you can append a new language in the array.
PhangoVar::$arr_i18n = array('es-ES','en-US');

//Touch this variables only if you know that you make.
PhangoVar::$arr_i18n_ckeditor = array('es-ES' => 'es.js','en-US' => 'en.js');
PhangoVar::$arr_i18n_tinycme = array('es-ES' => 'es.js','en-ES' => 'en.js');

//Timezone, define timezone, you can choose timezones from this list: http://php.net/manual/es/timezones.php
define('MY_TIMEZONE', 'America/New_York');

//App index.Here you can say to phango what module want that is showed in home page.

PhangoVar::$app_index = 'welcome';

//In this array you can append the modules that you want execute. Delete media when your app goes to production.

PhangoVar::$activated_modules = array('welcome', 'media');

//Constant for development, delete if you want to go to production.

PhangoVar::$THEME_MODULE=1;

//Constant for the admin section

define('ADMIN_FOLDER', 'admin');

//Theme used by default. 

PhangoVar::$dir_theme = 'default';

//If the theme is on a module, use this variable. Example:  PhangoVar::$module_theme = 'modules/descuentos/'; 

PhangoVar::$module_theme = '';

//Default portal name

PhangoVar::$portal_name='My Web';
	
//Default portal_email
	
PhangoVar::$portal_email='example@example.com';

//Default date format on php format. More examples: http://php.net/manual/es/function.date.php

PhangoVar::$date_format='d-m-Y';
	
PhangoVar::$time_format='7200';

//Timezone, define timezone, you can choose timezones from this list: http://php.net/manual/es/timezones.php

PhangoVar::$timezone=MY_TIMEZONE;

//Default time format on php format. More examples: http://php.net/manual/es/function.date.php

PhangoVar::$ampm='H:i:s';

// Default editor used for textareas on TextBBForm

PhangoVar::$textbb_type='ckeditor';

//Captcha type used on many places for clases how login class.

PhangoVar::$captcha_type='';

//Mailer type used for send emails by send_mail function.
	
PhangoVar::$mailer_type='';

//A key for use in different encryption methods..., change for other, a trick is make a sha1sum with a random file.

PhangoVar::$prefix_key = 'bc24ffaf6dd55be07423bf37bdc24d65d5f7b275';

?>
