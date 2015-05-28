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
    | nombre  | prefijo | prefijoUPC  | compañía    |
    | marca_1 | 1000001 |             | Compañía A  |
    | marca_2 | 2000002 |             | Compañía A  |
    | marca_3 | 3000003 | 123456      | Compañía C  |
    | marca_4 | 4000004 |             | Compañía C  |
  Y existen los siguientes códigos de barras:
    | tipo              | codigo          | marca     | comentario                      |
    | TYPECODE_GTIN_12  | 1000001000015   | marca_1 | Alta cod. EAN para marca marca_1  |
    | TYPECODE_GTIN_14  | 10000010000158  | marca_1 | Alta cod. EAN para marca marca_1  |
    | TYPECODE_GTIN_12  | 300000300019    | marca_3 | Alta cod. UPC para marca marca_3  |
    | TYPECODE_GTIN_13  | 3000003000028   | marca_3 | Alta cod. EAN para marca marca_3  |
    | TYPECODE_GTIN_14  | 13000003000032  | marca_3 | Alta cod. DUN para marca marca_3  |
    | TYPECODE_GTIN_14  | 23000003000046  | marca_3 | Alta cod. DUN para marca marca_3  |
    | TYPECODE_GTIN_14  | 94000004000012  | marca_4 | Alta cod. DUN para marca marca_3  |

  Escenario: Listar códigos de barras
    Dado estoy en la página del escritorio
    Cuando presiono "Listar" cerca de "Código de barras"
    Entonces debo estar en la página de listado de códigos de barras
    Y debo ver "7 resultados"

  Esquema del escenario: Buscar códigos de barras
    Dado estoy en la página de listado de códigos de barras
    Cuando relleno "Código" con "<codigo>"
    Y presiono "Filtrar"
    Entonces debo estar en la página de listado de códigos de barras
    Y debo ver "<resultados>"

    Ejemplos:
    | codigo          | resultados        |
    | 00300           | 4 resultados      |
    | 10000010000158  | 1 resultado       |
    | 123456789129    | No hay resultados |

  Esquema del escenario: Buscar códigos de barras asociados a una marca
    Dado estoy en la página de listado de códigos de barras
    Cuando selecciono "<marca>" de "Marca"
    Y presiono "Filtrar"
    Entonces debo estar en la página de listado de códigos de barras
    Y debo ver "<resultados>"

    Ejemplos:
    | marca     | resultados        |
    | marca_1   | 2 resultados      |
    | marca_2   | No hay resultados |
    | marca_3   | 4 resultados      |

  Escenario: Crear nuevo código de barras
    Dado estoy en la página de creación códigos de barras
    Cuando relleno lo siguiente:
      | Tipo                              | TYPECODE_GTIN_13                      |
      | código_base                       | 22222                                 |
      | Comentarios                       | Producto x, inicialmente código 4444  |
    Y selecciono "marca_2" de "Marca que corresponde este código"
    Y presiono "Crear y regresar al listado"
    Entonces debo estar en la página de listado de códigos de barras
    Y debo ver "Elemento creado satisfactoriamente"
    Y debo ver "2000002222224"

  @javascript
  Escenario: Acceder al formulario de edición de códigos de barras desde el listado de códigos de barras
    Dado estoy en la página de listado de códigos de barras
    Cuando presiono "Editar" cerca de "10000010000158"
    Entonces debería estar en la página edición de códigos de barras con "code" denominado "10000010000158"

  Escenario: Actualizar código de barras
    Dado estoy en la página de listado de códigos de barras
    Y presiono "Editar" cerca de "10000010000158"
    Y debería estar en la página edición de códigos de barras con "code" denominado "10000010000158"
    Cuando relleno "Comentarios" con "Prueba modificación de comentarios en 10000010000158"
    Y presiono "Actualizar"
    Entonces debería estar en la página edición de códigos de barras con "code" denominado "10000010000158"
    Y debo ver "Elemento actualizado satisfactoriamente."
    Y el campo "Comentarios" debe contener "Prueba modificación de comentarios en 10000010000158"

  Escenario: Borrar código de barras desde la página de edición NO-CORRESPONDE
    Dado estoy en la página de listado de códigos de barras
    Y presiono "Editar" cerca de "10000010000158"
    Y debería estar en la página edición de códigos de barras con "code" denominado "10000010000158"
    Cuando sigo "Borrar"
    Entonces debo ver "¿Está seguro de que quiere borrar el elemento seleccionado"
    Cuando presiono "Sí, borrar"
    Entonces debo estar en la página de listado de códigos de barras
    Y debo ver "Elemento eliminado satisfactoriamente."

  Escenario: Borrar código de barras desde el listado
    Dado estoy en la página de listado de códigos de barras
    Cuando presiono "Borrar" cerca de "10000010000158"
    Entonces debo ver "¿Está seguro de que quiere borrar el elemento seleccionado"
    Cuando presiono "Sí, borrar"
    Entonces debo estar en la página de listado de códigos de barras
    Y debo ver "Elemento eliminado satisfactoriamente."
    Pero no debo ver "10000010000158"
