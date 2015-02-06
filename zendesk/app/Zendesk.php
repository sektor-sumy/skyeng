<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Zendesk extends Model {

	const ZDAPIKEY = "OwyKEl31oENRu4OQXk0HhTCbZIxLL9wJwtOI4Blw";
	const ZDUSER = "sektorsumy@gmail.com";
	const ZDURL = "https://testfsn.zendesk.com/api/v2";

	/* Note: do not put a trailing slash at the end of v2 */
	public static function curlWrap($url, $json, $action)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 10 );
		curl_setopt($ch, CURLOPT_URL, self::ZDURL.$url);
		curl_setopt($ch, CURLOPT_USERPWD, self::ZDUSER."/token:".self::ZDAPIKEY);
		switch($action){
		case "POST":
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
		break;
		case "GET":
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		break;
		case "PUT":
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
		break;
		case "DELETE":
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		break;
		default:
		break;
		}
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
		curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		$output = curl_exec($ch);
		curl_close($ch);
		$decoded = json_decode($output);
		return $decoded;
	} 
}
