# Docker-Nginx-F5

    docker run -d --name F5 -p 80:80 -v /docker/nginx.d/:/usr/local/nginx/conf/conf.d/ nginx:f5

/docker/nginx.d/moli.conf


    upstream moli {
      #ip_hash;
      server moli;
    }
    server {
      listen       80;
      server_name  moli.xxxx.com;
      location / {
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_buffering off;
        proxy_pass http://moli;
      }
    }
