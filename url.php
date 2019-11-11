<?php
$operation = $_REQUEST['operation'];
$current_dir = __DIR__ . $_REQUEST['current_dir'];

switch ($operation) {
    case 'list':
        return loadList($current_dir);

    case 'open':
        echo 'sdasdasd';
        break;
}

function loadList($current_dirrectory)
{
    $massive = array_diff(scandir($current_dirrectory), ['.', '..']);
    if (empty($massive)) {
        echo "<div class='col-12 d-flex justify-content-center h-100 align-items-center'>Папка пуста</div>";
    } else {
        foreach ($massive as $item) {
            $image = explode(".", $item)[1];
            $data = (empty($image)) ? 'folder' : $image;
            $src = ($image !== null) ? 'images/' . "$image" . '.png' : 'images/folder.png';
            echo "<div class='col-12 inner'>
        <div class='col-3 pointer' data-type='$data' data-name='$item'>";
            echo "<img class='img-fluid' src='$src'> <span>$item</span>";
            echo "</div>
        <div class='col-3'>я</div>
        <div class='col-3'>" . date('d M. Y г.', filemtime($current_dirrectory . "/" . $item)) . "</div>
        <div class='col-3'>" . filesize($current_dirrectory . "/" . $item) . "</div>
    </div>";
        }

    }
}

?>