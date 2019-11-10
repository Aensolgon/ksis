<?php
$current_dir = __DIR__ . $_REQUEST['current_dir'];

$i = count(explode('/', $current_dir)) - 1;
$number = 0;
foreach (explode('/', $current_dir) as $k => $item) {
    if ($item !== __DIR__) {
        /*$number++;
        setcookie("path_dir[$number]", $item, time() + 3600);*/
        echo ($i == $k) ? "<li class=\"breadcrumb-item active\" aria-current=\"page\">" . ucfirst($item) . "</li>" :
            "<li class=\"breadcrumb-item\" aria-current=\"page\"><a href=\"#\">" . ucfirst($item) . "</a></li>";

    }
}
