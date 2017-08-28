<?php

	require_once ( 'database.php' );
	require_once ( 'utility.php' );

	Class Maufutsal
	{
		protected $sourceonline = "online";
		protected $sourceoffline = "offline";
		protected $codebook;
		protected $coderegistration;
		protected $codeslamevent;
		protected $datetime;
		protected $customerid;
		protected $amount;
		protected $idbooking;
		protected $idproduct;

		public function codebook ()
		{
			return "888" . mt_rand (10 , 100) . time ();
		}

		public function coderegcomp ()
		{
			return "777" . mt_rand (10 , 100) . time ();
		}

		public function codeslameventreg ()
		{
			return "666" . mt_rand (10 , 100) . time ();
		}

		public function sourceonline ()
		{
			return $this->sourceonline;
		}

		public function sourceoffline ()
		{
			return $this->sourceoffline;
		}

		function getAlias ($customer_id)
		{
			$db = new Database();

			$customer_id  = htmlentities (addslashes ($customer_id));
			$query        = "SELECT * FROM tbl_user WHERE username=?";
			$result_alias = $db->getValue ($query , [ $customer_id ]);

			return $result_alias['name'];
		}

		public function getCodeBook ()
		{
			return $this->codebook;
		}

		public function setCodeBook ($code)
		{
			$this->codebook = $code;
		}

		public function setCodeRegCompetition ($code_registration)
		{
			$this->coderegistration = $code_registration;
		}

		public function getCodeRegCompetition ()
		{
			return $this->coderegistration;
		}

		public function setCodeRegSlamEvent ($codeslameventreg)
		{
			$this->codeslamevent = $codeslameventreg;
		}

		public function getCodeRegSlamEvent ()
		{
			return $this->codeslamevent;
		}

		public function getDateTime ()
		{
			return $this->datetime;
		}

		public function setDateTime ($date_time)
		{
			$this->datetime = $date_time;
		}

		public function getCustomerId ()
		{
			return $this->customerid;
		}

		public function setCustomerId ($customer_id)
		{
			$this->customerid = $customer_id;
		}

		public function setAmountTransaction ($amount_transaction)
		{
			$this->amount = $amount_transaction;
		}

		public function getAmountTransaction ()
		{
			return $this->amount;
		}

		public function getIdBooking ()
		{
			return $this->idbooking;
		}

		public function setIdBooking ($id_booking)
		{
			$this->idbooking = $id_booking;
		}

		public function getIdProduct ()
		{
			return $this->idproduct;
		}

		public function setIdProduct ($id_product)
		{
			$this->idproduct = $id_product;
		}

		public function getNameCustomer ($email)
		{
			$db        = new Database();
			$util      = new Utility();
			$cust_name = null;

			$query              = "SELECT * FROM tbl_user WHERE username=?";
			$result_search_name = $db->getValue ($query , [ $email ]);

			if ( !empty($result_search_name) )
			{
				$cust_name = $result_search_name['name'];
			}

			return $cust_name;
		}


		public function getIDRegistration ($email)
		{
			$db              = new Database();
			$id_registration = null;

			$query                = "SELECT * FROM tbl_user WHERE username=?";
			$result_search_id_reg = $db->getValue ($query , [ $email ]);

			if ( !empty($result_search_id_reg) )
			{
				$id_registration = $result_search_id_reg['id_reg'];
			}

			return $id_registration;
		}


		public function checkCookieOrPhNumber ()
		{
			$util     = new Utility();
			$dataUser = null;

			if ( isset($_COOKIE['maufutsal_dat']) )
			{
				$dataUser = $util->decode ($_COOKIE['maufutsal_dat']);
			}
			else
			{
				//session_start();
				$dataUser = $util->decode ($_COOKIE['maufutsal_dat_ph']);
			}

			return $dataUser;
		}


		public function checkOpenHours (
			$court_reg ,
			$field_code ,
			$number_of_day ,
			$code_cat ,
			$start_time ,
			$end_time)
		{
			$db             = new Database();
			$count          = 0;
			$register_time  = null;
			$data_open_hour = array();
			$open_hour      = 1;

			$query              =
				"SELECT * FROM tbl_harga_lapangan WHERE court_reg=? AND name_field=? AND code_category=? AND ('$number_of_day' BETWEEN start_day AND end_day) ORDER BY register ASC";
			$result_normal_info =
				$db->getAllValue ($query ,
				                  [
					                  $court_reg ,
					                  $field_code ,
					                  $code_cat
				                  ]);

			foreach ( $result_normal_info as $data_hour )
			{
				$data_open_hour[ $count ] = $data_hour['register'];
				$count++;
			}

			if ( !empty($data_open_hour) )
			{
				$open_hour = min ($data_open_hour);
				$open_hour = substr ($open_hour , 0 , 2);
			}

			if ( $start_time < $open_hour )
			{
				$open_hour = 0;
			}
			else
			{
				$open_hour = 1;
			}

			return $open_hour;
		}


		public function checkAvailableBook (
			$current_date ,
			$field_code ,
			$court_reg ,
			$start_time ,
			$end_time)
		{
			$db   = new Database();
			$util = new Utility();

			$respons       = 0;
			$index_tracker = 0;
			$data_tracker  = NULL;

			$query               =
				"SELECT * FROM tbl_booking_lapangan WHERE register=? AND code_arena=? AND court_reg=?";
			$result_booking_info =
				$db->getAllValue ($query ,
				                  [
					                  $current_date ,
					                  $field_code ,
					                  $court_reg
				                  ]);

			foreach ( $result_booking_info as $row )
			{
				$start_time_from_db = substr ($row['jam_mulai'] , 0 , 2);
				$end_time_from_db   = substr ($row['jam_akhir'] , 0 , 2);
				$result_compare     =
					$this->getPositionTime ($start_time ,
					                        $end_time ,
					                        $start_time_from_db ,
					                        $end_time_from_db);

				$data_tracker[ $index_tracker ] =
					$this->getTemporaryCondition ($result_compare[0] ,
					                              $result_compare[1]);
				$index_tracker++;
			}

			$respons = $this->getScheAnalyser ($data_tracker);

			return $respons;
		}


		public function getPositionTime (
			$start_time ,
			$end_time ,
			$start_time_from_db ,
			$end_time_from_db)
		{
			$respons = null;

			if ( $start_time >= $start_time_from_db && $start_time < $end_time_from_db )
			{
				$respons[0] = '4';
				$respons[1] = '-';
			}
			else
			{
				if ( $start_time < $start_time_from_db )
				{
					$respons[0] = '1';

					if ( $end_time > $start_time_from_db && $end_time < $end_time_from_db )
					{
						$respons[1] = '4';
					}
					else
					{
						if ( $end_time < $start_time_from_db )
						{
							$respons[1] = '2';
						}

						else
						{
							if ( $end_time == $start_time_from_db )
							{
								$respons[1] = '3';
							}

							else
							{
								if ( $end_time > $end_time_from_db )
								{
									$respons[1] = '7';
								}
								else
								{
									if ( $end_time == $end_time_from_db )
									{
										$respons[1] = '5';
									}
									else
									{
									}
								}
							}
						}
					}
				}
				else
				{
					if ( $start_time > $end_time_from_db )
					{
						$respons[0] = '6';

						if ( $end_time > $start_time_from_db && $end_time < $end_time_from_db )
						{
							$respons[1] = '4';
						}
						else
						{
							if ( $end_time <= $start_time_from_db )
							{
								$respons[1] = '2';
							}

							else
							{
								if ( $end_time == $start_time_from_db )
								{
									$respons[1] = '3';
								}

								else
								{
									if ( $end_time > $end_time_from_db )
									{
										$respons[1] = '7';
									}
									else
									{
										if ( $end_time == $end_time_from_db )
										{
											$respons[1] = '5';
										}
										else
										{
										}
									}
								}
							}
						}
					}

					else
					{
						if ( $start_time == $end_time_from_db )
						{
							$respons[0] = '5';

							if ( $end_time > $start_time_from_db && $end_time < $end_time_from_db )
							{
								$respons[1] = '4';
							}
							else
							{
								if ( $end_time <= $start_time_from_db )
								{
									$respons[1] = '2';
								}

								else
								{
									if ( $end_time == $start_time_from_db )
									{
										$respons[1] = '3';
									}

									else
									{
										if ( $end_time > $end_time_from_db )
										{
											$respons[1] = '7';
										}
										else
										{
											if ( $end_time == $end_time_from_db )
											{
												$respons[1] = '5';
											}
											else
											{
											}
										}
									}
								}
							}
						}

						else
						{
						}
					}
				}
			}

			return $respons;
		}


		public function getTemporaryCondition ($respons_one , $respons_two)
		{
			$result = null;

			if ( $respons_one == "4" AND $respons_two == "-" )
			{
				return $result = "N";
			}

			if ( $respons_one == "1" AND $respons_two == "2" )
			{
				return $result = "Y";
			}

			if ( $respons_one == "1" AND $respons_two == "3" )
			{
				return $result = "Y";
			}

			if ( $respons_one == "1" AND $respons_two == "4" )
			{
				return $result = "N";
			}

			if ( $respons_one == "1" AND $respons_two == "5" )
			{
				return $result = "N";
			}

			if ( $respons_one == "1" AND $respons_two == "6" )
			{
				return $result = "N";
			}

			if ( $respons_one == "1" AND $respons_two == "7" )
			{
				return $result = "N";
			}


			if ( $respons_one == "5" AND $respons_two == "7" )
			{
				$result = "Y";
			}

			if ( $respons_one = "6" AND $respons_two = "7" )
			{
				$result = "Y";
			}
		}


		public function getScheAnalyser ($data_tracker)
		{
			$respons = null;

			$max_loop = sizeof ($data_tracker) - 1;
			$loop     = 0;

			$count_no  = 0;
			$count_yes = 0;

			for ( $loop ; $loop <= $max_loop ; $loop++ )
			{
				$checkData = $data_tracker[ $loop ];

				if ( $checkData == "N" )
				{
					$count_no++;
				}
				else
				{
					$count_yes++;
				}
			}

			if ( $count_no > 0 )
			{
				$respons = 0;
			}
			else
			{
				$respons = 1;
			}

			return $respons;
		}


		function getIdRegMember ($email)
		{
			$db   = new Database();
			$util = new Utility();

			$query            = "SELECT * FROM tbl_user WHERE username=?";
			$result_user_info = $db->getValue ($query , [ $email ]);

			return $result_user_info['id_reg'];
		}

		public function storeonlinebookbytransfer ($methodpayment , $type_transfer)
		{
			$db   = new Database();
			$util = new Utility();

			session_start ();

			$current_date   = $util->decode ($_SESSION['current_date']);
			$court_reg      = $util->decode ($_SESSION['court_reg']);
			$field_code     = $util->decode ($_SESSION['field_code']);
			$code_cat       = $util->decode ($_SESSION['code_cat']);
			$start_time     = $util->decode ($_SESSION['start_time']);
			$duration_time  = $util->decode ($_SESSION['duration_time']);
			$cost           = $util->decode ($_SESSION['cost']);
			$state          = $util->decode ($_SESSION['state']);
			$id_user_member = $this->checkCookieOrPhNumber ();
			//$id_user_member = $util->decode($_COOKIE['maufutsal_dat']);
			$code_book = $this->codebook ();

			$register = $util->setRegisterDate ($current_date);
			$end_time = $util->getEndTime ($start_time , $duration_time);

			$util->setDefaultTimeZone ("Asia/Bangkok");
			$date_time = $util->getDateTimeToday ();

			$query             = "SELECT * FROM tbl_arena_futsal WHERE code_arena=?";
			$result_arena_info = $db->getValue ($query , [ $field_code ]);
			$arena_name        = $result_arena_info['nama_arena'];

			$verification   = 0;
			$friendly_match = 0;
			$source         = $this->sourceonline ();

			$query               = "SELECT * FROM tbl_bank_account";
			$result_bank_account = $db->getValue ($query);
			$account_no          = $result_bank_account['account_no'];
			$account_name        = $result_bank_account['account_name'];
			$account_id          = $result_bank_account['id_bank'];

			$query =
				"INSERT INTO tbl_booking_lapangan(tanggal,date_time,register,court_reg,nama_area,code_arena,code_category,jam_mulai,jam_akhir,source,nomor_booking,verification,id_user_member,price,friendly_match,payment_method,type_transfer,account_no,account_name,id_bank) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

			$result_store_booking =
				$db->insertValue ($query ,
				                  [
					                  $current_date ,
					                  $date_time ,
					                  $register ,
					                  $court_reg ,
					                  $arena_name ,
					                  $field_code ,
					                  $code_cat ,
					                  $start_time ,
					                  $end_time ,
					                  $source ,
					                  $code_book ,
					                  $verification ,
					                  $id_user_member ,
					                  $cost ,
					                  $friendly_match ,
					                  $methodpayment ,
					                  $type_transfer ,
					                  $account_no ,
					                  $account_name ,
					                  $account_id
				                  ]);

			$this->setCodeBook ($code_book);
			$this->setDateTime ($date_time);
			$this->setCustomerId ($id_user_member);

			return $result_store_booking;
		}


		public function storeonlinebookbypaymentcode ($methodpayment , $type_transfer)
		{
			$db   = new Database();
			$util = new Utility();

			session_start ();

			$current_date   = $util->decode ($_SESSION['current_date']);
			$court_reg      = $util->decode ($_SESSION['court_reg']);
			$field_code     = $util->decode ($_SESSION['field_code']);
			$code_cat       = $util->decode ($_SESSION['code_cat']);
			$start_time     = $util->decode ($_SESSION['start_time']);
			$duration_time  = $util->decode ($_SESSION['duration_time']);
			$cost           = $util->decode ($_SESSION['cost']);
			$state          = $util->decode ($_SESSION['state']);
			$id_user_member = $this->checkCookieOrPhNumber ();
			//$id_user_member = $util->decode($_COOKIE['maufutsal_dat']);
			$code_book = $this->codebook ();


			$register = $util->setRegisterDate ($current_date);
			$end_time = $util->getEndTime ($start_time , $duration_time);

			$util->setDefaultTimeZone ("Asia/Bangkok");
			$date_time = $util->getDateTimeToday ();

			$query             = "SELECT * FROM tbl_arena_futsal WHERE code_arena=?";
			$result_arena_info = $db->getValue ($query , [ $field_code ]);
			$arena_name        = $result_arena_info['nama_arena'];

			$verification   = 0;
			$friendly_match = 0;
			$source         = $this->sourceonline ();

			$query               = "SELECT * FROM tbl_bank_account";
			$result_bank_account = $db->getValue ($query);
			$account_no          = $result_bank_account['account_no'];
			$account_name        = $result_bank_account['account_name'];
			$account_id          = $result_bank_account['id_bank'];

			$query =
				"INSERT INTO tbl_booking_lapangan(tanggal,date_time,register,court_reg,nama_area,code_arena,code_category,jam_mulai,jam_akhir,source,nomor_booking,verification,id_user_member,price,friendly_match,payment_method,type_transfer,account_no,account_name,id_bank) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

			$result_store_booking =
				$db->insertValue ($query ,
				                  [
					                  $current_date ,
					                  $date_time ,
					                  $register ,
					                  $court_reg ,
					                  $arena_name ,
					                  $field_code ,
					                  $code_cat ,
					                  $start_time ,
					                  $end_time ,
					                  $source ,
					                  $code_book ,
					                  $verification ,
					                  $id_user_member ,
					                  $cost ,
					                  $friendly_match ,
					                  $methodpayment ,
					                  $type_transfer ,
					                  $account_no ,
					                  $account_name ,
					                  $account_id
				                  ]);

			$query               =
				"SELECT * FROM tbl_booking_lapangan WHERE nomor_booking=?";
			$result_booking_info = $db->getValue ($query , [ $code_book ]);

			$this->setIdBooking ($result_booking_info['id_booking']);
			$this->setIdProduct ($court_reg);
			$this->setAmountTransaction ($cost);
			$this->setCodeBook ($code_book);
			$this->setDateTime ($date_time);
			$this->setCustomerId ($id_user_member);

			return $result_store_booking;
		}

		public function storeonlinebookbyagent ($methodpayment , $type_transfer)
		{
			$db   = new Database();
			$util = new Utility();

			session_start ();

			$current_date   = $util->decode ($_SESSION['current_date']);
			$court_reg      = $util->decode ($_SESSION['court_reg']);
			$field_code     = $util->decode ($_SESSION['field_code']);
			$code_cat       = $util->decode ($_SESSION['code_cat']);
			$start_time     = $util->decode ($_SESSION['start_time']);
			$duration_time  = $util->decode ($_SESSION['duration_time']);
			$cost           = $util->decode ($_SESSION['cost']);
			$state          = $util->decode ($_SESSION['state']);
			$id_user_member = $this->checkCookieOrPhNumber ();
			//$id_user_member = $util->decode($_COOKIE['maufutsal_dat']);
			$code_book = $this->codebook ();

			$register = $util->setRegisterDate ($current_date);
			$end_time = $util->getEndTime ($start_time , $duration_time);

			$util->setDefaultTimeZone ("Asia/Bangkok");
			$date_time = $util->getDateTimeToday ();

			$query             = "SELECT * FROM tbl_arena_futsal WHERE code_arena=?";
			$result_arena_info = $db->getValue ($query , [ $field_code ]);
			$arena_name        = $result_arena_info['nama_arena'];

			$verification   = 2;
			$friendly_match = 0;
			$source         = $this->sourceonline ();

			$account_no   = 0;
			$account_name = "-";
			$account_id   = 0;

			$query =
				"INSERT INTO tbl_booking_lapangan(tanggal,date_time,register,court_reg,nama_area,code_arena,code_category,jam_mulai,jam_akhir,source,nomor_booking,verification,id_user_member,price,friendly_match,payment_method,type_transfer,account_no,account_name,id_bank) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

			$result_store_booking =
				$db->insertValue ($query ,
				                  [
					                  $current_date ,
					                  $date_time ,
					                  $register ,
					                  $court_reg ,
					                  $arena_name ,
					                  $field_code ,
					                  $code_cat ,
					                  $start_time ,
					                  $end_time ,
					                  $source ,
					                  $code_book ,
					                  $verification ,
					                  $id_user_member ,
					                  $cost ,
					                  $friendly_match ,
					                  $methodpayment ,
					                  $type_transfer ,
					                  $account_no ,
					                  $account_name ,
					                  $account_id
				                  ]);

			$this->setCodeBook ($code_book);
			$this->setDateTime ($date_time);
			$this->setCustomerId ($id_user_member);

			return $result_store_booking;
		}


		public function storecompetition ($methodpayment , $type_transfer)
		{
			$db   = new Database();
			$util = new Utility();

			$util->setDefaultTimeZone ("Asia/Bangkok");
			$date_time    = $util->getDateTimeToday ();
			$current_date = $util->getDateToday ();

			$name_team          = $util->decode ($_COOKIE['maufutsal_team_name']);
			$id_reg_member      =
				$this->getIdRegMember ($util->decode ($_COOKIE['maufutsal_dat']));
			$id_user_member     = $util->decode ($_COOKIE['maufutsal_dat']);
			$id_competition     = $util->decode ($_COOKIE['maufutsal_id_comp']);
			$payment            = "-";
			$bank_name          = "-";
			$account_no         = "-";
			$account_name       = "-";
			$agent_code_payment = "-";
			$verification       = "-";
			$code_reg           = $this->coderegcomp ();
			$lolos              = "NULL";
			$usage_member       = "0";

			$payment_code     = "-";
			$bank_code        = "-";
			$signature        = "-";
			$booking_datetime = "-";


			if ( $methodpayment == 0 )
			{
				$verification = "0";

				$query            = "SELECT * FROM tbl_bank_account";
				$result_bank_info = $db->getValue ($query);

				$id_bank               = $result_bank_info['id_bank'];
				$query                 = "SELECT * FROM tbl_bank WHERE id_bank=?";
				$result_bank_data_info = $db->getValue ($query , [ $id_bank ]);

				$bank_name    = $result_bank_data_info['nama_bank'];
				$account_name = $result_bank_info['account_name'];
				$account_no   = $result_bank_info['account_no'];
			}

			if ( $methodpayment == 4 )
			{
				$verification  = "2";
				$type_transfer = "-";
			}

			$query =
				"INSERT INTO tbl_member_kompetisi(tanggal,nama_team,id_reg_member,id_kompetisi,payment,payment_method,type_transfer,bank_name,account_no,account_name,agent_code_payment,verification,code_reg,lolos,usage_member,payment_code,bank_code,signature,booking_datetime,date_time) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

			$result_store_competition =
				$db->insertValue ($query ,
				                  [
					                  $current_date ,
					                  $name_team ,
					                  $id_reg_member ,
					                  $id_competition ,
					                  $payment ,
					                  $methodpayment ,
					                  $type_transfer ,
					                  $bank_name ,
					                  $account_no ,
					                  $account_name ,
					                  $agent_code_payment ,
					                  $verification ,
					                  $code_reg ,
					                  $lolos ,
					                  $usage_member ,
					                  $payment_code ,
					                  $bank_code ,
					                  $signature ,
					                  $booking_datetime ,
					                  $date_time
				                  ]);

			$query            = "SELECT * FROM tbl_member_kompetisi WHERE code_reg=?";
			$result_comp_info = $db->getValue ($query , [ $code_reg ]);

			$id_competition        = $result_comp_info['id_kompetisi'];
			$query                 = "SELECT * FROM tbl_kompetisi WHERE id_kompetisi=?";
			$result_comp_full_info = $db->getValue ($query , [ $id_competition ]);

			$this->setIdBooking ($result_comp_info['id_member_kompetisi']);
			$this->setIdProduct ($id_competition);
			$this->setAmountTransaction ($result_comp_full_info['biaya']);
			$this->setCodeRegCompetition ($code_reg);
			$this->setDateTime ($date_time);
			$this->setCustomerId ($id_user_member);

			return $result_store_competition;
		}


		public function storeslamevent ($methodpayment , $type_transfer)
		{
			$db   = new Database();
			$util = new Utility();

			$util->setDefaultTimeZone ("Asia/Bangkok");
			$date_time    = $util->getDateTimeToday ();
			$current_date = $util->getDateToday ();

			$name_team          = $util->decode ($_COOKIE['maufutsal_team_name']);
			$id_reg_member      =
				$this->getIdRegMember ($util->decode ($_COOKIE['maufutsal_dat']));
			$id_user_member     = $util->decode ($_COOKIE['maufutsal_dat']);
			$id_competition     = $util->decode ($_COOKIE['maufutsal_slam_dat']);
			$field_data         = $util->decode ($_COOKIE['maufutsal_field_dat']);
			$payment            = "-";
			$bank_name          = "-";
			$account_no         = "-";
			$account_name       = "-";
			$agent_code_payment = "-";
			$verification       = "-";
			$code_reg           = $this->codeslameventreg ();
			$lolos              = "NULL";
			$usage_member       = "0";

			$payment_code     = "-";
			$bank_code        = "-";
			$signature        = "-";
			$booking_datetime = "-";
			$lawan_tanding    = "belum ditentukan";
			$futsal_tanding   = "belum ditentukan";
			$lapangan_tanding = "belum ditentukan";
			$tanggal_tanding  = "belum ditentukan";
			$pukul_tanding    = "belum ditentukan";

			if ( $methodpayment == 0 )
			{
				$query            = "SELECT * FROM tbl_bank_account";
				$result_bank_info = $db->getValue ($query);

				$id_bank               = $result_bank_info['id_bank'];
				$query                 = "SELECT * FROM tbl_bank WHERE id_bank=?";
				$result_bank_data_info = $db->getValue ($query , [ $id_bank ]);

				$bank_name    = $result_bank_data_info['nama_bank'];
				$account_name = $result_bank_info['account_name'];
				$account_no   = $result_bank_info['account_no'];

				$verification = "0";
			}

			if ( $methodpayment == 4 )
			{
				$verification  = "2";
				$type_transfer = "-";
			}

			$query =
				"INSERT INTO tbl_member_kompetisi(tanggal,nama_team,id_reg_member,id_kompetisi,payment,payment_method,type_transfer,bank_name,account_no,account_name,agent_code_payment,verification,code_reg,lolos,usage_member,payment_code,bank_code,signature,booking_datetime,date_time,field_list,lawan_tanding,futsal_tanding,lapangan_tanding,tanggal_tanding,pukul_tanding) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

			$result_store_slam_event =
				$db->insertValue ($query ,
				                  [
					                  $current_date ,
					                  $name_team ,
					                  $id_reg_member ,
					                  $id_competition ,
					                  $payment ,
					                  $methodpayment ,
					                  $type_transfer ,
					                  $bank_name ,
					                  $account_no ,
					                  $account_name ,
					                  $agent_code_payment ,
					                  $verification ,
					                  $code_reg ,
					                  $lolos ,
					                  $usage_member ,
					                  $payment_code ,
					                  $bank_code ,
					                  $signature ,
					                  $booking_datetime ,
					                  $date_time ,
					                  $field_data ,
					                  $lawan_tanding ,
					                  $futsal_tanding ,
					                  $lapangan_tanding ,
					                  $tanggal_tanding ,
					                  $pukul_tanding
				                  ]);

			$query             = "SELECT * FROM tbl_member_kompetisi WHERE code_reg=?";
			$result_slame_info = $db->getValue ($query , [ $code_reg ]);

			$id_competition        = $result_slame_info['id_kompetisi'];
			$query                 = "SELECT * FROM tbl_kompetisi WHERE id_kompetisi=?";
			$result_comp_full_info = $db->getValue ($query , [ $id_competition ]);

			$this->setIdBooking ($result_slame_info['id_member_kompetisi']);
			$this->setIdProduct ($id_competition);
			$this->setAmountTransaction ($result_comp_full_info['biaya']);
			$this->setCodeRegSlamEvent ($code_reg);
			$this->setDateTime ($date_time);
			$this->setCustomerId ($id_user_member);

			return $result_store_slam_event;
		}

	}

?>