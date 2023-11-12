DROP DATABASE TodoList;
CREATE DATABASE TodoList;
USE TodoList;

CREATE TABLE Tareas(
    id INT AUTO_INCREMENT PRIMARY KEY,
    Titulo VARCHAR(50),
    Descripcion TEXT,
    Completado CHAR(2),
    Fecha_Vencimiento DATE
);