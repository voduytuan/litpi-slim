<?php

namespace Litpi;

/**
 * Utility Class de request (cURL) toi websocket server de trigger 1 action cho nguoi nao do trong cac socket connect
 */
class WebSocket
{
	public static function push($messages)
	{
		global $registry;

		//at least send to one user
		if (count($messages) > 0) {

			$paramString = 'data='.json_encode(array('messages' => $messages));

			$parts=parse_url($registry->setting['site']['websocketurl']);

			$fp = fsockopen($parts['host'],
				  isset($parts['port'])?$parts['port']:80,
				  $errno, $errstr, 30);

			if (!$fp) {
				return false;

			} else {
				$out = "POST ".$parts['path']."?".$parts['query']." HTTP/1.1\r\n";
				$out.= "Host: ".$parts['host']."\r\n";
				$out.= "Content-Type: application/x-www-form-urlencoded\r\n";
				$out.= "Content-Length: ".strlen($paramString)."\r\n";
				$out.= "Connection: Close\r\n\r\n";
				if ($paramString != '') {
					$out.= $paramString;
				}

				fwrite($fp, $out);
				fclose($fp);
				return true;
			}
		}

	}
}
