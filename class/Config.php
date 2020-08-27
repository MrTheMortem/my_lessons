<?php

class Config
{
    private static $attributes = [];

    public static function get($var, $default = null)
    {
        return self::$attributes[$var] ?? $default;
    }

    public static function set($var, $value)
    {
        self::$attributes[$var] = $value;
    }

    public static function setArray($params)
    {
        self::$attributes = array_merge(self::$attributes, $params);
    }

    public static function getAll()
    {
        return self::$attributes;
    }
}