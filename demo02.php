<?php

/**
 * Totalmailer
 * 
 * @author Matteo Enna, Cagliari, Italy, info@matteoenna.it
 * http://www.matteoenna.it
 * http://www.darwixlab.it
 * @copyright LGPL
 * @version 1
 *
 */
 
	include('totalmailer.php');

	//settings

	$c=new TotalMailer();

	// add a placeholder replace
	$a=array('user','password');

	// send a fast mail 

	$c->TotalMailerSpeed('destinatario@mail.it','mittente@mail.it','','','oggetto della mail','template.txt',$a);
?>
