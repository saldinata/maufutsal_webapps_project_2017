<?php
	
	Class Utility
	{
		protected $temp_variable = null;
		protected $skey          = "logitechlogitech";
		
		public function startSession ()
		{
			ob_start ();
			session_start ();
		}
		
		
		public function setDefaultTimeZone ( $timezones )
		{
			date_default_timezone_set ( $timezones );
		}
		
		
		public function getDateTimeToday ()
		{
			$respons = date ( "Y-m-d H:i:s" );
			
			return $respons;
		}
		
		public function getDateToday ()
		{
			$respons = date ( "d-m-Y" );
			
			return $respons;
		}
		
		public function setDateRegisterForToday ()
		{
			$respons = date ( "Ymd" );
			
			return $respons;
		}
		
		public function setRegisterDate ( $date_data )
		{
			$respons = date ( "Ymd" , strtotime ( $date_data ) );
			
			return $respons;
		}
		
		public function changeFormatDateFromNumberToString ( $date_number )
		{
			$respons = date ( "d F Y" , strtotime ( $date_number ) );
			
			return $respons;
		}
		
		public function getDayInIndonesia ( $day )
		{
			if ( $day === "Monday" )
			{
				return $day = "Senin";
			}
			
			else if ( $day === "Tuesday" )
			{
				return $day = "Selasa";
			}
			
			else if ( $day === "Wednesday" )
			{
				return $day = "Rabu";
			}
			
			else if ( $day === "Thrusday" )
			{
				return $day = "Kamis";
			}
			
			else if ( $day === "Friday" )
			{
				return $day = "Jum'at";
			}
			
			else if ( $day === "Saturday" )
			{
				return $day = "Sabtu";
			}
			
			else if ( $day === "Sunday" )
			{
				return $day = "Minggu";
			}
			
			else
			{
			
			}
		}
		
		public function getEndTime ( $start_time , $duration )
		{
			$end_time = ( ( substr ( $start_time , 0 , 2 ) ) + $duration );
			
			if ( $end_time < 10 )
			{
				$end_time = "0" . $end_time . ":00";
			}
			else
			{
				$end_time = $end_time . ":00";
			}
			
			return $end_time;
		}
		
		
		public function hideErrorReporting ()
		{
			error_reporting ( 0 );
		}
		
		
		public function dateRangeComparation ( $date_start , $date_end , $date_comparation )
		{
			$respons = false;
			
			if ( $date_comparation <= $date_end && $date_comparation >= $date_start )
			{
				$respons = true;
			}
			else
			{
				$respons = false;
			}
			
			return $respons;
		}
		
		
		public function limitDate ( $date_today , $date_end_promotion )
		{
			$respons = null;
			
			if ( $date_today <= $date_end_promotion )
			{
				$respons = 1;
			}
			else
			{
				$respons = 0;
			}
			
			return $respons;
		}
		
		
		public function encryptpass ( $word )
		{
			$respons = md5 ( $word );
			
			return $respons;
		}
		
		
		public function safe_b64encode ( $string )
		{
			$data = base64_encode ( $string );
			$data = str_replace ( [ '+' , '/' , '=' ] , [ '-' , '_' , '' ] , $data );
			
			return $data;
		}
		
		public function safe_b64decode ( $string )
		{
			$data = str_replace ( [ '-' , '_' ] , [ '+' , '/' ] , $string );
			$mod4 = strlen ( $data ) % 4;
			if ( $mod4 )
			{
				$data .= substr ( '====' , $mod4 );
			}
			
			return base64_decode ( $data );
		}
		
		public function encode ( $word )
		{
			if ( ! $word )
			{
				return false;
			}
			
			$text      = $word;
			$iv_size   = mcrypt_get_iv_size ( MCRYPT_RIJNDAEL_256 , MCRYPT_MODE_ECB );
			$iv        = mcrypt_create_iv ( $iv_size , MCRYPT_RAND );
			$crypttext = mcrypt_encrypt ( MCRYPT_RIJNDAEL_256 , $this -> skey , $text , MCRYPT_MODE_ECB , $iv );
			
			return trim ( $this -> safe_b64encode ( $crypttext ) );
		}
		
		
		public function decode ( $word )
		{
			if ( ! $word )
			{
				return false;
			}
			
			$crypttext   = $this -> safe_b64decode ( $word );
			$iv_size     = mcrypt_get_iv_size ( MCRYPT_RIJNDAEL_256 , MCRYPT_MODE_ECB );
			$iv          = mcrypt_create_iv ( $iv_size , MCRYPT_RAND );
			$decrypttext = mcrypt_decrypt ( MCRYPT_RIJNDAEL_256 , $this -> skey , $crypttext , MCRYPT_MODE_ECB , $iv );
			
			return trim ( $decrypttext );
		}
		
		
		public function setTempVariable ( $variable )
		{
			$this -> temp_variable;
		}
		
		
		public function getTempVariable ()
		{
			return $this -> temp_variable;
		}
		
	}

?>