<?php
/* * Diseño y programación Ignacio Florido
 * iflorido@gmail.com  671637940
 * 
 */
require_once('config.php');

class ServicioMovimiento{
 
private $bd;//PERMITE CONECTAR CON LA BASE DE DATOS
    
    function  __construct() {
        
        //$this->bd = new conexion("localhost","optima","Optima_123456","optima");
        //$this->bd = new conexion($host,$usuario,$password,$database);
        $this->bd = new conexion($GLOBALS['host'],
        $GLOBALS['usuario'],
        $GLOBALS['password'],
        $GLOBALS['database']);
        
        
        
       // $this->bd = new conexion($database,$host,$usuario,$password);
    } 
    function ingresar($ingreso){ 
        // Conectar a la base de datos
        $this->bd->Conectar(); 
        $this->bd->Query("INSERT INTO movimientos (tipo,cantidad,saldo,concepto) VALUES ('$ingreso->tipo','$ingreso->cantidad', '$ingreso->saldo', '$ingreso->concepto')"); 
        $this->bd->Desconectar(); 
    }
    function retirar($retirado){ 
        // Conectar a la base de datos
        $this->bd->Conectar(); 
        $this->bd->Query("INSERT INTO movimientos (tipo,cantidad,saldo,concepto) VALUES ('$retirado->tipo','$retirado->cantidad', '$retirado->saldo', '$retirado->concepto')");   
        $this->bd->Desconectar(); 
    }
    
    function listarmovimientos(){
        
        $this->bd->Conectar();
       
        $resultado=$this->bd->QueryListar("SELECT * FROM movimientos order by fecha DESC");
       
        $arraymovimientos = array();
        foreach ($resultado as $movimiento) {
                $movimientos = new Operacion($movimiento->id,$movimiento->tipo,$movimiento->fecha,$movimiento->cantidad,$movimiento->saldo,$movimiento->concepto);
                $arraymovimientos[] = $movimientos;
            
                }
        $this->bd->Desconectar();
        return $arraymovimientos;
    }
	
	
    function imprimirmovimmientos($array){        
       	foreach ($array as $movimientos){
            	$r .= '<tr>';
                $r .= '<td>'.$movimientos->tipo.'</td>';
                $r .= '<td>'.$movimientos->fecha.'</td>';
                $r .= '<td>'.$movimientos->cantidad.'</td>';
                $r .= '<td>'.$movimientos->saldo.'</td>';
                $r .= '<td>'.$movimientos->concepto.'</td>';
                $r .= '</tr>';
             }
        return $r;
    }
    function saldo(){
        $this->bd->Conectar();
        $saldo=$this->bd->QueryListar("SELECT * FROM movimientos order by id DESC limit 1");
        $saldo = $saldo[0]->saldo;
        return $saldo;
            
    }
}
?>