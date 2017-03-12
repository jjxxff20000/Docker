#!/bin/bash
if [[ ${SS_IP} = "**NULL**" && ${SS_PASS} = "**NULL**" ]];then
	/usr/bin/sqlmap $@
else
	if [[ ${SS_IP} = "**NULL**" || ${SS_PASS} = "**NULL**" ]];then
		echo "=> Please Set SS_IP and SS_PASS variable"
		exit 1
	fi
	echo "=> Config Shadowsocks Client"
	echo "{
	\"server\":\"${SS_IP}\",
	\"server_port\":${SS_SPORT},
	\"local_port\":${SS_LPORT},
	\"password\":\"${SS_PASS}\",
	\"timeout\":600,
	\"method\":\"aes-256-cfb\"
}" > /root/ssclient.json
	echo "=> Connect To Shadowsocks Server"
	nohup ss-local -c /root/ssclient.json >> /root/ss.log &
	nohup polipo socksParentProxy=127.0.0.1:1080 & 
	/usr/bin/sqlmap --proxy=http://localhost:8123 $@
fi 
