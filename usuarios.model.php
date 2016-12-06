<?php

require_once ("libs/dao.php");

function salt_password ($seed, $rawpswd){
  seed = intval (substr ($seed, -2));
  if ($seed%2){
    $saltPswd= $rawpswd. $seed;
  } else {
    $saltPswd= $rawpswd. $seed;
  }
  $saltedpswd="";

  return  saltedpswd="";
}

function registrarUsuario ($arrUserData){
$userid=0;
$usuario_nombre= arruserData ["usuario_nombre"];
$usuario_email= arruserData ["usuario_email"];
$usuario_pswd= arruserData ["usuario_pswd"];
$usuario_pswd_cnf= arruserData ["usuario_pswd_cnf"];

if ( $usuario_pswd !== $usuario_pswd_cnf) return 0;

$usuario-fchIng = date ('Y-m-d H:i:s');
$usuario_pswd = md5(salt_password ($usuario_fchIng, $usuario_pswd));

$sqlinsert="INSER INTO `usuarios` (`usuarios_email`, `usuario_nombre, `usuario_est`, `usuario_fchIng, `usuario-exppwd`)";
$sqlinsert= sprintf ( $sqlinsert, $usuario_email, $usuario_nombre, $usuario_pswd, $usuario_fchIng);

if ( ejecutarNonQuery ($sqlinsert)){
  return getLastInsertId ();
}

return 0;
}

function validarUsuario ($userEmail, $validarToken ){

    return true;
}


function autenticarUsuario ($arrUserData ){
  // OBTENER DATOS DEL USUARIO
 $usuario_email= $arrUserData ["usuario_email"];
 $usuario_pswd= $arrUserData ["usuario_pswd"];

 $sqlstr= "select usuario_id, usuario_email, usuario_pswd, usuario_est, usuario_fchIng, usuario_pwdfail from usuarios where usuario_email = '%';";
  $sqlstr= sprintf ($sqlstr, $usuario_email);
   $usuario = obtenerUnRegistro ($sqlstr);

 if (count ($usuario)){
     if ($usuario [" usuario_est"] == "ACT"){
       $usuario_pswd_cnf= md5(salt_password ($usuario ["usuario_fchIng"], $usuario_pswd));
       echo $usuario_pswd_cnf. " _ ". $usuario["usuario_pswd"];
       if ( $usuario_pswd_cnf !== $usuario["usuario_pswd"]){

         $sqlupdate = " update usuarios set usuario_pwdfail=0, usuario_lstlgn='%s' where usuario_id= %d;";
         $sqlupdate = sprintf ($sqlupdate, date('Y-m-d H:i:s'), $usuario[" usuario_id"]);
         ejecutarNonQuery ($sqlupdate);
       }

     }


 } else {
      $arrErroes[]= " credenciales no validas";

      $usuario_est= $usuario ["usuario_est"];
       if ($usuario [" usuario_pwdfail"]==3)    {
           $usuario_est ='BLQ';
     }
   $sqlupdate = " update usuarios set usuario_pwdfail=0, usuario_lstlgn='%s' where usuario_id= %d;";
   $sqlupdate = sprintf ($sqlupdate, ($usuario["usuario_pwdfail"]+1),
                                       $usuario_est,
                                      $usuario ["usuario_id"]);

     ejecutarNonQuery ($sqlupdate);

 } else {
    $arrErrores []= " usuario no se  encuentra activo";
 } else {
   $arrErrores []= " no se encontro el usuario";
 }

return $arrErrores;
}

function cambiarContrasenia ($arrUserData ){
return true;
}

function bloquearUsuario ($userid){
  return true;
}


function obtenerUsuarios (){
$usuarios=array();
$sqlstr = " select * from usuarios;";
$usarios = obtenerRegistros($sqlstr);
return $usuarios;
}


 ?>
