<?php 
class API{
	public $type;
	public $result;
	public $ship;
	public $data;
	function __construct(){

		$this->type=!empty($type) ? $type : '';
		$this->result=!empty($result) ? $result :'';
		$this->ship=!empty($ship) ? $ship : '';
		$this->data=!empty($data) ? $data : '';
	}
	function MainShip($type,$data,$data_key){
		switch($type){
			case 11:
			return $this->GetShipVietTelPOST($data,$data_key);
			break;
		}
	}
	function MainCreateOrder($type,$data,$data_key){
		switch($type){
			case 12:
			return $this->CreateOrderVietTelPOST($data,$data_key);
			break;
		}
	}
	function MainDeleteOrder($type,$data){
		switch($type){
			case 9:
			return  $this->DeleteOrderVietTelPOST($data);
			break;  
		}
	}
	
	function GetShipVietTelPOST($postData,$postData_Key){
		$result=$this->LoginVT($postData_Key);	
		$Token=json_decode($result,true);
		$Token = $Token['data']['token'];
		
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://partner.viettelpost.vn/v2/order/getPriceAll",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => json_encode($postData),
			CURLOPT_HTTPHEADER => array(
				"cache-control: no-cache",
				"content-type: application/json",
				"Token: ".$Token.""
			),
		));

		$response_ship = curl_exec($curl);
		curl_close($curl);
		return $response_ship;
		
	}

	
	function CreateOrderVietTelPOST($postData,$data_key){
		
		$result=$this->LoginVT($data_key);	
		$Token=json_decode($result,true);
		$Token = $Token['data']['token'];
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://partner.viettelpost.vn/v2/order/createOrder",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => $postData,
			CURLOPT_HTTPHEADER => array(
				"cache-control: no-cache",
				"content-type: application/json",
				"Token: ".$Token.""
			),
		));
		
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		return $response;
	}
	function LinkPrintBill($id_order,$data_key){
		$result=$this->LoginVT($data_key);	
		$Token=json_decode($result,true);
		$Token = $Token['data']['token'];

		$data['TYPE'] = 2;
		$data['EXPIRY_TIME'] = (time()+(86400*10))*1000;
		$data['ORDER_ARRAY'] = array($id_order);
		
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://partner.viettelpost.vn/v2/order/printing-code",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => json_encode($data),
			CURLOPT_HTTPHEADER => array(
				"cache-control: no-cache",
				"accept: */*",
				"content-type: application/json",
				"Token: ".$Token.""
			),
		));
		
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		return $response;
	}
	function LoginVT($postData_Key){
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://partner.viettelpost.vn/v2/user/Login",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => json_encode($postData_Key),
			CURLOPT_HTTPHEADER => array(
				"cache-control: no-cache",
				"content-type: application/json"
			),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		return $response;
	}
	function GetInfoKhoVT(){
		$result=LoginVT();
		$Token=json_decode($result,true);
		$curl = curl_init();
		
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.viettelpost.vn/api/setting/listInventory",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => "",
			CURLOPT_HTTPHEADER => array(
				"cache-control: no-cache",
				"content-type: application/json",
				"postman-token: ae9fc9ed-7d6b-4dbf-7915-10e437263396",
				"token: ".$Token['TokenKey'].""
			),
		));
		
		$response = curl_exec($curl);
		
		$err = curl_error($curl);
		
		curl_close($curl);
		
		return $response;
	}
	
	function GetServiceVT($id) {
		$curl = curl_init();
		$data["TYPE"]=$id;
		
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.viettelpost.vn/api/setting/listService",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => json_encode($data),
			CURLOPT_HTTPHEADER => array(
				"cache-control: no-cache",
				"content-type: application/json"
			),
		));
		
		$response = curl_exec($curl);
		
		$err = curl_error($curl);
		curl_close($curl);
		$Service=json_decode($response,true);
		
		return $response;
	}
	
	
	function GetProvinceVTPOST(){
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.viettelpost.vn/api/setting/listallprovince",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"cache-control: no-cache",
				"postman-token: 2d50c1d0-2ba7-cc6a-1dac-b745ff1ac1d6"
			),
		));
		
		$response = curl_exec($curl);
		$err = curl_error($curl);
		
		curl_close($curl);
		
		return $response;
		
	}
	
	function GetDistrictVT(){
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.viettelpost.vn/api/setting/listalldistrict",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"cache-control: no-cache",
				"postman-token: 2d50c1d0-2ba7-cc6a-1dac-b745ff1ac1d6"
			),
		));
		
		$response = curl_exec($curl);
		$err = curl_error($curl);
		
		curl_close($curl);
		
		return $response;
	}

	function DeleteOrderVietTelPOST($postData){
		$result=$this->LoginVT();	
		$Token=json_decode($result,true);
		$Token = $Token['data']['token'];
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://partner.viettelpost.vn/v2/order/UpdateOrder",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => json_encode($postData),
			CURLOPT_HTTPHEADER => array(
				"cache-control: no-cache",
				"content-type: application/json",
				"Token: ".$Token.""
			),
		));
		
		$response = curl_exec($curl);
	
		$err = curl_error($curl);
		curl_close($curl);
		return $response;
	}


	function orderFunctionInfo($id_order,$data_key){
		$result=$this->LoginVT($data_key);


		$Token=json_decode($result,true);
		$Token = $Token['data']['token'];
		ww($Token);
		//$data['TYPE'] = 2;
		//$data['EXPIRY_TIME'] = (time()+(86400*10))*1000;
		//$data['ORDER_ARRAY'] = array($id_order);

		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.viettelpost.vn/api/orders/impactHistoryOrder/19258224313",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			//CURLOPT_POSTFIELDS => json_encode($data),
			CURLOPT_HTTPHEADER => array(
				"cache-control: no-cache",
				"accept: */*",
				"content-type: application/json",
				"Token: ".$Token.""
			),
		));

		$response = curl_exec($curl);
		ww($response);
		$err = curl_error($curl);
		curl_close($curl);
		return $response;
	}


	//https://api.viettelpost.vn/api/utils/getTimeExpected
	//https://api.viettelpost.vn/api/supperapp/get-list-status-category-code-v2
	//https://api.viettelpost.vn/api/orders/orderFunctionInfo?maPhieuGui=19258224313
	//https://api.viettelpost.vn/api/user/getAppCreateOrderSettings?cusId=13317764
	//https://api.viettelpost.vn/api/user/getAppCreateOrderSettings?cusId=13317764
	//https://api.viettelpost.vn/api/setting/getOrderPostman?order_number=19258224313&type=4
	//https://api.viettelpost.vn/api/setting/listOrderTrackingVTP3?OrderNumber=19258224313
	//https://api.viettelpost.vn/api/orders/impactHistoryOrder/19258224313

}
?>
