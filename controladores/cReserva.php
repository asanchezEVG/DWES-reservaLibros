<?php

    Class Creserva {

        private $objMReservas;
        public $codCurso;
        public $mensajeEstado;
        public $precioTotal;

        public function __construct() {
            require_once 'modelo/mReserva.php';
            $this->objMReservas = new Mreserva();
        }

        public function cMostrarCurso () {
            $curso = $this->objMReservas->mMostrarCurso();
            return $curso;
        }

        private function cValidarDatosForm1 ($arrayPOST) {
            if(empty($arrayPOST['dni'])) {
                $this->mensajeEstado = 'No se ha rellenado el DNI';
                return false;
            }

            if(empty($arrayPOST['nombre'])) {
                $this->mensajeEstado = 'No se ha rellenado el nombre';
                return false;
            }

            if(!isset($arrayPOST['cursos'])) {
                $this->mensajeEstado = 'No se ha seleccionado el curso';
                return false;
            }

            return true;
        }

        /**
         * Primero validamos si los datos en el primer formulario vienen "rellenos"
         * Una vez que se han validado, obtenemos un array con los libros del curso que se ha seleccionado
         * Si no ha fallado, añadimos los libros al array "$_POST" que recogemos del formulario
         * Si falla, muestra el mensaje de error
         */
        public function cAniadirLibrosReserva ($arrayPOST) {
            if(!$this->cValidarDatosForm1($arrayPOST)) {
                return false;
            }

            $libros = $this->objMReservas->mObtenerLibros($arrayPOST['cursos']);

            if($libros) {
                $arrayPOST['libros'] = $libros;
            } else {
                $this->mensajeEstado = 'No hay libros para esta clase';
                return false;
            }

            return $arrayPOST;
        }

        public function cObtenerIdLibro ($libro) {
            $idLibro = $this->objMReservas->mObtenerIdLibro($libro);
            return $idLibro;
        }

        /**
         * Primero validamos si los datos del primer formulario son correctos (Evitando que nos hayan modificado el HTML con F12 cambiando el value)
         * Después, si son correctos, validamos que se haya elegido un libro al menos
         * Por último, calculamos el total de la reserva
         */
        public function cPrecioTotal ($arrayPOST) { // $arrayPOST guarda el array $arrayPOST donde la primera celda es un array de id's.
            if(!$this->cValidarDatosForm1($arrayPOST)) {
                return false;
            }

            if(!isset($arrayPOST['libro'])) {
                $this->mensajeEstado = 'No se ha seleccionado ningún libro';
                return false;
            }

            $total = $this->objMReservas->mPrecioTotal($arrayPOST['libro']);
            return $total;
        }

        public function cHacerReserva ($arrayPOST) { 
            if(!$this->cValidarDatosForm1($arrayPOST)) {
                return false;
            }

            // Pasamos de un string a un array con los id's de los libros
            $libros = explode('#', $arrayPOST['libro']);
            $arrayPOST['libro'] = $libros;

            /**
             * -----------------------------------------------FALTA VALIDAR ERRORES--------------------------------------------------------
             */
            
            // No tenemos en cuenta el padre ya que este es el usuario que se registra en la aplicación
            $estado = $this->objMReservas->mAltaReserva($arrayPOST);
            return $estado;
        }
    }
?>
