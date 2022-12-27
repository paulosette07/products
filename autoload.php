<?php

/**
 * Camada - Controller
 * Diretório Pai - library
 * Arquivo - autoload.php
 * */

/**
 * Essa função garante que todas as classes 
 * da pasta lib serão carregadas automaticamente
 */
//function __autoload($class) {
//    $BaseDIR = 'library';
//    $listDir = scandir(realpath($BaseDIR));
//    if (isset($listDir) && !empty($listDir)) {
//        foreach ($listDir as $listDirkey => $subDir) {
//            $file = $BaseDIR . DIRECTORY_SEPARATOR . $subDir . DIRECTORY_SEPARATOR . $class . '.php';
//            if (file_exists($file)) {
//                require $file;
//            }
//        }
//    }
//}
session_start();

function Autoload($class) {
    $extension = spl_autoload_extensions();
    
    $BaseLibDIR = 'Library';
    $listLibDir = scandir(realpath($BaseLibDIR));
    if (isset($listLibDir) && !empty($listLibDir)) {
        $file = $class . $extension;
        if (file_exists($file)) {
            echo $file."<br />";
            require_once $file;
        }
    }
}

spl_autoload_extensions('.php');
spl_autoload_register('Autoload');