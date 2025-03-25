<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaIdEntero.php";
require_once __DIR__ . "/../lib/php/recuperaTexto.php";
require_once __DIR__ . "/../lib/php/validaNombre.php";
require_once __DIR__ . "/../lib/php/update.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_LIBRO.php";

ejecutaServicio(function () {

 $id = recuperaIdEntero("id");
 $titulo = recuperaTexto("titulo");
 $autor = recuperaTexto("autor");
 $isbn= recuperaTexto("isbn");
 $editorial = recuperaTexto("editorial");

 $titulo = validaTitulo($titulo);
 $autor = validaAutor($autor);
 $isbn = validaIsbn($isbn);
 $editorial = validaEditorial($editorial);

 update(
  pdo: Bd::pdo(),
  table: LIBRO,
  set: [LIB_TITULO => $titulo, LIB_AUTOR => $autor, LIB_ISBN => $isbn, LIB_EDITORAL => $editorial],
  where: [LIB_ID => $id]
 );

 devuelveJson([
  "id" => ["value" => $id],
  "titulo" => ["value" => $titulo],
  "autor" => ["value" => $autor],
  "isbn" => ["value" => $isbn],
  "editorial" => ["value" => $editorial],
 ]);
});