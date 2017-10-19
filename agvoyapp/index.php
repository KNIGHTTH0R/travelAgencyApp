<?php

/**
 * Application d'exemple Agence de voyages Silex
 */

// require_once __DIR__.'/vendor/autoload.php';
$vendor_directory = getenv ( 'COMPOSER_VENDOR_DIR' );
if ($vendor_directory === false) {
	$vendor_directory = __DIR__ . '/vendor';
}
require_once $vendor_directory . '/autoload.php';

// Initialisations
$app = require_once 'initapp.php';

require_once 'agvoymodel.php';

// Routage et actions

// Page d'acceuil

$app->get ( '/',
	// Affiche tous les circuits organisés prochainement
	function () use ($app)
	{
		$nextcircuits =  array();
		$allprogs = get_all_programmations ();
		//print_r($allprogs);
		$now = new DateTime("now");
		foreach ($allprogs as $prog) {
			$datediff=date_diff($prog->getDateDepart(),$now);
			$daydiff = $datediff->format('%d');
			$monthdiff = $datediff->format('%m');
			if ($daydiff < 15 && $monthdiff < 1){
				$circuitId=$prog->getCircuit()->getId();
				$nextcircuits[] = get_circuit_by_id($circuitId);
			}
		}		
		return $app ['twig']->render ( 'frontoffice/circuitslist.html.twig', [

    			'circuitslist' => $nextcircuits
		] ) ;
	}
)->bind ( 'index' );

// circuitlist : Liste tous les circuits
$app->get ( '/circuit', 
    function () use ($app) 
    {
    	$circuitslist = get_all_circuits ();
    	// print_r($circuitslist);
    	
    	return $app ['twig']->render ( 'frontoffice/circuitslist.html.twig', [
    			'circuitslist' => $circuitslist
    	] );
    }
)->bind ( 'circuitlist' );

// circuitshow : affiche les détails d'un circuit
$app->get ( '/circuit/{id}', 
	function ($id) use ($app) 
	{
		$circuit = get_circuit_by_id ( $id );
		// print_r($circuit);
		$programmations = get_programmations_by_circuit_id ( $id );
		//$circuit ['programmations'] = $programmations;

		return $app ['twig']->render ( 'frontoffice/circuitshow.html.twig', [ 
				'id' => $id,
				'circuit' => $circuit 
			] );
	}
)->bind ( 'circuitshow' );

// programmationlist : liste tous les circuits programmés
$app->get ( '/programmation', 
	function () use ($app) 
	{
		$programmationslist = get_all_programmations ();
		// print_r($programmationslist);

		return $app ['twig']->render ( 'frontoffice/programmationslist.html.twig', [ 
				'programmationslist' => $programmationslist 
			] );
	}
)->bind ( 'programmationlist' );


//admin routes
require_once "backoffice.php";

$app->run ();
