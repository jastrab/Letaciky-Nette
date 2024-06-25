
# Letaciky nette  verzia

Postavene na Nette 3 + dockery

- oproti povodne verzii jej chyba par veci

Funkcne:
- Uvodna stranka
- Stranka s letakmi
- Listovanie v letakoch
- Zobrazenie obrazkov (stare letaky nezobrazi, nie su uz obrazky na servery)
- Vyhladavanie v produktoch

Nefunkcne:
- Otvaracie hodiny

Použité technológie

Docker:
 - php
 - nginx
 - mariaDB
 - adminer
 - redis

## Inštalácia dockeru

```sh
docker compose up
```

## Inštalácia composer balíkov

```sh
docker exec -it ulet_php composer install -d /var/www/html/letaciky_nette
```


### Spustenie projektu

- rovnako ako pri inštalácií, prípadne s parametrom -d pre skytie výpisu

```sh
docker compose up -d
```


### Server pre FastApi

- server beží na porte 8080

```sh
https://localhost
```

### Adminer bezi na 8080

```sh
https://localhost:8080/
```
