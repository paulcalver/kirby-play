# Kirby / Apache
Options -Indexes
RewriteEngine On

# Block dotfiles
RewriteRule (^|/)\. - [F]

# Don’t rewrite real files or dirs
RewriteCond %{REQUEST_FILENAME} -f [OR]
RewriteCond %{REQUEST_FILENAME} -d
RewriteRule ^ - [L]

# Route everything else to Kirby
RewriteRule ^ index.php [L]