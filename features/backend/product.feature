#language: es
@product

Característica: Lista productos
  Para llevar la gestión de los productos de las marcas que gestiono
  Como administrador de la aplicación
  Quiero poder gestionar el catálogo de compañías
  Quiero poder gestionar el catálogo de marcas
  Quiero poder gestionar el catálogo de códigos de barras
  Quiero poder gestionar el catálogo de productos

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
  Y existen los siguientes productos:
  | codigo  | descripcion   | descripcion completa  | historial           | numero UC | marca   | codigo UC     | codigo UV       |
  | A001    | 10x1 ESPAÑA   | PET 10x1L ESPAÑA      | 1L para España      | 10        | marca_1 | 1000001000015 | 10000010000158  |
  | B123    | 6x500 USA     | VID 6x500ml USA       | 500ml para USA      | 6         | marca_3 | 300000300019  | 13000003000032  |
  | B124    | 6x500 HOLANDA | VID 6x500ml HOLANDA   | 500ml para Holanda  | 6         | marca_3 | 3000003000028 | 13000003000032  |


  Escenario: Listar productos
    Dado estoy en la página del escritorio
    Cuando presiono "Listar" cerca de "Producto"
    Entonces debo estar en la página de listado de productos
    Y debo ver "3 resultados"

  Esquema del escenario: Buscar productos
    Dado estoy en la página de listado de productos
    Cuando relleno "Código" con "<codigo>"
    Y presiono "Filtrar"
    Entonces debo estar en la página de listado de productos
    Y debo ver "<resultados>"

    Ejemplos:
    | codigo  | resultados        |
    | B       | 2 resultados      |
    | 001     | 1 resultado       |
    | 0002    | No hay resultados |

  Esquema del escenario: Buscar productos asociados a una marca
    Dado estoy en la página de listado de productos
    Cuando selecciono "<marca>" de "Marca"
    Y presiono "Filtrar"
    Entonces debo estar en la página de listado de productos
    Y debo ver "<resultados>"

    Ejemplos:
    | marca   | resultados        |
    | marca_1 | 1 resultado       |
    | marca_2 | No hay resultados |
    | marca_3 | 2 resultado       |

  Escenario: Crear nuevo producto
    Dado estoy en la página de creación de productos
    Cuando relleno lo siguiente:
    | Código del producto                         | B003                              |
    | Descripción                                 | 6x500 ALEMANIA                    |
    | Descripción completa                        | VID 6x500ml ALEMANIA              |
    | Historíal de modificaciones                 | agrupacion 5x(10x1L) para España  |
    | Número de UC por Unidad de Venta            | 6                                 |

    Y selecciono "marca_3" de "Marca que corresponde"
    Y selecciono "3000003000028" de "Código de barras para la Unidad de Consumo"
    Y selecciono "23000003000046" de "Código de barras para la Unidad de Venta"
    Y presiono "Crear y regresar al listado"
    Entonces debo estar en la página de listado de productos
    Y debo ver "Elemento creado satisfactoriamente"
    Y debo ver "0002"

  Escenario: Acceder al formulario de edición de productos desde el listado de productos
    Dado estoy en la página de listado de productos
    Cuando presiono "Editar" cerca de "B123"
    Entonces debería estar en la página edición de productos con "code" denominado "B123"

  Escenario: Actualizar producto
    Dado estoy en la página de listado de productos
    Y presiono "Editar" cerca de "B124"
    Y debería estar en la página edición de productos con "code" denominado "B124"
    Cuando relleno "Descripción" con "VID 6x0.5 HOLANDA"
    Y presiono "Actualizar"
    Entonces debería estar en la página edición de productos con "code" denominado "B124"
    Y debo ver "Elemento actualizado satisfactoriamente."
    Y el campo "Descripción" debe contener "VID 6x0.5 HOLANDA"

  Escenario: Borrar producto desde la página de edición
    Dado estoy en la página de listado de productos
    Y presiono "Editar" cerca de "A001"
    Y debería estar en la página edición de productos con "code" denominado "A001"
    Cuando sigo "Borrar"
    Entonces debo ver "¿Está seguro de que quiere borrar el elemento seleccionado"
    Cuando presiono "Sí, borrar"
    Entonces debo estar en la página de listado de productos
    Y debo ver "Elemento eliminado satisfactoriamente."
    Pero no debo ver "A001"

  Escenario: Borrar producto desde el listado
    Dado estoy en la página de listado de productos
    Cuando presiono "Borrar" cerca de "A001"
    Entonces debo ver "¿Está seguro de que quiere borrar el elemento seleccionado"
    Cuando presiono "Sí, borrar"
    Entonces debo estar en la página de listado de productos
    Y debo ver "Elemento eliminado satisfactoriamente."
    Pero no debo ver "A001"
