FROM centos:7
MAINTAINER "Mo" <root@ywclub.org>

COPY RUN /RUN

RUN yum install passwd openssl openssh-server -y  \
    && ssh-keygen -q -t rsa -b 2048 -f /etc/ssh/ssh_host_rsa_key -N '' \
    && ssh-keygen -q -t ecdsa -f /etc/ssh/ssh_host_ecdsa_key -N '' \
    && ssh-keygen -t dsa -f /etc/ssh/ssh_host_ed25519_key  -N '' \
    && sed -i "s/#UsePrivilegeSeparation.*/UsePrivilegeSeparation no/g" /etc/ssh/sshd_config \
    && sed -i "s/UsePAM.*/UsePAM no/g" /etc/ssh/sshd_config \
    && chmod +x /RUN

EXPOSE 22

ENV ROOTPASS root

ENV PATH /usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/root/bin

CMD ["/RUN"]
