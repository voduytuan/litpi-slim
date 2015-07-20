<?php

namespace Litpi\Model;

abstract class BaseModel extends \stdClass
{
    protected $db;

    public function __construct()
    {
        $this->db = self::getDb();
    }

    public function __sleep()
    {
           $this->db = null;

           return $this;
    }

    public function copy(\stdClass $object)
    {
        foreach (get_object_vars($object) as $key => $value) {
            $this->$key = $value;
        }
    }

    public static function getDb()
    {
        $registry = \Litpi\Registry::getInstance();
        return $registry->get('db');
    }

    /**
    * Luu thong tin vao cache
    *
    */
    public static function cacheSet($key, $value)
    {
        $registry = \Litpi\Registry::getInstance();
        $setting = $registry->get('setting');

        $myCacher = new \Litpi\Cacher($key);

        $duration = $setting['apc']['shortDelay'];

        return $myCacher->set($value, $duration);
    }
}
