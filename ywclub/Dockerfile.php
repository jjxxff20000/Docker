FROM debian:jessie
MAINTAINER "YwClub" <root@ywclub.com>

COPY sources.list /etc/apt/sources.list

RUN apt-get update \
    && apt-get install --no-install-recommends php5-fpm php5-mysql -y \
    && sed -i "s/upload_max_filesize = 2M/upload_max_filesize = 15M/" /etc/php5/fpm/php.ini \
    && sed -i "s#listen = /var/run/php5-fpm.sock#listen = 9000#g" /etc/php5/fpm/pool.d/www.conf \
    && sed -i "s#user = www-data#user = www#g" /etc/php5/fpm/pool.d/www.conf \
    && sed -i "s#group = www-data#group = www#g" /etc/php5/fpm/pool.d/www.conf \
    && mkdir -p /var/www/html \
    && apt-get clean all \
    && rm -rf /var/lib/apt/lists/* /usr/share/nginx/html/* \
    && groupadd -g 1000 www && useradd -u 1000 -g www www \
    && mkdir -p /usr/share/nginx/html/ \
    && chown -R www.www /usr/share/nginx/html/

# ADD ./wordpress /usr/share/nginx/html
RUN chown -R www.www /usr/share/nginx/html

EXPOSE 9000

CMD ["php5-fpm", "-F"]
