<?php

/**
 * Добавляет в сессию данные дебага, для последующего удобного вывода
 * @param mixed $var переменная
 * @param bool $explode Разбивать ли эллементы массива на отдельные части?
 */
function debug($var, $explode = false)
{
    if (DEBUG) {
        $tmp = debug_backtrace()[0];
        $backTrace = $tmp['file'] . ':' . $tmp['line'];
        ob_start();
        echo '<hr>';
        echo $backTrace;
        echo '<hr>';
        echo '<pre>';

        if (is_array($var) && $explode) {
            foreach ($var as $key => $value) {
                var_dump([$key => $value]);
                echo '<hr>';
            }
        } else {
            var_dump($var);
        }

        echo '</pre><hr>';
        $_SESSION['debug'][] = ob_get_clean();
    }
}

/**
 * Вызывает отладку и сразу же умерает
 * @param $var
 * @param bool $explode
 */
function dd($var, $explode = false)
{
    debug($var, $explode);
    die(printDebug());
}

/**
 * Выводит отладочную информацию в удобном виде
 */
function printDebug()
{
    if (DEBUG && !empty($_SESSION['debug'])) :?>
        <div class="debug container" style="margin-top: 20px;">
            <?php foreach ($_SESSION['debug'] as $key => $debug) : ?>
                <?= $debug ?>
            <?php endforeach; ?>

        </div>
        <?php
        unset($_SESSION['debug']);
    endif;
}

/**
 * Устанавливает в строке пути файловой системы нормальные разделители директорий
 * @param $str
 * @return mixed
 */
function setNormalSlashes($str)
{
    return str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $str);
}

/**
 * Возвращает из многомерного массива эллемент по ключу разделенного "."
 * @param array $array
 * @param string $key
 * @param null $default
 * @return mixed|null
 */
function arrayGet(array $array, string $key, $default = null)
{
    if (is_null($key)) {
        return $array;
    }

    if (isset($array[$key])) {
        return $array[$key];
    }

    foreach (explode('.', $key) as $segment) {
        if (!is_array($array) || !array_key_exists($segment, $array)) {
            return value($default);
        }

        $array = $array[$segment];
    }

    return $array;
}

/**
 * Подключает шаблон из папки VIEW_DIR по его имени, если файл находится в подкатологе то указывается путь до файла через '\'
 * @param $templateName
 * @param $data
 */
function includeView($templateName, $data = [])
{
    $file = VIEW_DIR . DIRECTORY_SEPARATOR . setNormalSlashes($templateName) . '.php';
    if (file_exists($file)) {
        extract($data);
        require_once $file;
    }
}

/**
 * Выполняет перенаправление по указанному адресу
 * @param string $path
 */
function redirect(string $path = '/'){
    header('Location: '.$path, true, 302);
}


function travers($categories, $prefix = '-'){
    foreach ($categories as $category){
        echo nl2br(PHP_EOL.$prefix.' '.$category->name);
        travers($category->children, $prefix.'-');
    }
}

/**
 * Выводит сообщение об ошибки заполнения поля
 * @param $errors
 */
function printInputErrors($errors){
    echo '<ul class="red-text text-darken-2">';
    foreach ($errors as $error){
        echo '<li>'.$error.'</li>';
    }
    echo '</ul>';
}