# Load the apache2 proxys module
a2enmod proxy
a2enmod proxy_fcgi

# Load our virtual host config
a2ensite 000-init.test

# Reload apache2
service apache2 reload

# Start apache2
/usr/sbin/apache2ctl -D FOREGROUND
