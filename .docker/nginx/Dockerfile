FROM nginx:1.23.1

ENV TZ=Europe/Riga
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

COPY ./.docker/nginx/http.conf /etc/nginx/conf.d/default.conf
COPY ./.docker/nginx/fastcgi-php.conf /etc/nginx/fastcgi-php.conf
