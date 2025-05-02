create table m_departamento(
    id int primary key auto_increment not null,
    nombre varchar(50) not null
);

create table m_provincia(
    id int primary key auto_increment not null,
    id_depart int not null,
    nombre varchar(50) not null,
    FOREIGN KEY (id_depart) REFERENCES m_departamento(id)
);

create table m_distrito(
    id int primary key auto_increment not null,
    id_depart int not null,
    id_provin int not null,
    nombre varchar(50) not null,
    FOREIGN KEY (id_depart) REFERENCES m_departamento(id),
    FOREIGN KEY (id_provin) REFERENCES m_provincia(id)
);

create table m_tipo_propiedad(
    id int primary key auto_increment not null,
    nombre varchar(50) not null,
    estado char(1) not null
);

create table m_nosotros(
    id int primary key auto_increment not null,
    vision text,
    mision text,
    fec_crea date,
    usu_crea varchar(30),
    fec_actu date,
    usu_actu varchar(30)
);

create table m_nosotros_valores(
    id int primary key auto_increment not null,
    valor varchar(50) not null,
    descripcion text
);

create table m_independizacion(
    id int primary key auto_increment not null,
    descripcion text,
    fec_crea date,
    usu_crea varchar(30),
    fec_actu date,
    usu_actu varchar(30)
);

create table m_configuracion(
    id int primary key auto_increment not null,
    numero varchar(20),
    direccion varchar(250),
    longitud varchar(50),
    latitud varchar(50),
    fec_crea date,
    usu_crea varchar(30),
    fec_actu date,
    usu_actu varchar(30)
);

create table m_foto_slider(
    id int primary key auto_increment not null,
    foto blob not null,
    orden int not null,
    fec_crea date,
    usu_crea varchar(30)
);

create table m_usuario(
    id int primary key auto_increment not null,
    nombre varchar(100) not null,
    apellido varchar(100) not null,
    correo varchar(100),
    usuario varchar(30) not null,
    clave varchar(70) not null,
    estado char(1) not null,
    rol char(1) not null,
    foto blob not null,
    fec_crea date,
    usu_crea varchar(30),
    fec_actu date,
    usu_actu varchar(30)
);

create table m_miembro(
    id int primary key auto_increment not null,
    nombre varchar(100) not null,
    apellido varchar(100) not null,
    puesto varchar(100) not null,
    linkedin varchar(200),
    instagram varchar(200),
    correo varchar(100),
    foto blob not null,
    descrip text, 
    orden int not null,
    estado char(1) not null,
    fec_crea date,
    usu_crea varchar(30),
    fec_actu date,
    usu_actu varchar(30)
);

create table g_solicitud(
    id int primary key auto_increment not null,
    nombre varchar(100) not null,
    apellido varchar(100) not null,
    dni varchar(10) not null,
    telefono varchar(10) not null,
    modalidad char(1) not null,
    id_t_prop int not null,
    FOREIGN KEY (id_t_prop) REFERENCES m_tipo_propiedad(id),
    id_depart int not null,
    id_provin int not null,
    id_distri int not null,
    FOREIGN KEY (id_depart) REFERENCES m_departamento(id),
    FOREIGN KEY (id_provin) REFERENCES m_provincia(id),
    FOREIGN KEY (id_distri) REFERENCES m_distrito(id),
    detalle text,
    estado char(1) not null,
    fec_crea date,
    usu_crea varchar(30),
    fec_actu date,
    usu_actu varchar(30)
);

create table g_independizacion(
    id int primary key auto_increment not null,
    nombre varchar(250) not null,
    id_distri int not null,
    FOREIGN KEY (id_distri) REFERENCES m_distrito(id),
    area varchar(20) not null,
    estado char(1) not null,
    fec_crea date,
    usu_crea varchar(30),
    fec_actu date,
    usu_actu varchar(30)
);

create table g_independizacion_foto(
    id int primary key auto_increment not null,
    id_indep int not null,
    FOREIGN KEY (id_indep) REFERENCES g_independizacion(id),
    foto blob not null,
    orden int not null
);

create table g_proyec_arqui(
    id int primary key auto_increment not null,
    nombre varchar(250) not null,
    descrip text,
    npisos int not null,
    nbanos int not null,
    area varchar(20) not null,
    id_t_prop int not null,
    FOREIGN KEY (id_t_prop) REFERENCES m_tipo_propiedad(id),
    estado char(1) not null,
    fec_crea date,
    usu_crea varchar(30),
    fec_actu date,
    usu_actu varchar(30)
);

create table g_proyec_arqui_foto(
    id int primary key auto_increment not null,
    id_proyec int not null,
    FOREIGN KEY (id_proyec) REFERENCES g_proyec_arqui(id),
    foto blob not null,
    orden int not null
);

create table g_propi_venta(
    id int primary key auto_increment not null,
    nombre varchar(250) not null,
    descrip text,
    id_depart int not null,
    id_provin int not null,
    id_distri int not null,
    FOREIGN KEY (id_depart) REFERENCES m_departamento(id),
    FOREIGN KEY (id_provin) REFERENCES m_provincia(id),
    FOREIGN KEY (id_distri) REFERENCES m_distrito(id),
    direccion varchar(250) int not null,
    longitud varchar(50) int not null,
    latitud varchar(50) int not null,
    npisos int not null,
    ndormit int not null,
    nbanos int not null,
    ncochera int not null,
    ncocina int not null,
    nlavand int not null,
    id_t_prop int not null,
    FOREIGN KEY (id_t_prop) REFERENCES m_tipo_propiedad(id),
    precio decimal(10,2),
    modalidad char(1) int not null,
    antiguedad varchar(30) not null,
    estado_im char(1) not null,
    ubicacion varchar(50) not null,
    aocupada varchar(20) not null,
    aconstru varchar(20) not null,
    estado char(1) not null,
    fec_crea date,
    usu_crea varchar(30),
    fec_actu date,
    usu_actu varchar(30)
);

create table g_propi_venta_foto(
    id int primary key auto_increment not null,
    id_propi int not null,
    FOREIGN KEY (id_propi) REFERENCES g_propi_venta(id),
    foto blob not null,
    orden int not null
);