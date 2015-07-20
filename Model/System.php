<?php

namespace Model;

class System extends BaseModel
{
    public function __construct($id = 0)
    {

    }

    public function getUserInformation()
    {
        $info = array(
            'ip' => $_SERVER['REMOTE_ADDR'],
            'useragent' => $_SERVER['HTTP_USER_AGENT'],
            'requesturi' => $_SERVER['REQUEST_URI']
        );

        return $info;
    }
}
