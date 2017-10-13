<?php

$app->get ( '/admin/circuit', 
    function () use ($app) 
    {
    	$circuitslist = get_all_circuits ();
    	// print_r($circuitslist);
    	
    	return $app ['twig']->render ( 'backoffice/circuitslist.html.twig', [
    			'circuitslist' => $circuitslist
    	] );
    }
)->bind ( 'admincircuitlist' );

// circuitshow : affiche les détails d'un circuit
$app->get ( '/admin/circuit/{id}', 
	function ($id) use ($app) 
	{
		$circuit = get_circuit_by_id ( $id );
		// print_r($circuit);
		$programmations = get_programmations_by_circuit_id ( $id );
		//$circuit ['programmations'] = $programmations;

		return $app ['twig']->render ( 'backoffice/circuitshow.html.twig', [ 
				'id' => $id,
				'circuit' => $circuit 
			] );
	}
)->bind ( 'admincircuitshow' );

// programmationlist : liste tous les circuits programmés
$app->get ( '/admin/programmation', 
	function () use ($app) 
	{
		$programmationslist = get_all_programmations ();
		// print_r($programmationslist);

		return $app ['twig']->render ( 'backoffice/programmationslist.html.twig', [ 
				'programmationslist' => $programmationslist 
			] );
	}
)->bind ( 'adminprogrammationlist' );

