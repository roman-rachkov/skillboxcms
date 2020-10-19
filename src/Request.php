<?php

namespace App;

use App\Traits\TSingleton;
use Valitron\Validator;

class Request
{
    /**
     * Возвращает значение из массива запроса или же сам массив если ключ отсутсвует.
     * Если массив не существует возвращет false
     * @param string $name
     * @param array $args
     * @return bool|mixed|null
     */
    public static function __callStatic(string $name, array $args)
    {
        $key = '_' . strtoupper($name);
        if (array_key_exists($key, $GLOBALS)) {
            $arr = self::prepareData($GLOBALS[$key]);
            $key = $args[0] ?? '';
            return arrayGet($arr, $key, $arr);
        }
        return false;
    }

    /**
     * Возвращает обьект валидатора
     * @param $data данные для валидации
     * @return Validator
     */
    public static function createValidator($data)
    {
        return new Validator($data);
    }

    /**
     * Подготавливает данные от иньекции
     * @param $data
     * @return array|string
     */
    private static function prepareData($data)
    {
        if (is_array($data)) {
            $preparedArray = [];
            foreach ($data as $key => $datum) {
                $preparedArray[$key] = self::prepareData($datum);
            }
            return $preparedArray;
        }
        return trim(htmlspecialchars($data, ENT_QUOTES));
    }


}
