[![Review Assignment Due Date](https://classroom.github.com/assets/deadline-readme-button-22041afd0340ce965d47ae6ef1cefeee28c7c493a6346c4f15d667ab976d596c.svg)](https://classroom.github.com/a/Jfpv1-N9)
# Tareas del proyecto backend

## PB2025-18: Configuración del Proyecto Laravel y Base de Datos
**Historia**

**Como** desarrollador backend **Quiero** tener un proyecto Laravel correctamente configurado con conexión a base de datos **Para** construir una API robusta y escalable que soporte las funcionalidades requeridas

**Criterios de aceptación:**

* El proyecto debe estar inicializado con la versión más reciente estable de Laravel
* La conexión a la base de datos debe estar configurada correctamente
* Las migraciones iniciales del sistema deben estar implementadas
* Los seeders básicos deben estar disponibles para datos de prueba


## PB2025-19: Sistema de Autenticación y Autorización
**Historia**

**Quiero** poder registrarme, autenticarme y gestionar mi cuenta de forma segura **Para** acceder a las funcionalidades protegidas de la aplicación

**Criterios de aceptación:**

* El sistema debe permitir registro de usuarios con validación de datos
* Debe implementar autenticación segura mediante tokens (Sanctum)
* Debe incluir funcionalidad de recuperación de contraseña
* Debe implementar sistema de roles y permisos
* Los endpoints de autenticación deben estar protegidos contra ataques comunes
* Debe incluir validación de tokens y manejo de expiración
* El sistema debe registrar intentos fallidos de autenticación

## PB2025-20: Desarrollo del Núcleo de la API RESTful
**Historia**

**Como** desarrollador frontend **Quiero** disponer de endpoints API RESTful bien estructurados para las entidades principales **Para** poder realizar operaciones CRUD desde el frontend


**Criterios de aceptación:**

* Deben implementarse recursos RESTful completos (index, show, store, update, destroy)
* Cada endpoint debe incluir validación de datos de entrada
* Los endpoints deben retornar respuestas y códigos HTTP apropiados
* Debe implementarse paginación para colecciones de datos grandes
* La API debe seguir convenciones de nomenclatura consistentes
* Los recursos deben incluir relaciones entre entidades cuando sea necesario

## PB2025-16: Integración de Frontend-Backend
**Historia**

**Como** equipo de desarrollo **Quiero** establecer una comunicación efectiva entre el frontend Vue y el backend Laravel **Para** que la aplicación funcione como un sistema completo y pueda consumir datos reales


**Criterios de aceptación:**

* El frontend debe poder realizar peticiones HTTP a todos los endpoints API del backend
* La autenticación debe funcionar correctamente usando tokens Sanctum
* Los estados de Vuex/Pinia deben actualizarse con datos reales del backend
* Las respuestas de error desde el backend deben manejarse y mostrarse apropiadamente
* Las peticiones asíncronas deben mostrar estados de carga (loading)
* La configuración de CORS debe estar correctamente implementada
* Debe incluirse interceptores para renovar tokens expirados automáticamente
