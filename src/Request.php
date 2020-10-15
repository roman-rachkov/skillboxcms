<?php

namespace App;

use App\Traits\TSingleton;

class Request
{
    use TSingleton;

    protected static array $request;

    public static function __callStatic(string $name, array $args)
    {
        if(empty(self::$request)){
            self::$request = self::prepareData($_REQUEST);
        }
        return arrayGet(self::$request, $args[0]);
    }

    private static function prepareData($data)
    {
        if (is_array($data)) {
            $preparedArray = [];
            foreach ($data as $key => $datum) {
                $preparedArray[$key] = self::prepareData($datum);
            }
            return $preparedArray;
        }
        return mysqli_escape_string(htmlspecialchars(strip_tags($data)));
    }


}
