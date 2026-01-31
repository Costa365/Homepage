FROM nimmis/alpine-apache-php7

RUN wget -O phpunit https://phar.phpunit.de/phpunit-8.phar && chmod +x ./phpunit
ENTRYPOINT [ "sh", "-c", "./phpunit /src/" ]
