<?php

/**
  Used to connect with the Database

  @category Partner-Payment
  @package  PHP
  @author   sumit kumar <sumit.kumar@qualtech-consultants.com>
  @modified Sanjeev Kumar on 01-June-2017
  @license  2016 Qualtech-consultants pvt ltd.
  @link     http://tractus.religarehealthinsurance.com/
 * */
include_once(__DIR__.'/crypto-functions.php');
define('DATABASE_CONNECTION_MESSAGE','Unable to connect database');
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
/**
 * Used to connect with database
 *  
 * @return boolean
 */
function db_connect($isPDO=false) 
{
$password = ''
    // Production DB Connection
	$environment = "";
	if(isset($_SERVER["RunningServer"])):
		$environment = $_SERVER["RunningServer"];
	else:
		$environment = (isset($_SERVER['argv'])) ? $_SERVER['argv'][1]: "";
	endif;
    switch ($environment) {
        case "PRODUCTION":
            //Variables
            $db_hostName = "10.91.5.73";
            $db_serviceName = "rhprod"; //defined db name
            $db_username = trim(decrypt_data_new('luh8ODlyTIo/VRgHEGeD/A=='));
            $db_password = trim(decrypt_data_new('luh8ODlyTIo/VRgHEGeD/A==')); //define db password
            $db_hostPort = "2529"; //defined host name
            break;
        case "STAGING" :
            //Variables
			$dbDetails = vaultDB();
            $db_hostName = "10.91.14.70";
            $db_serviceName = "rhstage"; //defined db name
            $db_username = $dbDetails[0];
            $db_password = $dbDetails[1];
            $db_hostPort = "2529"; //defined host name
            break;
        case "UAT" :
            //Variables
            $db_hostName = "10.91.14.70";
            $db_serviceName = "propdev"; //defined db name
            $db_username = trim(decrypt_data_new('luh8ODlyTIo/VRgHEGeD/A=='));//define db username
            $db_password = trim(decrypt_data_new('luh8ODlyTIo/VRgHEGeD/A==')); //define db password
            $db_hostPort = "2529"; //defined host name
            break;
        case "QC" :
            //*Variables
           /* $db_hostName = "10.216.30.112";
            $db_serviceName = "propdev"; //defined db name
            $db_username 		= trim(decrypt_data_new('5pdXLNe+FsSs6GkvUjMdvw==')); //define db username
            $db_password 		= trim(decrypt_data_new('3kv96VVoBWW8hPLjWCbHpw==')); //define db password
            $db_hostPort = "1521"; //defined host name
            */
            $db_hostName = "10.91.14.70";
            $db_serviceName = "propdev"; //defined db name
            $db_username 		= trim(decrypt_data_new('fcyvXEb4q2Uv3aT4QV36bg==')); //define db username
            $db_password 		= trim(decrypt_data_new('fcyvXEb4q2Uv3aT4QV36bg==')); //define db password
            $db_hostPort = "3529"; //defined host name
            break;
        case "DEVELOPMENT" :
            //Variables
            /* $db_hostName = "10.216.30.112";
            $db_serviceName = "propdev"; //defined db name
            $db_username 		= trim(decrypt_data_new('5pdXLNe+FsSs6GkvUjMdvw==')); //define db username
            $db_password 		= trim(decrypt_data_new('3kv96VVoBWW8hPLjWCbHpw==')); //define db password
            $db_hostPort = "1521"; */
            $db_hostName = "10.91.14.70";
            $db_serviceName = "propdev"; //defined db name
            $db_username 		= 'RHICLQC'; //define db username
            $db_password 		= 'QK#F73jb0X2fST'; //define db password
            $db_hostPort = "3529"; //defined host name
            break;
        default:
            //Variables
            $db_hostName = "10.91.5.73";
            $db_serviceName = "rhprod"; //defined db name
            $db_username = trim(decrypt_data_new('luh8ODlyTIo/VRgHEGeD/A=='));
            $db_password = trim(decrypt_data_new('luh8ODlyTIo/VRgHEGeD/A==')); //define db password
            $db_hostPort = "2529"; //defined host name
    }


    // Connection  string with Oracle
    if($isPDO)
	{
		$tns = "(DESCRIPTION =(ADDRESS = (PROTOCOL = TCP)(HOST = $db_hostName)(PORT = $db_hostPort))(CONNECT_DATA =(SERVER = DEDICATED)(SERVICE_NAME = $db_serviceName)))";
		$pdo_string = 'oci:dbname='.$tns;
		$conn = new PDO($pdo_string, $db_username, $db_password);
		if ($conn) { //Checking if the db coonection is made or not
			return $conn;
		}
	}else
	{
		$conn = oci_connect($db_username, $db_password, "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=" . $db_hostName . ")(PORT=" . $db_hostPort . "))(CONNECT_DATA=(SERVICE_NAME=" . $db_serviceName . ")))");
		if ($conn) { //Checking if the db coonection is made or not
			return $conn;
		}
	}
    return false;
}
/*
   Function name    :db_connect_mysql()
   Description      :Function used for common connection for mysql database
   Author           :Hemant Pargain
   Date             :27th Nov2017
*/
 function db_connect_mysql(){
    try{
	$environment = "";
	if(isset($_SERVER["RunningServer"])):
		$environment = $_SERVER["RunningServer"];
	else:
		$environment = (isset($_SERVER['argv'])) ? $_SERVER['argv'][1]: "";
	endif;
        switch ($environment) {
            
            case "PRODUCTION":
                $db_hostName = "10.91.5.101";
                $db_username = trim(decrypt_data_new('N90NLg+++25fecf9j+OuUg==')); //define db username
                $db_password = trim(decrypt_data_new('3VyWi4ei8EstFqtjtVCEIg==')); //define db password
                $db_name = "webenrol";   // database name
                //Variables
                break;
            case "STAGING" :
                $db_hostName = "10.91.14.101";
                $db_username = trim(decrypt_data_new('4sI/nvjlxwpCWzJguTMK5g==')); //define db username
                $db_password = trim(decrypt_data_new('mddVdzCDPE66M6Oz0bosfA==')); //define db password
                $db_name = "webenrol";   // database name
                //Variables
                break;
            case "UAT" :
                //Variables
                $db_hostName = "10.91.14.101";
		$db_username = trim(decrypt_data_new('lLzxrYDZuYtkRT3Hz2rDUg==')); //define db username
                $db_password = trim(decrypt_data_new('mddVdzCDPE66M6Oz0bosfA==')); //define db password
                $db_name = "webenrol";   // database name
                
                break;
            case "QC" :
                //Variables
                $db_hostName = "10.216.9.157";
                $db_username = trim(decrypt_data_new('AigpQ+Hoa4gTzZiXeILnTQ==')); //define db username
                $db_password = trim(decrypt_data_new('ASZVIM9hWnA6T6ZrRAk+bg==')); //define db password
                $db_name = "webenrol";   // database name
                break;
            case "DEVELOPMENT" :
                //Variables
                $db_hostName = "10.91.14.102";
                $db_username = 'chiweb_qc'; //define db username
                $db_password = 'Zg!@2op8%7kEQc'; //define db password
                $db_name = "CHIMYSQWEB001";   // database name
                break;
            default:
                $db_hostName = "10.91.5.101";
                $db_username = trim(decrypt_data_new('N90NLg+++25fecf9j+OuUg==')); //define db username
                $db_password = trim(decrypt_data_new('3VyWi4ei8EstFqtjtVCEIg==')); //define db password
                $db_name = "webenrol";   // database name
            //Variables
        }
     $conn = mysqli_connect($db_hostName,$db_username,$db_password,'','3939');
        if($conn){
            if(mysqli_select_db($conn, $db_name)){ // assign connection and database name
                return $conn;
            }
			else{
               //echo "Failed to select database"; 
               return FALSE;
            }
        }else{
            //echo "Failed to connect to MySQL";
            return FALSE;
        }
    }catch(Exception $e){
        echo 'Error Message:',var_dump($e->getMessage());//caught exception and error display
    }
}

function disableCaptcha($conn)
{
    $environment = $_SERVER["RunningServer"];
    if($environment == 'QC' || $environment == 'UAT'|| $environment == 'DEVELOPMENT'){
        if($conn){
            $query = "SELECT VALUE FROM CRMCOMMONCONF WHERE CONFNAME = 'DISABLE_CAPTCHA'";
            $sql = @oci_parse($conn, $query);
            $res = oci_execute($sql);
            if (!$res) {
                return false;
            }
            $row = oci_fetch_assoc($sql);
            return $row['VALUE'];
        }
    }
    return false;
}

function vaultDB() {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,  'http://10.91.15.25:8200/v1/careinsurance/tractus');
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		"X-Vault-Token: s.4qC0cCwIcurlXNswTaOdzHwJ"
	));
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_VERBOSE, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 60);
	$response = curl_exec($ch);
	$responseDecode = json_decode($response,true);
	if(isset($responseDecode['errors']) && empty($responseDecode['errors'])) {
		print_r($responseDecode);
		die;
	}
	return [$responseDecode['data']['dbusername'],$responseDecode['data']['dbpassword']];
}
?>
