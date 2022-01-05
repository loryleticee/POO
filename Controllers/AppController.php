<?php
namespace App\Controllers;

use App\Entity\Client;

$toto = new Client("titi","tutu");
print($toto->getNom());