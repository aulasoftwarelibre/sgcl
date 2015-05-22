#language: es
@company

Característica: Lista compañías
  Para llevar la gestión de compañías de las que gestiono sus productos
  Como administrador de la aplicación
  Quiero poder gestionar el catálogo de compañías

  Antecedentes:
    Dado existen los siguientes usuarios:
      | nombre    | clave     | email       | activado  | rol         |
      | admin     | adminpw   | admin@sgcl  | 1         | ROLE_ADMIN  |
    Y estoy conectado como usuario "admin" y contraseña "adminpw"
    Y existen las siguientes compañías:
      | nombre      | nif        |
      | Compañía A  | A00000001  |
      | Compañía B  | A00000002  |
      | Compañía C  | A00000003  |

  Escenario: Listar compañías
    Dado estoy en la página del escritorio
    Cuando presiono "Listar" cerca de "Compañía"
    Entonces debo estar en la página de listado de compañías
    Y debo ver "3 resultados"

  Esquema del escenario: Buscar compañías
    Dado estoy en la página de listado de compañías
    Cuando relleno "Nombre" con "<nombre>"
    Y presiono "Filtrar"
    Entonces debo estar en la página de listado de compañías
    Y debo ver "<resultados>"

    Ejemplos:
      | nombre      | resultados        |
      | Compañía    | 3 resultados      |
      | Compañía B  | 1 resultado       |
      | Compañía D  | No hay resultados |

  Esquema del escenario: Buscar nif
    Dado estoy en la página de listado de compañías
    Cuando relleno "NIF" con "<nif>"
    Y presiono "Filtrar"
    Entonces debo estar en la página de listado de compañías
    Y debo ver "<resultados>"

    Ejemplos:
    | nif       | resultados        |
    | A         | 3 resultados      |
    | A00000001 | 1 resultado       |
    | 4         | No hay resultados |

  Escenario: Crear nueva compañía
    Dado estoy en la página de creación de compañías
    Cuando relleno lo siguiente:
      | Nombre  | Compañia A11  |
      | NIF     | A10000001     |
    Y presiono "Crear y regresar al listado"
    Entonces debo estar en la página de listado de compañías
    Y debo ver "Elemento creado satisfactoriamente"
    Y debo ver "Compañia A11"

  Escenario: Acceder al formulario de edición de Compañía desde el listado de compañías
    Dado estoy en la página de listado de compañías
    Cuando presiono "Editar" cerca de "Compañía B"
    Entonces debería estar en la página edición de compañia con "name" denominado "Compañia B"

  Escenario: Actualizar compañía
    Dado estoy en la página de listado de compañías
    Y presiono "Editar" cerca de "Compañía A"
    Y debería estar en la página edición de compañia con "name" denominado "Compañia A"
    Cuando relleno "Telefono" con "957480317"
    Y presiono "Actualizar"
    Entonces debería estar en la página edición de compañia con "name" denominado "Compañia A"
    Y debo ver "Elemento actualizado satisfactoriamente."
    Y el campo "Telefono" debe contener "957480317"

  Escenario: Borrar compañía desde la página de edición
    Dado estoy en la página de listado de compañías
    Y presiono "Editar" cerca de "Compañía A"
    Y debería estar en la página edición de compañia con "name" denominado "Compañia A"
    Cuando sigo "Borrar"
    Entonces debo ver "¿Está seguro de que quiere borrar el elemento seleccionado"
    Cuando presiono "Sí, borrar"
    Entonces debo estar en la página de listado de compañías
    Y debo ver "Elemento eliminado satisfactoriamente."

  Escenario: Borrar organización desde el listado
    Dado estoy en la página de listado de compañías
    Cuando presiono "Borrar" cerca de "Compañía A"
    Entonces debo ver "¿Está seguro de que quiere borrar el elemento seleccionado"
    Cuando presiono "Sí, borrar"
    Entonces debo estar en la página de listado de compañías
    Y debo ver "Elemento eliminado satisfactoriamente."
    Pero no debo ver "Compañía A"
