# Sistema de Reportes de Órdenes

Sistema web desarrollado en PHP y MariaDB para el control de órdenes de reparación, productividad de mecánicos y supervisores, así como generación de reportes y envío de notificaciones.

---

## Tecnologías

- PHP 8.3
- Apache
- MariaDB 11
- phpMyAdmin
- Docker Compose
- JavaScript
- jQuery
- Chart.js

---

## Requisitos

- Docker Desktop o Docker Engine y Docker Compose
- Git

---

## Instalación

Clonar el repositorio:

```bash
git clone https://github.com/TU_USUARIO/reportes_ordenes.git
```

Entrar al proyecto:

```bash
cd reportes_ordenes
```

Cambiar a la rama de desarrollo:

```bash
git checkout docker
```

Levantar los contenedores:

```bash
docker compose up -d --build
```

---

## Accesos

Sistema:

http://localhost:9010

phpMyAdmin:

http://localhost:9011

---

## Base de datos

La base de datos se importa automáticamente desde:

```

admin/reportes_ordenes.sql

```

---

## Detener los contenedores

```bash
docker compose down
```

---

## Eliminar contenedores y base de datos

```bash
docker compose down -v
```

---

## Estructura

```
reportes_ordenes
│
├── admin
├── fotos
├── funciones
├── productividad
├── reporteador
├── sistema
├── docker
│   └── php
├── docker-compose.yml
└── README.md
```

---

## Autor

Luis Salvador Ontiveros Rodríguez