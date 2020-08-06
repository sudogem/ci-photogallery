# CiPhotoGallery   
This is a photo gallery app built using Codeigniter Framework.   

### Features
* Authentication
* CRUD(Create, Read, Update & Delete) functionality:
  * User
  * Album
  * Photo
* Search

### Requirements
| Tech Stacks    | Supported versions           | Not supported versions   |
| ---------------|------------------------------|--------------------------|
| PHP            | 5.5.38-Win32-VC11-x64<br>    | < 5.0                    |
| MySQL          | mysql v5.5<br>mysql  Ver 14.14 Distrib 5.6.37, for Linux (x86_64) using  EditLine wrapper<br>      | mysql v5.7 |
| Apache2        | Server version: Apache/2.4.27 (Win64)   |  n/a |

### Installation
1. Change directory to Apache2 DocumentRoot e.g., /var/www/html (for ubuntu v14 or latest) or /htdocs (for windows)
2. Inside the DocumentRoot folder lets execute git clone command   
   e.g, git clone --depth=1 https://github.com/sudogem/ci_photogallery.git    
3. Import the database schema(schema.sql) found inside db/ into your phpMyAdmin   
4. Edit the config.php & database.php settings found inside the /application/config folder   
5. Open the app by accessing it in your browser e.g. http://localhost/ci_photogallery   

### Others
$ php composer.phar install
$ php composer.phar update --ignore-platform-reqs

### Technology stacks
* jQuery   
* HTML/CSS   
* PHP   
* MySQL  

### Developer
CiPhotoGallery &copy; 2013, Arman Ortega. Released under the MIT License.   
