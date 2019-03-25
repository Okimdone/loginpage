<?php
    // Smarty template s declaration
    $path = $_SERVER['DOCUMENT_ROOT'] ;//Delete after setting the loginpage/ as the Document_ROOT

    require "$path/php/Smarty/Smarty.class.php";
    $smarty = new Smarty();

    $smarty->template_dir = "$path/V/templates";
    $smarty->compile_dir  = "$path/V/templates_c";
    $smarty->cache_dir    = "$path/V/cache";
    $smarty->config_dir   = "$path/V/configs";