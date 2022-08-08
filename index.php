<?php
require_once('entidades/operacion.php');
require_once('entidades/smovimientos.php');
require_once('entidades/conexiones.php');

if (isset($_POST['ingreso'])) {
    
        $servicioMovimeinto = new ServicioMovimiento();
        $listaSaldo = $servicioMovimeinto->saldo();
        if (empty($listaSaldo)) {$listaSaldo = 0;}
        $saldo = ($listaSaldo) + ($_POST['cantidad']);
        
        //$saldo = $_POST['saldo'];
        
        $tipo = $_POST['tipo'];
        $cantidad = $_POST['cantidad'];
         
        $concepto = $_POST['concepto'];
        $movimientos = new Operacion($id,$tipo,$fecha,$cantidad,$saldo,$concepto);
        $servicioBanco = new ServicioMovimiento();
        $servicioBanco->ingresar($movimientos);
        
        }
 if (isset($_POST['retirar'])) {
        $tipo = $_POST['tipo'];
        $cantidad = $_POST['cantidad'];
        $servicioMovimeinto = new ServicioMovimiento();
        $listaSaldo = $servicioMovimeinto->saldo();
        if (empty($listaSaldo)) {$listaSaldo = 0;}
        $saldo = ($listaSaldo) + (-$_POST['cantidad']);
        $concepto = $_POST['concepto'];
        $movimientos = new Operacion($id,$tipo,$fecha,-$cantidad,$saldo,$concepto);
        $servicioBanco = new ServicioMovimiento();
        $servicioBanco->retirar($movimientos);
    }
?>