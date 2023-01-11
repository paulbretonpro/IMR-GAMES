# IMR-GAMES

IMR-GAMES is a platform that brings together games for you and your friends.

The games :
  - Undercover
  
## Setup environnement

### Pre-requisites

You need ```docker```

### If we don't have ```vendor``` folder

Go to the ```API/``` folder

```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```

### Then 

Enter command ```make``` or ```make start```.
 
You can also stop container with ```make stop```
