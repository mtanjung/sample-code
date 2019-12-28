# Introduction
Docker setup for local environment

# Installation

## Step 1: Download and install docker desktop
Mac: 
- https://docs.docker.com/docker-for-mac/

Windows: 
- https://docs.docker.com/docker-for-windows/


## Step 2: Update hosts on your local machine
on mac: /etc/hosts
on windows: c:\windows\system32\drivers\etc\hosts

```
## Docker: Keyword Objects
# Portal
127.0.0.1 proto.ko.ext
127.0.0.1 proto.ko.int

# Dash
127.0.0.1 dash.proto.ko.ext
127.0.0.1 dash.proto.ko.int

# PPC
127.0.0.1 ppc.proto.ko.ext
127.0.0.1 ppc.proto.ko.int

# SEO
127.0.0.1 seo.proto.ko.ext
127.0.0.1 seo.proto.ko.int

# Admin
127.0.0.1 admin.proto.ko.ext
127.0.0.1 admin.proto.ko.int

# DA
127.0.0.1 da.proto.ko.ext
127.0.0.1 da.proto.ko.int

# Syn
127.0.0.1 syn.proto.ko.ext
127.0.0.1 syn.proto.ko.int

# Aud
127.0.0.1 aud.proto.ko.ext
127.0.0.1 aud.proto.ko.int
```

Note: will need to flush DNS
windows: ipconfig /flushdns
mac: sudo killall -HUP mDNSResponder

## Step 3: Kill any processes using port 80/443
### ON Mac
- sudo killall httpd

### On Windows 10
find PID: netstat -ano | findstr :80|443
kill PID: taskkill /PID (PIDherewithoutparentheses) /F

## Step 4: Git submodules
Go to ko-docker folder and execute the following git commands:
- git submodule init
- git submodule update --init --recursive
- git submodule foreach --recursive git checkout master

## Step 5: Set up DB
Download data.zip, unzip to ko-docker folder.

## Step 6: Run docker
- docker-compose build
- docker-compose up

Note: cannot create container for service x: b'drive has not been shared'
open docker setting, shared drives check apply

Note: Error: A firewall is blocking file sharing between Windows and the containers
https://success.docker.com/article/error-a-firewall-is-blocking-file-sharing-between-windows-and-the-containers

if does not work !

try: 
https://addshore.com/2019/01/a-firewall-is-blocking-sharing-between-windows-and-the-containers-docker/

https://stackoverflow.com/questions/42203488/settings-to-windows-firewall-to-allow-docker-for-windows-to-share-drive/43904051#43904051

## Step 7: login to PHP container, execute bootstrap
run on ko-docker: 
- docker exec -it php /bin/sh

once logged in to container, execute the following commands:
- php /var/www/proto/portal/symfony keywordobjects:bootstrap-config;
- php /var/www/proto/ppc/symfony keywordobjects:bootstrap-config;
- php /var/www/proto/seo/symfony keywordobjects:bootstrap-config;
- php /var/www/proto/admin/symfony keywordobjects:bootstrap-config;
- php /var/www/proto/syn/symfony keywordobjects:bootstrap-config;
- php /var/www/proto/aud/bootstrap.php;
- php /var/www/proto/da/bootstrap.php;
- php /var/www/proto/dash/bootstrap.php;
- cd /var/www/proto/aud; php app/console assets:install --symlink --relative;
- cd /var/www/proto/da; php app/console assets:install --symlink --relative;
- cd /var/www/proto/dash; php app/console assets:install --symlink --relative;

## Step 8: Disable php_value on
apps/portal/web/.htaccess
apps/dash/web/.htaccess
apps/admin/web/.htaccess
apps/aud/web/.htaccess
apps/da/web/.htaccess

php_value max_input_vars 10000 => #php_value max_input_vars 10000

Note: Do not commit these changes

## Step 9: Verify the app is working
Open your favorite browser and go to: https://proto.ko.ext/index.php/login
