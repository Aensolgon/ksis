<?php
$operation = $_REQUEST['operation'];
$current_dir = __DIR__ . $_REQUEST['current_dir'];
$fileName = $_REQUEST['filename'];
$content = explode('=',$_REQUEST['content']);

switch ($operation) {
    case 'list':
        return loadList($current_dir);
    case 'output':
        return editWord($current_dir, $fileName);
    case 'write':
        return writeWord($current_dir, $fileName, $content[1]);
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
        <div class='col-3'>" . number_format(filesize($current_dirrectory . "/" . $item) / 1024, 0). " kb" . "</div>
    </div>";
        }

    }
}

function editWord($current_dirrectory, $fileName)
{
    $massive = array_diff(scandir($current_dirrectory), ['.', '..']);
    $content = file_get_contents($current_dirrectory . '/' . $fileName);
    echo iconv("WINDOWS-1251", "UTF-8", "$content");
/*    mb_convert_encoding($content,'UTF-8');*/
    /*if(explode('.',$fileName)[1] == 'txt') {

    }else{
        echo htmlspecialchars($content,ENT_QUOTES);
    }*/
}

function writeWord($current_dirrectory, $fileName, $content)
{
    file_put_contents($current_dirrectory . '/' . $fileName, iconv("WINDOWS-1251", "UTF-8", $content));

    echo 'success';
}

?>