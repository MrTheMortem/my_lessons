<?php

class Core {
    public static function clearVar($var)
    {
        return trim(htmlspecialchars(stripslashes($var)));
    }
}