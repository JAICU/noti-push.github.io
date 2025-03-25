<?php

require_once __DIR__ . "/BAD_REQUEST.php";
require_once __DIR__ . "/ProblemDetails.php";

function validaJson($objeto)
{

 if ($objeto === null)
  throw new ProblemDetails(
   status: BAD_REQUEST,
   title: "Los datos recibidos no son JSON.",
   type: "/error/datosnojson.html",
   detail: "Los datos recibidos no están en formato JSON.O",
  );

 return $objeto;
}
