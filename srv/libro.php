<?php

require_once __DIR__ . "/../lib/php/NOT_FOUND.php";
require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaIdEntero.php";
require_once __DIR__ . "/../lib/php/selectFirst.php";
require_once __DIR__ . "/../lib/php/ProblemDetails.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_LIBRO.php";

ejecutaServicio(function () {

 $id = recuperaIdEntero("id");

 $modelo =
  selectFirst(pdo: Bd::pdo(),  from: LIBRO,  where: [LIB_ID => $id]);

 if ($modelo === false) {
  $idHtml = htmlentities($id);
  throw new ProblemDetails(
   status: NOT_FOUND,
   title: "Libro no encontrado.",
   type: "/error/libronoencontrado.html",
   detail: "No se encontró ningún libro con el id $idHtml.",
  );
 }

 devuelveJson([
  "id" => ["value" => $id],
  "titulo" => ["value" => $modelo[LIB_TITULO]],
  "autor" => ["value" => $modelo[LIB_AUTOR]],
  "isbn" => ["value" => $modelo[LIB_ISBN]],
  "editorial" => ["value" => $modelo[LIB_EDITORAL]],
 ]);
});