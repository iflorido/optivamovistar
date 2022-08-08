<?php
class conexion {
     // en esta clase declararemos los metodos de algunas de las funciones de php y mysql
     private $ssql;
     private $usuario;
     private $host;
     private $database;
     private $password;
     private $conex;

     function  __construct($host,$usuario,$pasword,$database)
     {
         $this->host 	= $host;
         $this->usuario = $usuario;
         $this->password = $pasword;
         $this->database = $database;
         
         
     }

        function Conectar()
        {
        if($this->conex = new mysqli($this->host, $this->usuario, $this->password, $this->database)){}
        else{echo"error en conexión";}      
        }

        function Desconectar()
        {
            mysqli_close($this->conex);
        }
        
        function Query($query)
        {
            $consulta = $this->conex->query($query);
            //$consulta = mysql_query($query,$this->conex);            
        }    
      
        function QueryListar($query)
        {   
            if($this->conex){   
                $consulta=$this->conex->query($query);
                $resultado = array ();
                while ($data = $consulta->fetch_object()) {
                    $resultado[] = $data;
                }
            }
               return $resultado;
               
        }    
 }
?>