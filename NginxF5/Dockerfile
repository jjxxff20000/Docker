FROM alpine:3.4
MAINTAINER "Cloth Mo" <root@buxiaomo.com>

ENV NGINX_VERSION 1.11.7

# COPY repositories /etc/apk/repositories

RUN apk add --no-cache wget g++ make jemalloc-dev pcre-dev openssl-dev geoip-dev \
	&& mkdir -p /usr/local/src/ \
	&& wget -O /usr/local/src/ngx_cache_purge-2.3.tar.gz http://labs.frickle.com/files/ngx_cache_purge-2.3.tar.gz \
	&& tar -zxf /usr/local/src/ngx_cache_purge-2.3.tar.gz -C /usr/local/src/ \
	&& wget -O /usr/local/src/nginx-${NGINX_VERSION}.tar.gz http://nginx.org/download/nginx-${NGINX_VERSION}.tar.gz \
	&& tar -zxf /usr/local/src/nginx-${NGINX_VERSION}.tar.gz -C /usr/local/src/ \
	&& cd /usr/local/src/nginx-${NGINX_VERSION}/ \
	&& ./configure --user=www --group=www --prefix=/usr/local/nginx --with-http_ssl_module --with-http_v2_module --with-http_gzip_static_module --with-http_sub_module --with-ld-opt=-ljemalloc --with-http_geoip_module --add-module=../ngx_cache_purge-2.3 \
	&& make && make install \
	&& addgroup www \
    && adduser -D -G www -s /sbin/nologin www \
	&& rm -rf /usr/local/src/* /usr/local/nginx/html/* \
	&& ln -sf /dev/stdout /usr/local/nginx/logs/access.log \
	&& ln -sf /dev/stderr /usr/local/nginx/logs/error.log \
	&& mkdir /usr/local/nginx/conf/conf.d/ \
	&& apk del --no-cache g++ gcc binutils isl libatomic libc-dev musl-dev make binutils-libs mpc1 mpfr3 gmp libgomp

COPY nginx.conf /usr/local/nginx/conf/nginx.conf

EXPOSE 80 443

VOLUME ["/usr/local/nginx/conf/conf.d/"]

CMD ["/usr/local/nginx/sbin/nginx","-g","daemon off;"]
