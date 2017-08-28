<?php
	
	class Footer
	{
		
		private $data;
		
		public function getAllScript ()
		{
			$this -> data = "<script type=\"text/javascript\" src=\"script/jquery.js\"></script>";
			$this -> data .= "<script type=\"text/javascript\" src=\"script/bootstrap.min.js\"></script>";
			$this -> data .= "<script type=\"text/javascript\" src=\"script/slick.slider.min.js\"></script>";
			$this -> data .= "<script type=\"text/javascript\" src=\"script/jquery.countdown.min.js\"></script>";
			$this -> data .= "<script type=\"text/javascript\" src=\"script/fancybox.pack.js\"></script>";
			$this -> data .= "<script type=\"text/javascript\" src=\"script/isotope.min.js\"></script>";
			$this -> data .= "<script type=\"text/javascript\" src=\"script/progressbar.js\"></script>";
			$this -> data .= "<script type=\"text/javascript\" src=\"script/counter.js\"></script>";
			$this -> data .= "<script type=\"text/javascript\" src=\"https://maps.googleapis.com/maps/api/js\"></script>";
			$this -> data .= "<script type=\"text/javascript\" src=\"script/functions.js\"></script>";
			
			return $this -> data;
		}
		
		
		public function getScriptLogin ()
		{
			return $data
				= "<script type=\"text/javascript\" src=\"assets/js/script_facebook.js\"></script> ";
		}
		
	}

?>

