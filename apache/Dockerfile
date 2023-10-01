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

