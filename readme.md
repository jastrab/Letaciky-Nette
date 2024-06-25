
# Letaciky nette verzia

Postavene na Nette 3 + docker

## Info:
- oproti povodnej (php) verzii jej chyba zopar veci

Nove:
- data preklopene do DB

Funkcne:
- Uvodna stranka
- Stranka s letakmi
- Listovanie v letakoch
- Zobrazenie obrazkov (stare letaky nezobrazi, nie su uz obrazky na servery)
- Vyhladavanie v produktoch

Nefunkcne:
- Otvaracie hodiny

- vynechane jazykove mutacie a podpora subdomen
- nove/aktualizovane data zatial nie su dostupne pre tuto verziu

## Tech. info

Docker:
 - php
 - nginx
 - mariaDB
 - adminer
 - redis

Schema DB:

![image](https://github.com/jastrab/Letaciky-Nette/assets/6190406/2d482fa0-5d6b-4736-9c03-93b3761f11ee)

BD obsahuje testovacie data

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
