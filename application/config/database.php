<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
|				 (and in table creation queries made with DB Forge).
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['autoinit'] Whether or not to automatically initialize the database.
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/

// $active_group = 'postgres_prod';
$active_group = 'docker';
$active_record = TRUE;

## Note: Make sure that we configure our Environment variables(System variables in Windows)
## Else it will choose the default variables.

$db['docker']['hostname'] = '172.17.0.4';
$db['docker']['username'] = 'root';
$db['docker']['password'] = 'webdevel';
$db['docker']['database'] = 'ci_photogallery';
$db['docker']['port'] = '3306';
$db['docker']['dbdriver'] = 'mysql';
$db['docker']['dbprefix'] = '';
$db['docker']['pconnect'] = TRUE;
$db['docker']['db_debug'] = TRUE;
$db['docker']['cache_on'] = FALSE;
$db['docker']['cachedir'] = '';
$db['docker']['char_set'] = 'utf8';
$db['docker']['dbcollat'] = 'utf8_general_ci';
$db['docker']['swap_pre'] = '';
$db['docker']['autoinit'] = TRUE;
$db['docker']['stricton'] = FALSE;


$db['default']['hostname'] = isset($_ENV["PHINX_MYDB_HOST"]) ? $_ENV["PHINX_MYDB_HOST"]: 'localhost';
$db['default']['username'] = isset($_ENV["PHINX_MYDB_USER"]) ? $_ENV["PHINX_MYDB_USER"]: 'root';
$db['default']['password'] = isset($_ENV["PHINX_MYDB_PASS"]) ? $_ENV["PHINX_MYDB_PASS"]: 'webdevel';
$db['default']['database'] = isset($_ENV["PHINX_MYDB_DBNAME"]) ? $_ENV["PHINX_MYDB_DBNAME"]: 'ci_photogallery';
$db['default']['port'] = isset($_ENV["PHINX_MYDB_PORT"]) ? $_ENV["PHINX_MYDB_PORT"]: "3311";
$db['default']['dbdriver'] = 'mysql';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = TRUE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;

## For Postgres DB
$db['postgres_dev']['hostname'] = isset($_ENV["PHINX_DB_HOST"]) ? $_ENV["PHINX_DB_HOST"]: "localhost";
$db['postgres_dev']['username'] = isset($_ENV["PHINX_DB_USER"]) ? $_ENV["PHINX_DB_USER"]: "root";
$db['postgres_dev']['password'] = isset($_ENV["PHINX_DB_PASS"]) ? $_ENV["PHINX_DB_PASS"]: "webdevel";
$db['postgres_dev']['database'] = isset($_ENV["PHINX_DB_DBNAME"]) ? $_ENV["PHINX_DB_DBNAME"]: "ci_photogallery";
$db['postgres_dev']['port'] = isset($_ENV["PHINX_DB_PORT"]) ? $_ENV["PHINX_DB_PORT"]: "3306";
$db['postgres_dev']['dbdriver'] = "postgre";
$db['postgres_dev']['dbprefix'] = "";
$db['postgres_dev']['pconnect'] = TRUE;
$db['postgres_dev']['db_debug'] = TRUE;
$db['postgres_dev']['cache_on'] = FALSE;
$db['postgres_dev']['cachedir'] = "";
$db['postgres_dev']['char_set'] = "utf8";

## Deploy to Heroku Postgres add-ons
$db['postgres_prod']['hostname'] = isset($_ENV["HEROKU_POSTGRES_DB_HOSTNAME"]) ? $_ENV["HEROKU_POSTGRES_DB_HOSTNAME"]: "localhost";
$db['postgres_prod']['username'] = isset($_ENV["HEROKU_POSTGRES_DB_USERNAME"]) ? $_ENV["HEROKU_POSTGRES_DB_USERNAME"]: "root";
$db['postgres_prod']['password'] = isset($_ENV["HEROKU_POSTGRES_DB_PASSWORD"]) ? $_ENV["HEROKU_POSTGRES_DB_PASSWORD"]: "webdevel";
$db['postgres_prod']['database'] = isset($_ENV["HEROKU_POSTGRES_DB_DBNAME"]) ? $_ENV["HEROKU_POSTGRES_DB_DBNAME"]: "ci_photogallery";
$db['postgres_prod']['port'] = isset($_ENV["HEROKU_POSTGRES_DB_PORT"]) ? $_ENV["HEROKU_POSTGRES_DB_PORT"]: "3306";
$db['postgres_prod']['dbdriver'] = "postgre";
$db['postgres_prod']['dbprefix'] = "";
$db['postgres_prod']['pconnect'] = TRUE;
$db['postgres_prod']['db_debug'] = TRUE;
$db['postgres_prod']['cache_on'] = FALSE;
$db['postgres_prod']['cachedir'] = "";
$db['postgres_prod']['char_set'] = "utf8";

// print "<pre>";
// print_r($db[$active_group]);
// print "</pre>";

/* End of file database.php */
/* Location: ./application/config/database.php */
