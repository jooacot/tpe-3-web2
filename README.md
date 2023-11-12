Miembro 1: Joaquin Troncoso (@joaquintroncoso2001).
Miebro 2: Juan Altamiranda Garralda (juanaltamiranda2003@hotmail.com).

La temática del tpe es una empresa de viajes a larga distancia.

**Listar todos los viajes**:

GET viajes

**Listar todos los viajes ordenados segun el campo seleccionado de manera ascendente o descendente**:

GET viajes?sort={CampoSeleccionado}&order=asc
GET viajes?sort={CampoSeleccionado}&order=desc

**Listar un viaje por su id**:

GET viajes/:id

**Agregar un viaje**:

POST viajes

campos necesarios: {"destino": varchar, "precio": int, "fecha_ida": varchar, "fecha_vuelta": varchar, "id_usuario": varchar}

**Editar un viaje**:

PUT viajes/:id

campos necesarios: {"destino": varchar, "precio": int, "fecha_ida": varchar, "fecha_vuelta": varchar, "id_usuario": varchar}

**Eliminar un viaje**:

DELETE viajes/:id

