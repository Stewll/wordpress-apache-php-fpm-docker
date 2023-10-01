# disable the apache2 cache module
a2dismod cache
# Disable the apache2 cache for the proxy module
a2dismod cache_disk
# Disable the apache2 cache for the proxy module

# Load our virtual host config
a2ensite 000-default.conf

# Reload apache2
service apache2 reload

# Start apache2
/usr/sbin/apache2ctl -D FOREGROUND
