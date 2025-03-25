<?php

require_once __DIR__ . "/BAD_REQUEST.php";
require_once __DIR__ . "/ProblemDetails.php";

function validaTitulo(false|string $titulo)
{

 if ($titulo === false)
  throw new ProblemDetails(
   status: BAD_REQUEST,
   title: "Falta el título.",
   type: "/error/faltatitulo.html",
   detail: "La solicitud no tiene el valor de título."
  );

 $trimTitulo = trim($titulo);

 if ($trimTitulo === "")
  throw new ProblemDetails(
   status: BAD_REQUEST,
   title: "Título en blanco.",
   type: "/error/tituloenblanco.html",
   detail: "Pon texto en el campo título.",
  );

 return $trimTitulo;
}

function validaAutor(false|string $autor)
{

 if ($autor === false)
  throw new ProblemDetails(
   status: BAD_REQUEST,
   title: "Falta el autor.",
   type: "/error/faltaautor.html",
   detail: "La solicitud no tiene el valor de autor."
  );

 $trimAutor = trim($autor);

 if ($trimAutor === "")
  throw new ProblemDetails(
   status: BAD_REQUEST,
   title: "Autor en blanco.",
   type: "/error/autorenblanco.html",
   detail: "Pon texto en el campo autor.",
  );

 return $trimAutor;
}

function validaIsbn(false|string $isbn)
{

 if ($isbn === false)
  throw new ProblemDetails(
   status: BAD_REQUEST,
   title: "Falta el isbn.",
   type: "/error/faltaisbn.html",
   detail: "La solicitud no tiene el valor de isbn."
  );

 $trimIsbn = trim($isbn);

 if ($trimIsbn === "")
  throw new ProblemDetails(
   status: BAD_REQUEST,
   title: "Isbn en blanco.",
   type: "/error/isbnenblanco.html",
   detail: "Pon texto en el campo isbn.",
  );

 return $trimIsbn;
}

function validaEditorial(false|string $editorial)
{

 if ($editorial === false)
  throw new ProblemDetails(
   status: BAD_REQUEST,
   title: "Falta la editorial.",
   type: "/error/faltaeditorial.html",
   detail: "La solicitud no tiene el valor de editorial."
  );

 $trimeditorial = trim($editorial);

 if ($trimeditorial === "")
  throw new ProblemDetails(
   status: BAD_REQUEST,
   title: "Editorial en blanco.",
   type: "/error/editorialenblanco.html",
   detail: "Pon texto en el campo editorial.",
  );

 return $trimeditorial;
}