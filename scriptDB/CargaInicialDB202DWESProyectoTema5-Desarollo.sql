/*Usamos la base de datos DAW202DBDepartamentos*/

use DB202DWESProyectoTema5; 

/*insert datos en la tabla departamento*/

INSERT INTO T02_Departamento(T02_CodDepartamento,T02_DescDepartamento,T02_FechaCreacionDepartamento,T02_VolumenNegocio) VALUES 
('FOL', 'departamento FOL', 1406149672, 102.4),
('DAW', 'departamento DAW', 1406149672, 1000.3),
('DIW', 'departamento DIW', 1406149672, 289.3);

/*insert datos en la tabla usuarios*/

INSERT INTO T01_Usuario(T01_CodUsuario,T01_Password,T01_DescUsuario)  VALUES 
('outmane', sha2('outmanepaso',256), "Desc1"),
('heraclio', sha2('heracliopaso',256), "Desc2"),
('Ob2', sha2('Ob2paso',256), "Desc3");
