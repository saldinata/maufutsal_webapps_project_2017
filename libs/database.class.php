<?php
	
	Class Database
	{
		public    $isConn;
		protected $dataBase;
		
		public function __construct ( $username = "root" , $password = "" , $host = "localhost" , $dbname = "maufutsal_2017" , $options = [] )
		{
			$this -> isConn = true;
			
			try
			{
				$this -> dataBase = new PDO( "mysql:host={$host};dbname={$dbname};charset=utf8" , $username ,
				                             $password , $options );
				$this -> dataBase -> setAttribute ( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION );
				$this -> dataBase -> setAttribute ( PDO::ATTR_DEFAULT_FETCH_MODE , PDO::FETCH_ASSOC );
			}
			catch ( PDOException $e )
			{
				throw new Exception( $e -> getMessage () );
			}
		}
		
		
		public function disconnectDatabase ()
		{
			$this -> dataBase = null;
			$this -> isConn   = false;
		}
		
		
		public function insertValue ( $query , $params = [] )
		{
			try
			{
				$stmt = $this -> dataBase -> prepare ( $query );
				$stmt -> execute ( $params );
				
				return true;
			}
			catch ( PDOException $e )
			{
				throw new Exception( $e -> getMessage () );
			}
		}
		
		
		public function updateValue ( $query , $params = [] )
		{
			$this -> insertValue ( $query , $params );
		}
		
		
		public function deleteValue ( $query , $params = [] )
		{
			$this -> insertValue ( $query , $params );
		}
		
		
		public function getAllValue ( $query , $params = [] )
		{
			try
			{
				$stmt = $this -> dataBase -> prepare ( $query );
				$stmt -> execute ( $params );
				
				return $stmt -> fetchALL ();
			}
			catch ( PDOException $e )
			{
				throw new Exception( $e -> getMessage () );
			}
		}
		
		
		public function getValue ( $query , $params = [] )
		{
			try
			{
				$stmt = $this -> dataBase -> prepare ( $query );
				$stmt -> execute ( $params );
				
				return $stmt -> fetch ();
			}
			catch ( PDOException $e )
			{
				throw new Exception( $e -> getMessage () );
			}
		}
	}


?>