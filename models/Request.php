<?php
class Request
{
    public function method($method = null)
    {
        if(!empty($method))
            return strtolower($_SERVER['REQUEST_METHOD']) == strtolower($method);
        return $_SERVER['REQUEST_METHOD'];
    }
    /**
     * Возвращает переменную _GET, отфильтрованную по заданному типу, если во втором параметре указан тип фильтра
     * Второй параметр $type может иметь такие значения: integer, string, boolean
     * Если $type не задан, возвращает переменную в чистом виде
     */
    public function get($name, $type = null)
    {
        $val = null;
        if(isset($_GET[$name]))
            $val = $_GET[$name];

        if(!empty($type) && is_array($val))
            $val = reset($val);

        if($type == 'string')
            return strval(preg_replace('/[^\p{L}\p{Nd}\d\s_\-\.\%\s]/ui', '', $val));

        if($type == 'integer')
            return intval($val);
        if($type == 'boolean')
            return !empty($val);

        return $val;
    }
    /**
     * Возвращает переменную _POST, отфильтрованную по заданному типу, если во втором параметре указан тип фильтра
     * Второй параметр $type может иметь такие значения: integer, string, boolean
     * Если $type не задан, возвращает переменную в чистом виде
     */
    public function post($name = null, $type = null)
    {
        $val = null;
        if(!empty($name) && isset($_POST[$name]))
            $val = $_POST[$name];
        elseif(empty($name))
            $val = file_get_contents('php://input');

        if($type == 'string')
            return strval(preg_replace('/[^\p{L}\p{Nd}\d\s_\-\.\%\s]/ui', '', $val));

        if($type == 'float')
            return floatval(preg_match("|^[\d]*[\.,]?[\d]*|", $val));

        if($type == 'integer')
            return intval($val);
        if($type == 'boolean')
            return !empty($val);
        return $val;
    }
    /**
     * Возвращает переменную _FILES
     * Обычно переменные _FILES являются двухмерными массивами, поэтому можно указать второй параметр,
     * например, чтобы получить имя загруженного файла: $filename = $simpla->request->files('myfile', 'name');
     */
    public function files($name, $name2 = null)
    {
        if(!empty($name2) && !empty($_FILES[$name][$name2]))
            return $_FILES[$name][$name2];
        elseif(empty($name2) && !empty($_FILES[$name]))
            return $_FILES[$name];
        else
            return null;
    }

    /**
     * @param $name
     * @return bool|string
     */
    public function uploadImgFile($name)
    {
    // Пути загрузки файлов
        $uploaddir = '../uploads/image/';
    // Массив допустимых значений типа файла
    $types = array('image/gif', 'image/png', 'image/jpeg', 'image/jpg');
    // Максимальный размер файла
    $size = 102600;

    // Обработка запроса
        // Проверяем тип файла
        if (!in_array($_FILES[$name]['type'], $types)) {
            echo 'format';
            return false;
        }
        // Проверяем размер файла
        if ($_FILES[$name]['size'] > $size) {
            return false;

        }
        $uploadfile = $uploaddir . basename(CoreAdmin::translit($_FILES[$name]['name']));
        echo 'good';
        if (move_uploaded_file($_FILES[$name]['tmp_name'], $uploadfile)) {
            echo "Файл корректен и был успешно загружен.\n";
        } else {
            echo "Возможная атака с помощью файловой загрузки!\n";
        }
    }
    public function pregmatchPrice($price)
    {
        if (!preg_match("|^[\d]*[\.,]?[\d]*|",$price)) {
            return false;
        } else {
            return round(floatval(str_replace(",",".",$price)),2);
        }

    }
}