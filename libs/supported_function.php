<?php

function checkAvailablePromo($db,$util,$current_date,$court_reg,$field_code)
{
	$result_check_promo = false;
	$get_promo_data		= NULL;

	$query = "SELECT DISTINCT * FROM tbl_harga_lapangan_promo WHERE court_reg=? AND name_field=?";
	$get_promo_data = $db->getValue($query,[$court_reg,$field_code]);

	if(!empty($get_promo_data))
	{ 
		$current_date	= $util->setRegisterDate($current_date);
		$start_date 	= $util->setRegisterDate($get_promo_data['start_date']);
		$end_date 		= $util->setRegisterDate($get_promo_data['end_date']);

		$result_check_promo = $util->dateRangeComparation($start_date,$end_date,$current_date);
	}
	else
	{
		$result_check_promo = false;
	}

	return $result_check_promo;
}


function getEndTime($start_time,$duration)
{
	$hour 		= substr($start_time, 0,2);
	return $new_hour = ($hour+$duration);
}


function calculatePromoPrice($db,$court_reg,$field_code,$number_of_day,$code_cat,$start_time,$end_time)
{	
	$time_master	= "";
	$promo_price 	= "";
	$register_time	= "";
	$result_1		= "";
	$result_2		= "";
	$total			= 0;

	$query = "SELECT * FROM tbl_harga_lapangan_promo WHERE court_reg=? AND name_field=? AND code_category=? AND ('$number_of_day' BETWEEN start_day AND end_day) ORDER BY register ASC";
	$result_promo_info = $db->getAllValue($query,[$court_reg,$field_code,$code_cat]);

	foreach ($result_promo_info as $row)
	{
		$start_day 	= $row['start_day'];
		$end_day 	= $row['end_day'];

		$promo_price 	= $row['pricelist_promo'];
		$register_time	= $row['register'];

		// if($number_of_day<=$end_day AND $number_of_day>=$start_day)
		// { echo "masuk sini";
		// 	$promo_price 	= $row['pricelist_promo'];
		// 	$register_time	= $row['register'];
		// 	break;	
		// }
	}

	$start_time_promo 	= substr($register_time, 0,2);
	$end_time_promo		= substr($register_time, 4,2);

	if($start_time<$end_time_promo AND $start_time>=$start_time_promo)
	{
		$result_1 = 1;
		$time_master = $end_time_promo;
	}
	else
	{ 
		$result_1 = 0;
		$time_master = $start_time_promo;
	}

	if($end_time<=$end_time_promo AND $end_time>$start_time_promo)
	{
		$result_2 = 1;
	}
	else
	{
		$result_2 = 0;
	}


	if($result_1==0 AND $result_2==0)
	{
		$total = calculateNormalPrice($db,$court_reg,$field_code,$number_of_day,$code_cat,$start_time,$end_time);
	}

	if($result_1==0 AND $result_2==1)
	{ 
		$total = (calculateNormalPrice($db,$court_reg,$field_code,$number_of_day,$code_cat,$time_master,$end_time)) + (($end_time-$time_master)*$promo_price);
	}	

	if($result_1==1 AND $result_2==0)
	{
		$total = ($time_master-$start_time)*$promo_price;
		$total = $total + (calculateNormalPrice($db,$court_reg,$field_code,$number_of_day,$code_cat,$time_master,$end_time));
	}

	if($result_1==1 AND $result_2==1)
	{
		$total = ($end_time-$start_time)*$promo_price;
	}

	return $total;
}


function calculateNormalPrice($db,$court_reg,$field_code,$number_of_day,$code_cat,$start_time,$end_time)
{
	$count 			= 0;
	$register_time 	= null;
	$normal_price	= null;
	$time_master	= "";
	$result_1		= NULL;
	$result_2		= NULL;
	$total			= NULL;
	$final_total	= 0;
	$skip			= "no";
	$data_open_hour	= array();
	
	$query = "SELECT * FROM tbl_harga_lapangan WHERE court_reg=? AND name_field=? AND code_category=? AND ('$number_of_day' BETWEEN start_day AND end_day) ORDER BY register ASC" ;
	$result_normal_info = $db->getAllValue($query,[$court_reg,$field_code,$code_cat]);

	foreach ($result_normal_info as $row)
	{
		$start_day[$count] 	= $row['start_day'];
		$end_day[$count] 	= $row['end_day'];
				
		if($number_of_day<=$end_day[$count] AND $number_of_day>=$start_day[$count])
		{ 
			$normal_price[$count] 	= $row['pricelist_online'];
			$register_time[$count]	= $row['register'];
		}
		else
		{
			$normal_price[$count] 	= 00000000;
			$register_time[$count]	= 00000000;
		}

		$start_time_normal[$count] 	= substr($register_time[$count], 0,2);
		$end_time_normal[$count]	= substr($register_time[$count], 4,2);

		// if($start_time<$start_time_normal[$count])
		// {
		// 	$result_1[$count]=0;
		// 	$result_2[$count]=0;
		// 	$skip="yes";
		// 	break;
		// }

		$count++;
	}
	
	if($skip=="no")
	{
		$maxloop 	= sizeof($normal_price);
		$loop		= 0;

		for($loop;$loop<$maxloop;$loop++)
		{ 
			if($start_time<$end_time_normal[$loop] AND $start_time>=$start_time_normal[$loop])
			{
				$result_1[$loop] 	= 1;
				$time_master 		= $end_time_normal[$loop];
			}
			else
			{
				$result_1[$loop] 	= 0;
				//$time_master		= $end_time;
			}

			if($end_time<=$end_time_normal[$loop] AND $end_time>$start_time_normal[$loop])
			{
				$result_2[$loop] 	= 1;
			}
			else
			{
				$result_2[$loop] 	= 0;
			}
		}
	}

	
	$maxloop_check	= sizeof($result_1);
	$loop			= 0;

	for($loop;$loop<$maxloop_check;$loop++)
	{
		if($result_1[$loop]==0 AND $result_2[$loop]==0)
		{
			$total[$loop] = (0*$normal_price[$loop]) + (0*$normal_price[$loop]);
		}

		if($result_1[$loop]==0 AND $result_2[$loop]==1)
		{	
			$total[$loop] = (0*$normal_price[$loop]) + (($end_time-$time_master)*$normal_price[$loop]);
		}	

		if($result_1[$loop]==1 AND $result_2[$loop]==0)
		{	
			$total[$loop] = (($time_master-$start_time)*$normal_price[$loop]) + (0*$normal_price[$loop]);
		}

		if($result_1[$loop]==1 AND $result_2[$loop]==1)
		{
			$total[$loop] = (($end_time-$start_time)*$normal_price[$loop]);
		}
	}

	$maxloop_addAll	= sizeof($total);
	$loop			= 0;

	for($loop;$loop<$maxloop_addAll;$loop++)
	{
		$final_total = $final_total + $total[$loop];
	}

	return $final_total;
}

?>