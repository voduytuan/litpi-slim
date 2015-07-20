<?php

namespace Litpi;

/**
 * Utility Class de lam input cho WebSocket
 */
class WebSocketFeed
{
	public $uidreceiver = 0;
	public $emittype = '';	//type of emit used in server.js to navigate the receiver socket
    public $company = '';

    public function packing()
    {
        $data = array();

        foreach (get_object_vars($this) as $key => $value) {
            $data[$key] = $value;
        }

        return $data;
    }
}
