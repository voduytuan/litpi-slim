<?php

namespace Controller;

use \Litpi\Registry as Registry;
use \Slim\Slim as Slim;

abstract class BaseController
{
    protected $registry;
    protected $app;

    public function __construct(Registry $registry, Slim $app)
    {
        $this->registry = $registry;
        $this->app = $app;
    }

    protected function renderJson($jsondata)
    {
        $this->app->response->headers->set('Content-Type', 'application/json');
        echo json_encode($jsondata);
    }

    /**
     * Get current page number in query (get, post, put)
     * It will be used in many place in GET method
     * @param string $pageParamName
     * @return int
     */
    protected function getCurrentPage($pageParamName = 'page')
    {
        $currentPageNumber = $this->app->request->params($pageParamName);

        if (is_null($currentPageNumber) || $currentPageNumber < 1) {
            $currentPageNumber = 1;
        }

        return (int)$currentPageNumber;
    }

    /**
     * Get record per page number, used for almost all GET request to query database to fetch data
     * @param int $hardLimit the limit of record per page,
     * if the argument is greater than this value, it will use this value as record per page
     * @param string $limitParamName
     * @return int
     */
    protected function getRecordPerPage($hardLimit = 50, $limitParamName = 'limit')
    {
        $recordPerPage = $this->app->request->params($limitParamName);

        if ($recordPerPage === null || $recordPerPage > $hardLimit) {
            $recordPerPage = $hardLimit;
        }

        return (int)$recordPerPage;
    }

    /**
     * Build query limit string (offset) base on current page and record perpage.
     * @param $currentPage
     * @param $recordPerPage
     * @return string
     */
    protected function getQueryLimit($currentPage, $recordPerPage)
    {
        return ($currentPage - 1 ) * $currentPage . ', ' . $recordPerPage;
    }

    abstract public function run();
}
