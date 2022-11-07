FROM nginx:alpine

COPY nginx.conf /etc/nginx/
COPY location.conf /etc/nginx/sites-enabled/
RUN rm /etc/nginx/conf.d/default.conf

RUN echo "upstream php-upstream { server php:9000; }" > /etc/nginx/conf.d/upstream.conf
