FROM debian:jessie
MAINTAINER "Cloth Mo" <root@buxiaomo.com>

COPY sources.list /etc/apt/sources.list

RUN apt-get update \
    && apt-get install openjdk-7-jdk --no-install-recommends -y \
    && apt-get clean all \
    && rm -rf /var/lib/apt/lists/*
ENV JAVA_HOME /usr/lib/jvm/java-7-openjdk-amd64
ENV CLASSPATH $JAVA_HOME/lib/dt.jar:$JAVA_HOME/lib/tools.jar
ENV PATH $PATH:$JAVA_HOME/bin:$JRE_HOME/bin

RUN apt-get update \
    && apt-get install ant --no-install-recommends -y \
    && apt-get clean all \
    && rm -rf /var/lib/apt/lists/*
ENV ANT_HOME /usr/share/ant
ENV PATH $PATH:$ANT_HOME/bin

RUN apt-get update \
    && apt-get install maven --no-install-recommends -y \
    && apt-get clean all \
    && rm -rf /var/lib/apt/lists/*
ENV MAVEN_HOME /usr/share/maven/
ENV PATH $PATH:$MAVEN_HOME/bin

RUN apt-get update \
    && apt-get install git --no-install-recommends -y \
    && apt-get clean all \
    && rm -rf /var/lib/apt/lists/*

RUN apt-get update \
    && apt-get install wget --no-install-recommends -y \
    && wget -O /usr/local/src/docker-1.13.0.tgz  https://get.docker.com/builds/Linux/x86_64/docker-1.13.0.tgz \
    && tar --strip-components=1 -xvzf /usr/local/src/docker-1.13.0.tgz -C /usr/local/bin

RUN apt-get update \
    && apt-get install axel -y \
    && axel -n 100 --output=/jenkins.war https://mirrors.tuna.tsinghua.edu.cn/jenkins/war-stable/2.32.1/jenkins.war \
    && apt-get remove axel -y \
    && apt-get clean all \
    && rm -rf /var/lib/apt/lists/*
ENV JENKINS_HOME /var/jenkins

EXPOSE 8080
VOLUME /var/jenkins

CMD ["java","-Dhudson.util.ProcessTree.disable=true","-jar","/jenkins.war"]
