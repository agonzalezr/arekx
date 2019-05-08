#  Arekx

A light PHP framework for RESTful Applications.

First you will need the following php extensions installed in your server:

- php7-intl
- php7-gd
- php7-imagick
- php7-zip
- php7-mbstring
- php7-curl
- php7-zlib
- php7-phar
- php7-openssl
- php7-pdo
- php7-mysql

### Installation:


```
php composer.phar install
```

Or if you installed composer with the arguments: --filename=composer --install-dir=/usr/local/bin

```
composer install
```

After the instalation of the libraries:

```
cp .env.example .env
```

And put your server data in the **.env** file. 

### For test the installation:

- Point your **server document root** to the **/Public** folder.

- For enable https uncomment the lines 5 - 6 of the **/Public/.htaccess** file.
