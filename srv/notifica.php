<?php

require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once  __DIR__ . "/../lib/php/select.php";
require_once  __DIR__ . "/../lib/php/devuelveJson.php";
require_once  __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_SUSCRIPCION.php";
require_once __DIR__ . "/Suscripcion.php";
require_once __DIR__ . "/suscripcionElimina.php";

use Minishlink\WebPush\WebPush;

const AUTH = [
 "VAPID" => [
  "subject" => "https://notificacionesphp.gilbertopachec2.repl.co/",
  "publicKey" => "BMBlr6YznhYMX3NgcWIDRxZXs0sh7tCv7_YCsWcww0ZCv9WGg-tRCXfMEHTiBPCksSqeve1twlbmVAZFv7GSuj0",
  "privateKey" => "vplfkITvu0cwHqzK9Kj-DYStbCH_9AhGx9LqMyaeI6w"
 ]
];

ejecutaServicio(function () {
  $input = file_get_contents("php://input");
  $datos = json_decode($input, true);


  if (!isset($datos["mensaje"])) {
    devuelveJson(["error" => "No se recibió el mensaje"]);
    return;
  }

 

  $mensaje = $datos["mensaje"];

  $webPush = new WebPush(AUTH);
  $pdo = Bd::pdo();

  $suscripciones = select(
    pdo: $pdo,
    from: SUSCRIPCION,
    mode: PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,
    opcional: Suscripcion::class
  );

  foreach ($suscripciones as $suscripcion) {
    $webPush->queueNotification($suscripcion, $mensaje);
  }
 
  $reportes = $webPush->flush();

  $reporteDeEnvios = "";
  foreach ($reportes as $reporte) {
    $endpoint = htmlentities($reporte->getRequest()->getUri());
    if ($reporte->isSuccess()) {
      $reporteDeEnvios .= "<dt>$endpoint</dt><dd>Éxito</dd>";
    } else {
      if ($reporte->isSubscriptionExpired()) {
        suscripcionElimina($pdo, $reporte->getRequest()->getUri());
      }
      $explicacion = htmlentities($reporte->getReason());
      $reporteDeEnvios .= "<dt>$endpoint</dt><dd>Fallo: $explicacion</dd>";
    }
  } 

  devuelveJson(["reporte" => ["innerHTML" => "Respuesta del Servidor"]]);
});
