<?php
/* * Diseño y programación Ignacio Florido
 * iflorido@gmail.com  671637940
 *
 */
class Operacion{
    public $id;
    public $tipo;
    public $fecha;
    public $cantidad;
    public $saldo;
    public $concepto;
            

function  __construct($id=null,$tipo=null,$fecha=null,$cantidad=null,$saldo=null,$concepto=null) {
        $this->id = $id;
        $this->tipo = $tipo;
        $this->fecha = $fecha;
        $this->cantidad = $cantidad;
        $this->saldo = $saldo;
        $this->concepto = $concepto;
 } 	  
}


?>