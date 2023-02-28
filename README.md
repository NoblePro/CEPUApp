# CEPUApp
.htaccess di folder public

  Options -multiviews

  RewriteEngine On

  RewriteCond %{REQUEST_FILENAME} !-f
  RewriteCond %{REQUEST_FILENAME} !-d
  RewriteCond %{REQUEST_FILENAME} !-l 

  RewriteRule ^(.+) index.php?url=$1 [L]

.htaccess di folder app

  Options -indexes
