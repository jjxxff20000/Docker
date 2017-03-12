FROM debian:8
MAINTAINER "Mo" <root@ywclub.org>

COPY sources.list /etc/apt/sources.list
COPY run.sh /run.sh

RUN apt-get update && apt-get install sqlmap shadowsocks-libev polipo -y --force-yes
RUN chmod +x /run.sh 
RUN rm -rf /var/lib/apt/lists/*

ENV SS_IP **NULL**
ENV SS_SPORT 8388
ENV SS_LPORT 1080
ENV SS_PASS **NULL**

VOLUME ["/root/.sqlmap/output/"]

CMD ["--help"]
ENTRYPOINT ["/run.sh"]
