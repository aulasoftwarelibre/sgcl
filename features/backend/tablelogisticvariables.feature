#language: es
@tablelogisticvariables

Característica: Lista variables logísticas
  Para llevar la gestión de las variables logísticas de las marcas que gestiono sus productos
  Como administrador de la aplicación
  Quiero poder gestionar el catálogo de compañías
  Quiero poder gestionar el catálogo de marcas
  Quiero poder gestionar el catálogo de tablas de variables logísticas

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
  Y existen las siguientes marcas:
  | nombre  | prefijo | prefijoUPC  | compañía    |
  | marca_1 | 1000001 |             | Compañía A  |
  | marca_2 | 2000002 | 123456      | Compañía C  |
  | marca_3 | 3000003 |             | Compañía A  |
  | marca_4 | 4000004 |             | Compañía C  |
  Y existen las siguientes variables logísticas:
  | indicador_logístico | descripcion                       | marca   |
  | 1                   | Diez UC por agrupación            | marca_1 |
  | 3                   | Tres UC por agrupación            | marca_1 |
  | 5                   | Veinte UC por agrupación          | marca_1 |
  | 2                   | Agrupación en formato Expobandeja | marca_2 |
  | 3                   | Cinco UC por agrupación           | marca_2 |

  Escenario: Listar variables losgísticas
    Dado estoy en la página del escritorio
    Cuando presiono "Listar" cerca de "Tabla de variables logísticas"
    Entonces debo estar en la página de listado de variables logísticas
    Y debo ver "5 resultados"

  Esquema del escenario: Buscar variables logísticas
    Dado estoy en la página de listado de variables logísticas
    Cuando relleno "Dígito logístico" con "<indicador_logístico>"
    Y presiono "Filtrar"
    Entonces debo estar en la página de listado de variables logísticas
    Y debo ver "<resultados>"

    Ejemplos:
    | indicador_logístico | resultados        |
    | 2                   | 1 resultado       |
    | 3                   | 2 resultados      |
    | 4                   | No hay resultados |

  Esquema del escenario: Buscar variables logísticas asociadas a una marca
    Dado estoy en la página de listado de variables logísticas
    Cuando selecciono "<marca>" de "Marca"
    Y presiono "Filtrar"
    Entonces debo estar en la página de listado de variables logísticas
    Y debo ver "<resultados>"

    Ejemplos:
    | marca     | resultados        |
    | marca_1   | 3 resultados      |
    | marca_3   | No hay resultados |
    | marca_2   | 2 resultados      |

  Escenario: Crear un nuevo dígito logístico
    Dado estoy en la página de creación variables logísticas
    Cuando relleno lo siguiente:
    | Dígito logístico  | 2                       |
    | Descripción       | Doce UC por agrupación  |
    Y selecciono "marca_1" de "Marca que corresponde"
    Y presiono "Crear y regresar al listado"
    Entonces debo estar en la página de listado de variables logísticas
    Y debo ver "Elemento creado satisfactoriamente"
    Y debo ver "2"

  Escenario: Acceder al formulario de edición de variables logísticas desde el listado variables logísticas
    Dado estoy en la página de listado de variables logísticas
    Cuando presiono "Editar" cerca de "Veinte UC por agrupación"
    Entonces debería estar en la página edición de variables logísticas con "logisticIndicator" denominado "5"

  Escenario: Actualizar descripción de variable logística
    Dado estoy en la página de listado de variables logísticas
    Y presiono "Editar" cerca de "Tres UC por agrupación"
    Y debería estar en la página edición de variables logísticas con "logisticIndicator" denominado "3" y "description" denominada "Tres UC por agrupación"
    Cuando relleno "Descripción" con "Treinta UC por agrupación"
    Y presiono "Actualizar"
    Entonces debería estar en la página edición de variables logísticas con "logisticIndicator" denominado "3" y "description" denominada "Treinta UC por agrupación"
    Y debo ver "Elemento actualizado satisfactoriamente."
    Y el campo "Descripción" debe contener "Treinta UC por agrupación"

  Escenario: Borrar variable logística desde la página de edición
    Dado estoy en la página de listado de variables logísticas
    Y presiono "Editar" cerca de "Agrupación en formato Expobandeja"
    Y debería estar en la página edición de variables logísticas con "logisticIndicator" denominado "2" y "description" denominada "Agrupación en formato Expobandeja"
    Cuando sigo "Borrar"
    Entonces debo ver "¿Está seguro de que quiere borrar el elemento seleccionado"
    Cuando presiono "Sí, borrar"
    Entonces debo estar en la página de listado de variables logísticas
    Y debo ver "Elemento eliminado satisfactoriamente."

  Escenario: Borrar variable logística desde el listado
    Dado estoy en la página de listado de variables logísticas
    Cuando presiono "Borrar" cerca de "Veinte UC por agrupación"
    Entonces debo ver "¿Está seguro de que quiere borrar el elemento seleccionado"
    Cuando presiono "Sí, borrar"
    Entonces debo estar en la página de listado de variables logísticas
    Y debo ver "Elemento eliminado satisfactoriamente."
    Pero no debo ver "Veinte UC por agrupación"
