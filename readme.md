
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
![image](https://github.com/jastrab/Letaciky-Nette/assets/6190406/da476527-1c08-4b37-965f-acae0c475128)




