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
	$l=new TotalMailer();

	// set a template mail
	$l->setTemplate('template.txt');

	// set a object of mail
	$l->setSubject('Mail di test');

	//  add a placeholder replace
	$a=array('user','password');

	// replace a word in tempalte
	$l->replacesp($a);

	//create a mail recipient
	$ad='destinatario@mail.it';
	
	/*
	if you have a many recipient

	$ad=array('a@mail.it','b@mail.it','c@mail.it');
	*/

	//set a mail recipient
	$l->setDest($ad);

	//set a mail sender
	$l->setMit('mittente@mail.it');
	
	//send a mail
	$l->SendMail();
?>
