<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/select.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_LIBRO.php";

ejecutaServicio(function () {

 $lista = select(pdo: Bd::pdo(),  from: LIBRO,  orderBy: LIB_TITULO);

 $render = "";
 foreach ($lista as $modelo) {
  $encodeId = urlencode($modelo[LIB_ID]);
  $id = htmlentities($encodeId);
  $titulo = htmlentities($modelo[LIB_TITULO]);
  $autor = htmlentities($modelo[LIB_AUTOR]);
  $isbn = htmlentities($modelo[LIB_ISBN]);
  $editorial = htmlentities($modelo[LIB_EDITORAL]);
  $render .=
   " <li class='md-two-line image'>
   <img alt='Coyote de Neza' src='img/icono2048.png'>
           <a href='modifica.html?id=$id'> <span class='headline'>{$titulo} </span></a>
            <span class='supporting'>Autor: {$autor}, ISBN: {$isbn}, Editorial: {$editorial}</span>
         </li>
         ";
 }

 devuelveJson(["lista" => ["innerHTML" => $render]]);
});

// <p>
//       <a href='modifica.html?id=$id'>$nombre</a>
//      </p>