<?php
function dd($v) {
    \yii\helpers\VarDumper::dump($v, 10, true);
    exit();
}