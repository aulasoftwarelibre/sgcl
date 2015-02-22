#language: es
@trademark

Característica: Lista marcas
  Para llevar la gestión de marcas de las que gestiono sus productos
  Como administrador de la aplicación
  Quiero poder gestionar el catálogo de compañías
  Quiero poder gestionar el catálogo de marcas

  Antecedentes:
    Dado existen los siguientes usuarios:
    | nombre    | clave     | email                 | activado  | rol         |
    | admin     | adminpw   | admin@latejedora.com  | 1         | ROLE_ADMIN  |
    Y estoy conectado como usuario "admin" y contraseña "adminpw"
    Y existen las siguientes compañías:
    | nombre      | nif        |
    | Compañía A  | A00000001  |
    | Compañía B  | A00000002  |
    | Compañía C  | A00000003  |
    Y existen las siguientes marcas:
    | nombre    | prefijo | prefijoUPC  | compañía    |
    | marca_1   | 1234567 |             | Compañía A  |
    | marca_11  | 1134567 |             | Compañía A  |
    | marca_2   | 2123456 | 012345      | Compañía C  |
    | marca_22  | 2212345 |             | Compañía C  |

  Escenario: Listar compañías
    Dado estoy en la página del escritorio
    Cuando presiono "Listar" cerca de "Trademark"
    Entonces debo estar en la página de listado de marcas
    Y debo ver "4 resultados"

  Esquema del escenario: Buscar marcas
    Dado estoy en la página de listado de marcas
    Cuando relleno "Name" con "<nombre>"
    Y presiono "Filtrar"
    Entonces debo estar en la página de listado de marcas
    Y debo ver "<resultados>"

    Ejemplos:
    | nombre      | resultados        |
    | marca       | 4 resultados      |
    | marca_11    | 1 resultado       |
    | marca_3     | No hay resultados |

  Esquema del escenario: Buscar prefijo
    Dado estoy en la página de listado de marcas
    Cuando relleno "Prefix" con "<prefijo>"
    Y presiono "Filtrar"
    Entonces debo estar en la página de listado de marcas
    Y debo ver "<resultados>"

    Ejemplos:
    | prefijo   | resultados        |
    | 567       | 2 resultados      |
    | 22        | 1 resultado       |
    | 9         | No hay resultados |

  Escenario: Crear nueva marca
    Dado estoy en la página de creación de marcas
    Cuando relleno lo siguiente:
    | Nombre                | marca_4 |
    | Prefijo codificación  | 0123456 |
    Y presiono "Crear y regresar al listado"
    Entonces debo estar en la página de listado de marcas
    Y debo ver "Elemento creado satisfactoriamente"
    Y debo ver "marca_4"

  Escenario: Acceder al formulario de edición de marca desde el listado de marcas
    Dado estoy en la página de listado de marcas
    Cuando presiono "Editar" cerca de "marca_2"
    Entonces debería estar en la página edición de marca con "name" denominado "marca_2"

  Escenario: Actualizar marca
    Dado estoy en la página de listado de marcas
    Y presiono "Editar" cerca de "marca_11"
    Y debería estar en la página edición de marca con "name" denominado "marca_11"
    Cuando relleno "Prefijo codificación para código UPC" con "111111"
    Y presiono "Actualizar"
    Entonces debería estar en la página edición de marca con "name" denominado "marca_11"
    Y debo ver "Elemento actualizado satisfactoriamente."
    Y el campo "Prefijo codificación para código UPC" debe contener "111111"

  Escenario: Borrar marca desde la página de edición
    Dado estoy en la página de listado de marcas
    Y presiono "Editar" cerca de "marca_11"
    Y debería estar en la página edición de marca con "name" denominado "marca_11"
    Cuando sigo "Borrar"
    Entonces debo ver "¿Está seguro de que quiere borrar el elemento seleccionado?"
    Cuando presiono "Sí, borrar"
    Entonces debo estar en la página de listado de marcas
    Y debo ver "Elemento eliminado satisfactoriamente."

  Escenario: Borrar marca desde el listado
    Dado estoy en la página de listado de marcas
    Cuando presiono "Borrar" cerca de "marca_11"
    Entonces debo ver "¿Está seguro de que quiere borrar el elemento seleccionado?"
    Cuando presiono "Sí, borrar"
    Entonces debo estar en la página de listado de marcas
    Y debo ver "Elemento eliminado satisfactoriamente."
    Pero no debo ver "marca_11"
