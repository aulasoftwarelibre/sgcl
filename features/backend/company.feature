#language: es
@company

Característica: Lista compañías
  Para llevar la gestión de compañías de las que gestiono sus productos
  Como administrador de la aplicación
  Quiero poder gestionar el catálogo de compañías

  Antecedentes:
    Dado existen los siguientes usuarios:
      | nombre    | clave     | email                 | activado  | rol         |
      | admin     | adminpw   | admin@latejedora.com  | 1         | ROLE_ADMIN  |
    Y estoy conectado como usuario "admin" y contraseña "adminpw"
    Y existen las siguientes compañías:
      | nombre      | cif       |
      | Compañía A  | A0000001  |
      | Compañía B  | A0000002  |
      | Compañía C  | A0000003  |

  Escenario: Listar compañías
    Dado estoy en la página del escritorio
    Cuando presiono "Listar" cerca de "Company"
    Entonces debo estar en la página de listado de compañías
    Y debo ver "3 resultados"

  Esquema del escenario: Buscar compañías
    Dado estoy en la página de listado de compañías
    Cuando relleno "Name" con "<nombre>"
    Y presiono "Filtrar"
    Entonces debo estar en la página de listado de compañías
    Y debo ver "<resultados>"

    Ejemplos:
      | nombre      | resultados        |
      | Compañía    | 3 resultados      |
      | Compañía B  | 1 resultado       |
      | Compañía D  | No hay resultados |