# SOSTENIBLES V.9.5.1
## How to install the site and start

Create a www folder where the repo will be cloned:
Ex:

/var/www/

cd /var/www/

git clone git@github.com:diegosebastiangutierrez/sostenibles9.git

A folder sostenibles9 will appear. Enter it:

cd sostenibles9

There, you will find two folders:

- *htdocs* [This is the root website folder]
- *config-sync* [This is where all the configs for each test are going to be uploaded]

Create a new folder with read write permissions for all users called *filecache*

mkdir filecache

sudo chmod ugoa+rw filecache

This folder will be used for caching, so the database is clean and faster (Prod/Devel)


Now, install Drupal 9 and every necessary module:

cd * htdocs *

composer install

After this you will have the skeleton for the website.


Go to your * MySql / Percona / MariaDB * Instance and create an empty database:

mysql -u [user] -p

MySql> Create database [your-empty-db]

MySql> Exit

- Configure NGINX/Apache to host the site. the root filesystem will reside on *htdocs*
- Once your Server is set, go to htdocs/sites/default and copy example.settings.php to settings.php
- With this done, you can go to your browser and proceed the normal installation of the site.
- Proceed to
http://[your-site-hostname-local]/admin/config/development/configuration/full/import
compress the folder in config-sync of the version you want to sync.

### NOTE:

If something goes wrong with cache, is because you have to add these lines at the end
of your settings.php file:

## CACHE FILE_SYSTEM

$settings['cache']['bins']['rest'] = 'cache.backend.file_system';

$settings['cache']['bins']['toolbar'] = 'cache.backend.file_system';

$settings['cache']['bins']['discovery'] = 'cache.backend.file_system';

$settings['cache']['bins']['data'] = 'cache.backend.file_system';

$settings['cache']['bins']['bootstrap'] = 'cache.backend.file_system';

$settings['cache']['bins']['advagg'] = 'cache.backend.file_system';

$settings['cache']['bins']['config'] = 'cache.backend.file_system';

$settings['cache']['bins']['data'] = 'cache.backend.file_system';

$settings['cache']['bins']['dynamic_page_cache'] = 'cache.backend.file_system';

$settings['cache']['bins']['entity'] = 'cache.backend.file_system';

$settings['cache']['bins']['jsonapi_normalizations'] = 'cache.backend.file_system';

$settings['cache']['bins']['page'] = 'cache.backend.file_system';

$settings['cache']['bins']['render'] = 'cache.backend.file_system';

$settings['cache']['default'] = 'cache.backend.file_system';

$settings['filecache']['directory']['default'] = '[/var/www/sostenibles9]/filecache';

Where [/var/www/sostenibles9] is the absolute filesystem route to the recently synced repo on local

### Add the repo to existing folder to commit changes

git init
git remote add origin git@github.com:diegosebastiangutierrez/sostenibles9.git
git branch -M main
git push -u origin main


