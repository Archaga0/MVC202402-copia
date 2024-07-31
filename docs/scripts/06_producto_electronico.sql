CREATE TABLE Productos (
    ID_Producto INT AUTO_INCREMENT PRIMARY KEY,
    Nombre_Producto VARCHAR(100) NOT NULL,
    Categoría VARCHAR(50) NOT NULL,
    Marca VARCHAR(50) NOT NULL,
    Modelo VARCHAR(50) NOT NULL,
    Descripción TEXT,
    Precio DECIMAL(10, 2) NOT NULL,
    Cantidad_Disponible INT NOT NULL,
    Proveedor VARCHAR(100),
    Fecha_Adquisición DATE,
    Estado_Producto ENUM('Nuevo', 'Usado', 'Reacondicionado') DEFAULT 'Nuevo',
    Imagenes_Producto VARCHAR(255),
    Garantía VARCHAR(50)
);