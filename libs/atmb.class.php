<?php

Class ATMB
{
	
	protected $username 		= "Maufutsal";
	protected $password 		= "Maufutsal2016";
	//protected $username 		= "ramlan.hutapea@gmail.com";
	//protected $password 		= "Amanda2528";
	protected $secretkey 		= "h5J43l6V";
	public $respons 		= null;

	public function signatureAlternativeOne()
	{
		return MD5($this->username.$this->password.$this->secretkey);
	}

	public function signatureAlternativeTwo($id_booking)
	{
		return MD5($this->username.$this->password.$id_booking);
	}

	public function signatureAlternativeThree($id_booking)
	{
		return MD5($this->username.$this->secretkey.$id_booking);
	}

	public function endPointRequestPaymentCodeBersamaID()
	{
		//$url = "https://bersama.id/portal/index.php/api/tfp/generatePaymentCode";
		$url = "https://tfp.bersama.id/biller-webapi-service/partner_api/controller/PaymentCodeRequest.php";
		return $url;
	}

	public function endPointRequestPaymentCodeBersamaIDPro()
	{
		//$url = "https://atmbplus.artajasa.co.id:8443/partner_api/controller/PaymentCodeRequest.php";
		$url = "https://tfp.bersama.id/biller-webapi-service/partner_api/controller/PaymentCodeRequest.php";
		return $url;
	}

	public function endPointTransactionStatusInquery()
	{
		//$url = "https://bersama.id/portal/index.php/api/tfp/inquiryStatus";
		$url = "https://tfp.bersama.id/biller-webapi-service/partner_api/controller/TransactionStatusInquiryMulti.php";
		return $url;
	}

	public function endPointTransactionStatusInqueryPro()
	{
		//$url = "https://atmbplus.artajasa.co.id:8443/partner_api/controller/TransactionStatusInquiryMulti.php";
		$url = "https://tfp.bersama.id/biller-webapi-service/partner_api/controller/TransactionStatusInquiryMulti.php";
		return $url;
	}

	public function getUsername()
	{
		return $this->username;
	}

	public function ackResPaymentCode($data)
	{
		if($data=="00")
		{
			$this->respons = "Transaction Success";
		}
		else if($data=="01")
		{
			$this->respons = "Transaction Success";
		}
		else
		{
			$this->respons = "Unknown Acknowledge";
		}
		return $this->respons;
	}


	public function requestPaymentCodeBersamaID($id_booking,$id_user,$cust_name,$amount,$date_transaction,$id_product,$signature,$username)
	{
		$interval	= 120;

		$data="<?xml version=\"1.0\" ?>
		<data>
		    <type>reqpaymentcode</type>
		    <bookingid>$id_booking</bookingid>
		    <clientid>$id_user</clientid>
		    <customer_name>$cust_name</customer_name>
		    <amount>$amount</amount>
		    <productid>$id_product</productid>
		    <interval>$interval</interval>
		    <username>$username</username>
		    <booking_datetime>$date_transaction</booking_datetime>
		    <signature>$signature</signature>
		</data>";
		return $data; 
	}



	public function parserXMLResponsePaymentCode($data)
	{
		$respons="";
		$xml 	= simplexml_load_string($data);
		$ack 	= $xml->ack[0];
		$type 	= $xml->type[0];

		$ack_info = $this->ackResPaymentCode($ack);

		if($ack_info=="Transaction Success")
		{
			if($type=="respaymentcode")
			{
				$respons = $xml->vaid[0].",".$xml->bankcode[0].",".$xml->bookingid[0].",".$xml->signature[0];
			}
			else
			{

			}
		}

		return $respons;
	}


	public function requestPaymentCode($data,$service_url)
	{
		$result = null; 
		$data_xml = $data;
		
		$headers = array(
                "Content-type: application/xml",
                "Accept: text/xml",
                "Cache-Control: no-cache",
                "Pragma: no-cache",
                "Content-length: ".strlen($data_xml),
            	);
            
		$curl = curl_init();
		
		curl_setopt($curl,CURLOPT_URL,$service_url);
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($curl,CURLOPT_POST,true);
		curl_setopt($curl,CURLOPT_POSTFIELDS,"$data_xml");
		curl_setopt($curl,CURLOPT_HEADER, 0);
		curl_setopt($curl, CURLOPT_TIMEOUT, 120);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($curl);
		

		if(curl_errno($curl))
		{
			print curl_error($curl);
		}
	    else
	    {
		    curl_close($curl);
		}

		return $result;
		//return curl_exec($curl);
	}
}

?>