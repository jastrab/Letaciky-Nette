
# Letáčiky - nette verzia

Postavené na Nette 3, PHP 8.3, Docker

## Info:
- koncept vychádza z pôvodnej PHP verzie Letáčikov:
https://letaciky.sk

Funkčné:
- Úvodna stránka
- Stránka s letákmi
- Detail letáku
- Zobrazenie obrázkov (stare letaky nezobrazi, nie su uz obrazky na servery)
- Vyhľadávanie produktov v letákoch
- Otváracie hodiny
- Detail otváracích hodín + mapa

Nefunkčné:
- podpora subdomén a zahraničných textov
- nove/aktualizovane dáta zatial nie su dostupné pre túto verziu

Nové:
- nová databáza pre letáky - letáčiky pôvodne nemajú DB letákov (json)
- nová/upravená databáya pre otváracie hodiny
- dáta letákov preklopene do DB (dočasný import)

V pláne:
- API - letáčiky sú dostupné aj na kodi => https://github.com/jastrab/plugin.image.letaky
- Podpora subdomény -> viď https://letaciky.com
- Admin zóna

## Tech. info

Docker:
 - php
 - nginx
 - mariaDB
 - adminer
 - redis

Schéma DB:

![image](https://github.com/jastrab/Letaciky-Nette/assets/6190406/16875804-b41f-4e27-8931-b33e3ba1a381)


DB obsahuje testovacie dáta letákov

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

## Error
v prípade chyby, treba nastaviť práva:

Unable to create directory '/var/www/html/letaciky_nette/temp/cache' with mode 777. Permission denied.

```sh
cd ./html/letaciky_nette
sudo chmod -R a+rw temp log
```
---


### Adminer bezi na 8080

```sh
https://localhost:8080/
```

![image](https://github.com/jastrab/Letaciky-Nette/assets/6190406/a473ebec-b352-479c-9f07-7401c5505113)


Pri prihlaseni do adminera treba zvolit udaje:
```sh
System   : MySQL
Server   : mysql	
Username : letaciky
Password : letaciky
Database : letaciky
```
- Niekedy nazov servera moze byt aj: "localhost" alebo "127.0.0.1"

---

### Server

- server beží na porte 443

```sh
https://localhost
```

![image](https://github.com/jastrab/Letaciky-Nette/assets/6190406/bc743575-596f-4586-a20d-7ad804817804)





