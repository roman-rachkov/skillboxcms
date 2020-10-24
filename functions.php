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
function redirect(string $path = '/')
{
    header('Location: '.$path, true, 302);
}

/**
 * Проверяет вышло ли время сессии и если это так пересоздает ее и отправляет пользователя на авторизацию
 * @param int $timeout время жизни сесси в секундах
 */
function startSession($timeout = 1200)
{
    $params = [
        'name' => 'session_id',
        'cookie_lifetime' => $timeout,
        'gc_maxlifetime' => $timeout,
    ];
    session_start($params);
    setcookie(session_name(), session_id(), time() + $timeout, '/');
}

/**
 * Выводит сообщение об ошибки заполнения поля
 * @param $errors
 */
function printInputErrors($errors)
{
    echo '<ul class="red-text text-darken-2">';
    foreach ($errors as $error) {
        echo '<li>'.$error.'</li>';
    }
    echo '</ul>';
}

/**
 * Длбавляет ошибкуи в массив сессии для последующего вывода
 * @param $error
 */
function setError($error){
    $_SESSION['errors'][] = $error;
}

/**
 * Выводит массив с ошибками и очищает массив
 */
function printErrors(){
    if(!empty($_SESSION['errors'])) {
        echo '<div class="errors"><ul>';
        foreach ($_SESSION['errors'] as $error){
            echo '<li>'.$error.'</li>';
        }
        echo '</ul></div>';
        unset($_SESSION['errors']);
    }
}

function setSuccess($success){
    $_SESSION['success'][] = $success;
}

function printSuccess(){
    if(!empty($_SESSION['success'])) {
        echo '<div class="success"><ul>';
        foreach ($_SESSION['success'] as $item){
            echo '<li>'.$item.'</li>';
        }
        echo '</ul></div>';
        unset($_SESSION['item']);
    }
}