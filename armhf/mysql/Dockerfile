FROM armhf/debian:jessie
MAINTAINER "Cloth Mo" <root@buxiaomo.com>

EVN MARIADB_MAJOR 10.0

RUN { \
	  echo mariadb-server-$MARIADB_MAJOR mysql-server/root_password password 'unused'; \
	  echo mariadb-server-$MARIADB_MAJOR mysql-server/root_password_again password 'unused'; \
	} | debconf-set-selections \
	&& apt-get update \
  && apt-get install mariadb-server-$MARIADB_MAJOR --no-install-recommends -y
