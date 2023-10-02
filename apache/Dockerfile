FROM wordpress:php7.4-apache
# Set umask to 0000 to allow write access to mounted volumes
RUN umask 0000

# Update the image to the latest packages
RUN apt-get update
RUN apt-get -y upgrade
# Remove obselte packages and clean up
RUN apt-get -y autoremove && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* && \
    rm -fr /tmp/* && \
    rm -fr /var/tmp/*
# Remove cache 
RUN rm -fr /var/lib/caches/* && \
    rm -fr /usr/share/doc/*
#Copy the developement version of php.ini to php.ini
COPY  /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini

# Raise the max upload size to 2000MB
RUN sed -i 's/upload_max_filesize = 2M/upload_max_filesize = 2000M/g' /usr/local/etc/php/php.ini
# Raise the max post size to 2000MB
RUN sed -i 's/post_max_size = 8M/post_max_size = 2000M/g' /usr/local/etc/php/php.ini
# Raise the max execution time to 600 seconds
RUN sed -i 's/max_execution_time = 30/max_execution_time = 600/g' /usr/local/etc/php/php.ini
# Raise the max input time to 600 seconds
RUN sed -i 's/max_input_time = 60/max_input_time = 600/g' /usr/local/etc/php/php.ini
# 


# Add our custom apache2.conf file
ADD apache2.conf /etc/apache2/apache2.conf
# Add apache.sh to start apache in foreground
ADD apache.sh /usr/bin/apache.sh
RUN chmod +x /usr/bin/apache.sh

# Expose port 80
EXPOSE 80
# Set the entrypoint to apache.sh
ENTRYPOINT apache.sh
# set the workdir to /var/www/html
VOLUME /var/www/html
WORKDIR /var/www/html

