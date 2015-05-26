#language: es
@barcode

Característica: Lista códigos de barras
  Para llevar la gestión de los códigos de barras de las marcas que gestiono sus productos
  Como administrador de la aplicación
  Quiero poder gestionar el catálogo de compañías
  Quiero poder gestionar el catálogo de marcas
  Quiero poder gestionar el catálogo de códigos de barras

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
  | nombre    | prefijo | prefijoUPC  | compañía    |
  | marca_1   | 1230001 |             | Compañía A  |
  | marca_11  | 1230011 |             | Compañía A  |
  | marca_2   | 1230002 | 123456      | Compañía C  |
  | marca_22  | 1230022 |             | Compañía C  |
  Y existen los siguientes códigos de barras:
  | tipo              | codigo          | marca     | comentario                        |
  | TYPECODE_GTIN_13  | 1230011000013   | marca_11  | Alta cod. EAN para marca marca_11 |
  | TYPECODE_GTIN_13  | 1230011000020   | marca_11  | Alta cod. EAN para marca marca_11 |
  | TYPECODE_GTIN_12  | 123456000018    | marca_2   | Alta cod. UPC para marca marca_2  |
  | TYPECODE_GTIN_13  | 1230002000022   | marca_2   | Alta cod. EAN para marca marca_2  |
  | TYPECODE_GTIN_14  | 51230002000034  | marca_2   | Alta cod. DUN para marca marca_2  |

  Escenario: Listar códigos de barras
    Dado estoy en la página del escritorio
    Cuando presiono "Listar" cerca de "Código de barras"
    Entonces debo estar en la página de listado de códigos de barras
    Y debo ver "5 resultados"

  Esquema del escenario: Buscar códigos de barras
    Dado estoy en la página de listado de códigos de barras
    Cuando relleno "Código" con "<codigo>"
    Y presiono "Filtrar"
    Entonces debo estar en la página de listado de códigos de barras
    Y debo ver "<resultados>"

    Ejemplos:
    | codigo        | resultados        |
    | 12300         | 4 resultados      |
    | 1230011000020 | 1 resultado       |
    | 123456789129  | No hay resultados |

  Esquema del escenario: Buscar códigos de barras asociados a una marca
    Dado estoy en la página de listado de códigos de barras
    Cuando selecciono "<marca>" de "Marca"
    Y presiono "Filtrar"
    Entonces debo estar en la página de listado de códigos de barras
    Y debo ver "<resultados>"

    Ejemplos:
    | marca     | resultados        |
    | marca_11  | 2 resultados      |
    | marca_2   | 3 resultado       |
    | marca_1   | No hay resultados |

  Escenario: Crear nuevo código de barras
    Dado estoy en la página de creación códigos de barras
    Cuando relleno lo siguiente:
    | Tipo                              | TYPECODE_GTIN_13                      |
    | código_base                       | 44444                                 |
    | Comentarios                       | Producto x, inicialmente código 4444  |
    Y selecciono "marca_22" de "Marca que corresponde este código"
    Y presiono "Crear y regresar al listado"
    Entonces debo estar en la página de listado de códigos de barras
    Y debo ver "Elemento creado satisfactoriamente"
    Y debo ver "1230022444448"

  @javascript
  Escenario: Acceder al formulario de edición de códigos de barras desde el listado de códigos de barras NO-CORRESPONDE
    Dado estoy en la página de listado de códigos de barras
    Cuando presiono "Editar" cerca de "123456789126"
    Entonces debería estar en la página edición de códigos de barras con "code" denominado "123456789126"

  Escenario: Actualizar código de barras NO-CORRESPONDE
    Dado estoy en la página de listado de códigos de barras
    Y presiono "Editar" cerca de "123456789125"
    Y debería estar en la página edición de códigos de barras con "code" denominado "123456789125"
    Cuando relleno "Código" con "222212222112"
    Y presiono "Actualizar"
    Entonces debería estar en la página edición de códigos de barras con "code" denominado "222212222112"
    Y debo ver "Elemento actualizado satisfactoriamente."
    Y el campo "Código" debe contener "222212222112"

  Escenario: Borrar código de barras desde la página de edición NO-CORRESPONDE
    Dado estoy en la página de listado de códigos de barras
    Y presiono "Editar" cerca de "1230002000022"
    Y debería estar en la página edición de códigos de barras con "code" denominado "1230002000022"
    Cuando sigo "Borrar"
    Entonces debo ver "¿Está seguro de que quiere borrar el elemento seleccionado"
    Cuando presiono "Sí, borrar"
    Entonces debo estar en la página de listado de códigos de barras
    Y debo ver "Elemento eliminado satisfactoriamente."

  Escenario: Borrar código de barras desde el listado
    Dado estoy en la página de listado de códigos de barras
    Cuando presiono "Borrar" cerca de "1230002000022"
    Entonces debo ver "¿Está seguro de que quiere borrar el elemento seleccionado"
    Cuando presiono "Sí, borrar"
    Entonces debo estar en la página de listado de códigos de barras
    Y debo ver "Elemento eliminado satisfactoriamente."
    Pero no debo ver "1230002000022"
