CREATE TABLE DatosVehiculos (
    id_vehiculo INT AUTO_INCREMENT PRIMARY KEY,
    marca VARCHAR(50) NOT NULL,
    modelo VARCHAR(50),
    año_fabricacion INT,
    tipo_combustible VARCHAR(20),
    kilometraje INT
);