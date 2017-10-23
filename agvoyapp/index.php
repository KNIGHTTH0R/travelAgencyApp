<?php

/**
<<<<<<< HEAD
 * Application d'exemple Agence de voyages Silex
 */

// Initialisations de l'autoloader et des bibliothèques composer
// require_once __DIR__.'/vendor/autoload.php';
// variante autorisant le déport de vendor via variable d'env. COMPOSER_VENDOR_DIR
$vendor_directory = getenv ( 'COMPOSER_VENDOR_DIR' );
if ($vendor_directory === false) {
  $vendor_directory = __DIR__ . '/vendor';
}
require_once $vendor_directory . '/autoload.php';

// Initialisations du framework Silex
$app = require_once 'initapp.php';

// Chargement du gestionnaire de la persistence du modèle dans la base de données
require_once 'agvoymodel.php';

// chargement des gestionnaires pour le front office
require_once 'frontoffice.php';
// chargement des gestionnaires pour le back office
require_once 'backoffice.php';

// Appel du framework
$app->run ();
