<?php

namespace Controller;

abstract class BaseController
{
    protected $registry;
    protected $app;

    public function __construct(\Litpi\Registry $registry, \Slim\Slim $app)
    {
        $this->registry = $registry;
        $this->app = $app;
    }

    public function renderJson($jsondata)
    {
        header("Content-Type: application/json");
        echo json_encode($jsondata);
    }

    abstract public function run();
}
