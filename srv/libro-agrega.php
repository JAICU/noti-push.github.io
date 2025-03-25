<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaTexto.php";
require_once __DIR__ . "/../lib/php/validaNombre.php";
require_once __DIR__ . "/../lib/php/insert.php";
require_once __DIR__ . "/../lib/php/devuelveCreated.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_LIBRO.php";

ejecutaServicio(function () {

    $titulo = recuperaTexto("titulo");
    $autor = recuperaTexto("autor");
    $isbn = recuperaTexto("isbn");
    $editorial = recuperaTexto("editorial");
   
    $titulo = validaTitulo($titulo);
    $autor = validaAutor($autor);
    $isbn = validaIsbn($isbn);
    $editorial = validaEditorial($editorial);
   

 $pdo = Bd::pdo();
 insert(pdo: $pdo, into: LIBRO, values: [LIB_TITULO => $titulo, LIB_AUTOR => $autor, LIB_ISBN => $isbn, LIB_EDITORAL => $editorial]);
 $id = $pdo->lastInsertId();

 $encodeId = urlencode($id);
 devuelveCreated("/srv/LIRBO.php?id=$encodeId", [
  "id" => ["value" => $id],
  "titulo" => ["value" => $titulo],
  "autor" => ["value" => $autor],
  "isbn" => ["value" => $isbn],
  "editorial" => ["value" => $editorial],
 ]);
});