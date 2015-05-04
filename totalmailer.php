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
	class TotalMailer {
		
		/**
		 * true = a recipient; false = more recipients
		 */	
		private $sdest;
		
		/**
		 * recipients of the email
		 */
		private $dest;
		
		/**
		 * array with the recipients of the email
		 */
		private $ardest;
		
		/**
		 * sender of the email
		 */
		private $from;
		
		/**
		 * subject of the email
		 */
		private $subject;
		
		/**
		 * design of the email
		 */
		private $template;
		
		/**
		 * text of the email
		 */
		private $text;
		
		/**
		 * header of the email
		 */
		private $headers;
		
		/**
		 * hidden recipients of the email
		 */
		private $ccn;
		
		/**
		 * recipients of the email
		 */
		private $cc;
		
		/**
		 * placeholder of the email
		 */
		private $sp;
		
		/**
		 * Initialize mail
		 */
		public function TotalMailer() {
			$this->sdest=TRUE;
			$this->ardest = '';
			$this->dest = '';
			$this->from = '';
			$this->ccn = '';
			$this->cc = '';
			$this->sp = '';
			$this->subject = '';
			$this->template = '';
			$this->headers = '';
		}
		
		/**
		 * quick send us an email
		 *
		 * @param string or array $dest
	       	 * @param string $mit
	       	 * @param string $ccn
	       	 * @param string $cc
	       	 * @param string $s
	       	 * @param string $template
	       	 * @param string $parole
		 */
		public function TotalMailerSpeed($dest,$mit,$ccn,$cc,$s,$template,$parole) {
			$this->sdest=TRUE;
			$this->ardest = '';
			$this->dest = $this->setDest($dest);
			$this->from = $this->setMit($mit);
			$this->ccn = $this->setCcn($ccn);
			$this->cc = $this->setCc($cc);
			$this->subject = $this->setSubject($s);
			$this->template = $this->setTemplate($template);
			$this->sp = $this->findsp();
			$this->text = $this->replacesp($parole);
			$this->headers = '';
			$this->SendMail();
		}
		
		/**
		 * send us an email
		 */
		public function SendMail(){
			$this->headers = 'MIME-Version: 1.0' . "\r\n".'Content-type: text/html; charset=iso-8859-1' . "\r\n".$this->from .$this->ccn.$this->ccn;
			if($this->sdest){
				mail($this->dest, $this->subject, $this->text, $this->headers);
			}else{
				$n=count($this->ardest);
				for($i=0; $i<$n; $i++){
					mail($this->ardest[$i], $this->subject, $this->text, $this->headers);
				
				}			
			}
		}
		
		/**
		 * sets the subject of the mail
		 *
	       	 * @param string $u
		 */
		public function setSubject($u){
			$this->subject=$u;	
			return $this->subject;	
		}
		
		/**
		 * sets the subject of the mail
		 *
	       	 * @param string $u
		 */
		public function setTemplate($u){
			$this->template=file_get_contents($u);		
			return $this->template;
		}
		
		/**
		 * sets the sender of the mail
		 *
	       	 * @param string $u
		 */
		public function setMit($u){
			$this->from='From: '.$u.' ' ."\r\n";	
			return $this->from;		
		}
		
		/**
		 * sets the recipients  of the mail
		 *
	       	 * @param string $u
		 */
		public function setCc($u){
			if(is_array($u)) $this->cc='cc: '.implode(',', $u).' ' ."\r\n";
			else $this->cc='cc: '.$u.' ' ."\r\n";			
			return $this->cc;		
		}
		
		/**
		 * sets the hidden recipients  of the mail
		 *
	       	 * @param string $u
		 */
		public function setCcn($u){
			if(is_array($u)) $this->ccn='bcc: '.implode(',', $u).' ' ."\r\n";
			else $this->cnn='bcc: '.$u.' ' ."\r\n";	
			return $this->cnn;	
		}
		
		/**
		 * sets the hidden recipients  of the mail
		 *
	       	 * @param string $u
		 */
		public function setDest($u){
			if(is_array($u)){							
				$this->ardest=$u;							
				$this->sdest=false;
				return $this->ardest;	
	
			}else{			
				$this->dest=$u;	
				return $this->dest;
			}	
		}
		
		/**
		 * sets the placeholder recipients  of the mail
		 */
		public function findsp(){
			$txt=$this->template;
			$el=explode('[$', $txt);
			$n=count($el);
			$segnpo='';
			if($n){
				for($i=1; $i<$n; $i++){
					$ell=explode('$]',$el[$i]);
					$segnpo.= '[$'.$ell[0].'$];';				
				}
			}	
			$this->sp=$segnpo;	
			return $segnpo;		
		}
		
		/**
		 * replace placeholder in a text of e-mail
		 *
	       	 * @param array $ar
		 */
		public function replacesp($ar){
			$this->findsp();
			$el=explode(';',$this->sp);
			$ns=count($el);
			$na=count($ar);
			$n=$na;
			$text=$this->template;
			if($ns<$na) $n=$ns;
			if($n){
				for($i=0; $i<$n; $i++){
					$text=str_replace($el[$i],$ar[$i],$text);				
				}
			}
			$this->text=$text;
			return $text;
		}

		
	} 
?>
