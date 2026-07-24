Table "mecanicos" {
  "id" int [pk, not null, increment]
  "id_mecanico" int [not null]
  "nombre" varchar(255) [not null]
  "eliminado" int [not null, default: 0]
}

Table "orden" {
  "id" int [pk, not null, increment]
  "id_autobus" int [not null, ref: - "autobus"."id"]
  "id_razon" int [not null, ref: - "catalogo_razones"."id"]
  "id_supervisor" int [not null, ref: - "supervisor"."id"]
  "fecha_apertura" datetime [not null]
  "fecha_liberacion" datetime
  "fecha_cierre" datetime
  "estado" int [not null, default: 1]
}

Table "empresa" {
  "id" int [pk, not null, increment]
  "nombre" varchar(255) [unique, not null]
  "eliminado" int [not null, default: 0]
}

Table "supervisor_razon" {
  "id" int [pk, not null, increment]
  "id_supervisor" int [not null, ref: - "supervisor"."id"]
  "id_razon" int [not null, ref: - "catalogo_razones"."id"]
}

Table "catalogo_razones" {
  "id" int [pk, not null, increment]
  "descripcion" varchar(100) [not null]
}

Table "supervisor" {
  "id" int [pk, not null, increment]
  "id_supervisor" int [not null]
  "supervisor" varchar(255) [not null]
  "chat_id" varchar(20) [not null]
  "eliminado" int [not null, default: 0]
}

Table "autobus" {
  "id" int [pk, not null, increment]
  "unidad" varchar(500) [unique, not null]
  "id_empresa" int [not null, ref: - "empresa"."id"]
  "eliminado" int [not null, default: 0]
}

Table "reparacion" {
  "id" int [pk, not null, increment]
  "id_orden" int [not null, ref: - "orden"."id"]
  "id_mecanico" int [ref: - "mecanicos"."id"]
  "descripcion" varchar(255) [not null]
  "fecha_inicio" datetime
  "fecha_fin" datetime
  "estado" int [not null, default: 0]
}

Table "reparacion_historial" {
  "id" int [pk, not null, increment]
  "id_reparacion" int [not null, ref: - "reparacion"."id"]
  "id_mecanico" int [not null, ref: - "mecanicos"."id"]
  "fecha_inicio" datetime [not null]
  "fecha_fin" datetime
  "estado" int [not null, default: 1]
}
