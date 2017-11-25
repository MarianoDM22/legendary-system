create database cerveceria;
use cerveceria;
CREATE TABLE clientes(
id_cliente int auto_increment not null,
apellido varchar(30),
domicilio varchar(30),
nombre varchar(30),
telefono varchar(30),
constraint pk_cliente primary key(id_cliente)
);
CREATE TABLE tiposdecervezas(
id_tipodecerveza int auto_increment not null,
descripcion varchar(30),
precio_litro int,
imagen longblob,
constraint pk_tipodecerveza primary key(id_tipodecerveza)
);
CREATE TABLE productos(
id_producto int auto_increment not null,
descripcion varchar(30),
fk_tipodecerveza int not null,
capacidad float(4,2),
factor float(3,2),
precio int,
imagen longblob,
constraint pk_producto primary key(id_producto),
constraint fk_producto foreign key(fk_tipodecerveza) references tiposdecervezas(id_tipodecerveza)
);
CREATE TABLE sucursales(
id_sucursal int auto_increment not null,
nombre varchar(30),
domicilio varchar(100),
latitud int,
longitud int,
constraint pk_sucursal primary key(id_sucursal)
);
CREATE TABLE envios(
id_envio int auto_increment not null,
domicilio varchar(100),
email varchar(100),
fecha_programada varchar(10),
hora_desde varchar(5),
hora_hasta varchar(5),
telefono varchar(30),
constraint pk_envio primary key(id_envio)
);
CREATE TABLE pedidos(
id_pedido int auto_increment not null,
estado varchar(30),
fecha varchar(10),
fk_cliente int not null,
fk_envio int not null,
fk_sucursal int,
constraint pk_pedido primary key(id_pedido),
constraint fk_pedido_cliente foreign key(fk_cliente) references clientes(id_cliente),
constraint fk_pedido_envio foreign key(fk_envio) references envios(id_envio),
constraint fk_pedido_sucursal foreign key(fk_sucursal) references sucursales(id_sucursal)
);
CREATE TABLE lineasdepedido(
id_lineadepedido int auto_increment not null,
cantidad int,
importe int,
fk_producto int not null,
fk_pedido int ,
constraint pk_lineadepedido primary key(id_lineadepedido),
constraint fk_lineadepedido_pedido foreign key(fk_pedido) references pedidos(id_pedido),
constraint fk_lineadepedido_producto foreign key(fk_producto) references productos(id_producto)
);
CREATE TABLE cuentas(
id_cuenta int auto_increment not null,
email varchar(100),
pass varchar(100),
rol varchar(10),
fk_cliente int,
constraint pk_cuenta primary key(id_cuenta),
constraint fk_cuenta_cliente foreign key(fk_cliente) references clientes(id_cliente),
constraint unq_cuenta_email unique (email)
);
CREATE TABLE contacto(
id_contacto int auto_increment not null,
email varchar(100),
telefono varchar(100),
mensaje varchar(150),
primary key(id_contacto)
);

INSERT into cuentas (email,pass,rol) VALUES ('admin@mdp','1234' , 'adm');
INSERT into cuentas (email,pass,rol) VALUES ('nico@hot.com','a' , 'cliente');