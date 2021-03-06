<?php
// Подключение через Composer;
// require_once __DIR__ . '\New-Modules\vendor\autoload.php';
// Одна точка подключения, а далее можно использовать любые классы подключенных фреймворков, движков, шаблонизаторов, модулей;

/* Обычная автозагрузка с исп. ООП */
$p = __DIR__ . '\load.php';
require_once $p;
$loader = new Load();
spl_autoload_register([$loader, 'loadclass']);

// Reflection API of Method
$a = new ReflectionClass('Avrelii');
// Будет получен массив с обьектами;
$m1 = $a->getMethods();

foreach ($m1 as $m2) {
    //var_dump($m2);
    echo methodData($m2) . "<br>";
}

// Уточнение сложного типа данных:
// Получаем сложный тип данныых ReflectionMethod, далее работаем с его методами;
function methodData(ReflectionMethod $m2) {
    $d = "";
    $n = $m2->getName();
    if ($m2->isUserDefined()) {
        $d .= $n . ' - метод определен пользователем' . "<br>";
    }
    if ($m2->isInternal()) {
        $d .= $n . ' - внутренний метод' . "<br>";
    }
    if ($m2->isAbstract()) {
        $d .= $n . ' - абстрактный метод' . "<br>";
    }
    if ($m2->isPublic()) {
        $d .= $n . ' - публичный метод' . "<br>";
    }
    if ($m2->isProtected()) {
        $d .= $n . ' - защищенный метод' . "<br>";
    }
    if ($m2->isPrivate()) {
        $d .= $n . ' - приватный метод' . "<br>";
    }
    if ($m2->isStatic()) {
    $d .= $n . ' - статичный метод' . "<br>";
    }
    if ($m2->isFinal()) {
        $d .= $n . ' - финальный метод' . "<br>";
    }
    if ($m2->isConstructor()) {
        $d .= $n . ' - это конструктор' . "<br>";
    }
    if ($m2->returnsReference()) {
        $d .= $n . ' - метод возвращает ссылку, а не значение' . "<br>";
    }
    return $d;
}

/* Прочитать код метода */
class ReflectionUtil {
    static function GMS(ReflectionMethod $m) {
        $lines = @file($m->getFileName());  // фактически здесь уже есть весь код класса, а нужно извлечь только код конкретного метода;
        $from = $m->getStartLine();
        $to = $m->getEndLine();
        $len = $to - $from + 1;
        return implode(array_slice($lines, $from-1, $len));
        //return var_dump($lines);
    }
}
$method = $a->getMethod('ps');
//var_dump($method);
echo ReflectionUtil::GMS($method);
