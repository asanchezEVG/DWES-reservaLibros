<?php

    Class Mreserva {

        private $conexion;

        public function __construct() {

            require_once 'config/configDb.php';

            $this->conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD); // Conecta con la base de datos
            $this->conexion->set_charset("utf8"); // Usa juego caracteres UTF8
            $controlador = new mysqli_driver(); // Desactivar errores
            $controlador->report_mode = MYSQLI_REPORT_OFF; // Desactivar errores
            $texto_error=$this->conexion->errno;
        }

        public function mHacerReserva ($nombreAlumno, $fechaReserva, $fechaEntrega, $justificantePago, $tipoUsuario, $dni, $idUsuario, $idAdmin, $codCurso, $idLibro) { 
            

        }

        public function mMostrarCurso () {
            $sql = "SELECT codCurso, nombreCurso FROM cursos"; 
            $resultado = $this->conexion->query($sql);
        
            if ($resultado->num_rows > 0) {
                $cursos = []; // Crear un array para almacenar los cursos
                while ($fila = $resultado->fetch_assoc()) {
                    $cursos[] = $fila; // Almacenar cada curso en el array
                }
                return $cursos;
            } else {
                return false;
            }
            $this->conexion->close();
        }

        public function mObtenerLibros ($codCurso) {
            $sql = "SELECT libros.idLibro, libros.titulo, libros.precio 
                FROM libros
                INNER JOIN cursosLibros ON libros.idLibro = cursosLibros.idLibro
                WHERE cursosLibros.codCurso = '$codCurso';";

            $resultado = $this->conexion->query($sql);

            if ($resultado->num_rows > 0) {
                $libros = []; // Crear un array para almacenar los libros
                while ($fila = $resultado->fetch_assoc()) {
                    $libros[] = $fila; // Almacenar cada libro en el array
                }
                return $libros;
            } else {
                return false;
            }
            $this->conexion->close();
        }

        public function mObtenerIdLibro ($libro) {
            $sql = "SELECT idLibro FROM libros WHERE titulo = '$libro'";
            $resultado = $this->conexion->query($sql);
            $idLibro = $resultado->fetch_assoc();
            return $idLibro['idLibro'];
            $this->conexion->close();
        }

        // public function mPrecioTotal($arrayidLibros) {
        //     $total = 0;
        //     foreach ($arrayidLibros as $idLibro) {
        //         $sql = "SELECT precio
        //                 FROM libros
        //                 WHERE idLibro = $idLibro;";
        //         $resultado = $this->conexion->query($sql);
        //         $arrasyAsociativoPrecio = $resultado->fetch_assoc();
        //         $total = $total + $arrasyAsociativoPrecio['precio'];
        //     }
        //     return $total;
        // }        

        public function mPrecioTotal($arrayidLibros) {
            // $ids = implode(',', array_map('intval', $arrayidLibros));
            $ids = implode(',', $arrayidLibros);
            
            $sql = "SELECT SUM(precio) AS total
                    FROM libros
                    WHERE idLibro IN ($ids);";
            
            $resultado = $this->conexion->query($sql);
            $fila = $resultado->fetch_assoc();
            
            return $fila['total']; // Devuelve el total o 0 si no hay resultados
        }

        public function mAltaReserva ($datosReserva) {
            $nombreAlumno = $datosReserva['nombre'];
            $dniAlumno = $datosReserva['dni'];
            $cursoAlumno = $datosReserva['cursos'];
            $fechaReserva = date(format: 'Y-m-d');
            $justificantePago = $datosReserva['justificante']; // FALTA GUARDAR EL ARCHIVO

            $sql = 'INSERT INTO reservas (nombreAlumno, fechaReserva, justificantePago, tipoUsuario, dni, codCurso) 
            VALUES ("' . $nombreAlumno . '", "' . $fechaReserva . '", "' . $justificantePago . '", "usr", "' . $dniAlumno . '", "' . $cursoAlumno . '")';

            $this->conexion->query($sql);

            $idReserva = $this->conexion->insert_id;

            return $this->mAsignarLibrosReserva($idReserva, $datosReserva['libro']);
            // Hacer los inserts en la tabla reservaLibros
        }
        
        public function mAsignarLibrosReserva ($idReserva, $arrayidLibros) {
            $sql = 'INSERT INTO reservas_libros (idReserva, idLibro, estado) VALUES ';
            // Por cada libro metemos los datos necesarios
            foreach($arrayidLibros as $idLibro) {
                $datos = "($idReserva, $idLibro, 'P'),";
                $sql = $sql . $datos; // Concatenamos el INSERT INTO hasta VALUES con los datos de cada reserva
            }

            $sql = substr($sql, 0, -1); // Quitamos la última coma del INSERT

            $this->conexion->query($sql); // Sería bueno try catch para capturar errores de las consultas sql

            if($this->conexion->affected_rows > 0) 
                return true;
            return false;
        }
    }
?>