<?php

namespace Model;

class BaseModel
{
    public static function getInQuestionHolder($values)
    {
        return implode(',', array_fill(0, count($values), '?'));
    }
}
