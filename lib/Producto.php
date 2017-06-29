<?php


class Producto {
    var $nombre;
    var $nombreImagen;
    var $ubicacionImagen;
    var $cantidad;
    var $id;
    
    function __construct($nom="",$cantidad ="",$nomImg="",$ubiImg=""){
        $this->nombre=$nom;
        $this->cantidad=$cantidad;
        $this->nombreImagen=$nomImg;
        $this->ubicacionImagen=$ubiImg;
    }
    
    function __construct2($nom=""){
        $this->nombre=$nom;   
    }
    
    function DevolverProductos(){
        if ($oConn->Conectar()) {
            $db = $oConn->objconn; 
        } else {return false;} 
        
        $sql="SELECT * FROM producto;";
        $db->query($sql);
        
        while($resultado = mysql_fetch_assoc($sql)) {
           $nombre=$resultado['nombre'];
           echo $nombre;
        }
    }
           
    function AgregarProducto(){
        $oConn=new Conexion();
        
        if ($oConn->Conectar()) {
            $db = $oConn->objconn; 
        } else {return false;}
        
        if ($this->VerificaProducto()){
            return false;   
        }  
        else if($this->nombreImagen !== "" && $this->ubicacionImagen !== "")
        {
            $sql="INSERT INTO producto (nombre,nombreImagen,ubicacionImagen) VALUES ('$this->nombre','$this->nombreImagen','$this->ubicacionImagen')";
            $db->query($sql);
            return true;
        }
        $sql="INSERT INTO producto (nombre) VALUES ('$this->nombre')";
        $db->query($sql);
        return true;
    }
    
    function EliminarProducto(Producto $producto){
        $oConn=new Conexion();
        
        if ($oConn->Conectar()) {
            $db = $oConn->objconn;
        } else {
            return false;
        }
        
        if($this->VerificaProducto())
        {    
            $sql="DELETE FROM producto WHERE nombre='$producto->nombre'";
            $db->query($sql);
            return true;
        }
        return false;       
    }
    
    function VerificaProducto(){
        $oConn=new Conexion();
        
        if ($oConn->Conectar()) {
            $db = $oConn->objconn;
        } else {
            return false;
        }

        $sql="SELECT * FROM producto WHERE nombre='$this->nombre'";
        
        $resultado=$db->query($sql);
               
        if ($resultado->num_rows >= 1) {
            return true;
        }
        return false;
    }
}
