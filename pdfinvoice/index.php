<?php
error_reporting(E_ALL);
include "vendor/autoload.php";
$responder = new \PdfInvoice\Responder();
$responder->dispatch();
