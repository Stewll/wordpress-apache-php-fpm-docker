FROM wordpress:php8.0-fpm 

# Put the idea of permition into the trash
# make all newly created files and directories world-writable
RUN umask 0000

# Update the image to the latest packages
RUN apt-get update && apt-get -y upgrade
# Remove obselte packages and clean up
RUN apt-get -y autoremove && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* && \
    rm -fr /tmp/* && \
    rm -fr /var/tmp/*
# Remove cache
RUN rm -fr /var/lib/caches/* && \
    rm -fr /usr/share/doc/*
# Raise PHP memory limit
RUN echo "memory_limit = 256M" > /usr/local/etc/php/conf.d/memory-limit.ini
# Raise max upload to comodate website restore through UpdraftPlus
RUN echo "upload_max_filesize = 256M" > /usr/local/etc/php/conf.d/upload_max_filesize.ini
RUN echo "post_max_size = 2256M" > /usr/local/etc/php/conf.d/post_max_size.ini
# Ajust number of workers to number of cores
RUN sed -i "s/pm.max_children = 5/pm.max_children = 8/" /usr/local/etc/php-fpm.d/www.conf
# Make PHP ultra responsive to the cost of a little more CPU usage
RUN sed -i "s/pm.max_requests = 500/pm.max_requests = 100/" /usr/local/etc/php-fpm.d/www.conf

# start php-fpm
CMD ["php-fpm"]
