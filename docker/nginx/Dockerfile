FROM nginx:latest

RUN rm /etc/nginx/conf.d/default.conf

COPY conf.d/ /etc/nginx/conf.d/
COPY fastcgi_call /etc/nginx/fastcgi_call
