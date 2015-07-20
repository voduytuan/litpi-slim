<?php

namespace Controller\V1;

class System extends \Controller\BaseController
{
    public function run()
    {
        $this->app->get('/v1/system', array($this, "get"));
        $this->app->get('/v1/system/:key', array($this, "get"));
    }

    public function get($key = '')
    {
        //Call model to get data
        $mySystem = new \Model\System();
        $information = $mySystem->getUserInformation();

        //because we have filter, so, we need to put return data to this new array
        $filteredInformation = array();
        if ($key != '') {
            if (isset($information[$key])) {
                $filteredInformation[$key] = $information[$key];
            }
        } else {
            $filteredInformation = $information;
        }

        //response in Json
        $this->renderJson($filteredInformation);

        return true;
    }
}
