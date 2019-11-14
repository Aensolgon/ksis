<?php
$operation = $_REQUEST['operation'];
$current_dir = __DIR__ . $_REQUEST['current_dir'];
$fileName = $_REQUEST['filename'];
$content = explode('=', $_REQUEST['content'])[1];
$createFile = explode('=', $_REQUEST['file'])[1];
$newFile = $_REQUEST['copyfile'];
$old_path = $_REQUEST['old_path'];



switch ($operation) {
    case 'list':
        loadList($current_dir);
        break;
    case 'output':
        editWord($current_dir, $fileName);
        break;
    case 'create':
        createFile($current_dir, urldecode($createFile));
        break;
    case 'download':
        downloadFile($current_dir,  $_FILES['file']);
        break;
    case 'copy':
        copyFile($current_dir, $old_path, $newFile);
        break;
    case 'cut':
        cutFile($current_dir,$old_path,$newFile);
        break;

    case 'delete':
        delete($current_dir, $fileName);
        break;
    case 'write':
        writeWord($current_dir, $fileName, urldecode($content));
        break;
}

function loadList($current_directory)
{
    $massive = array_diff(scandir($current_directory), ['.', '..']);
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
        <div class='col-3'>" . date('d M. Y г.', filemtime($current_directory . "/" . $item)) . "</div>
        <div class='col-3'>" . number_format(filesize($current_directory . "/" . $item) / 1024, 0) . " kb" . "</div>
    </div>";
        }
    }
}


function editWord($current_directory, $fileName)
{
    $content = file_get_contents($current_directory . '/' . $fileName);
    if (explode('.', $fileName)[1] == 'txt') {
        echo $content;
    } else {
        echo htmlspecialchars($content, ENT_QUOTES);
    }

}

function writeWord($current_directory, $fileName, $content)
{
    file_put_contents($current_directory . '/' . $fileName, $content);
    echo 'success';
}

function createFolder($current_dirrectory, $dirName)
{
    mkdir($current_dirrectory . '/' . $dirName, '0700');
    echo 'success';
}

function createFile($current_directory, $fileName)
{
    if (count(explode('.', $fileName)) <= 1) {
        mkdir($current_directory . '/' . $fileName, '0700');
    } else {
        $file = fopen($current_directory . '/' . $fileName, 'w');
        fclose($file);
    }
    echo 'success';
}

function downloadFile($current_directory, $download){
    $path = $current_directory.'/'.$download['name'];
    move_uploaded_file($download['tmp_name'], $path);
}

function copyFile($current_path, $old_path, $newFile)
{
    $old = __DIR__.$old_path.'/'.$newFile;
    $new = $current_path.'/'.$newFile;
         copy($old, $new);
    echo 'success';
}

function cutFile($current_path, $old_path, $newFile)
{
    $old = __DIR__.$old_path.'/'.$newFile;
    $new = $current_path.'/'.$newFile;
    move_uploaded_file($old, $new);
    echo 'success';
}

function delete($current_directory, $fileName)
{
    $path = $current_directory . '/' . $fileName;
    if (is_dir($path)) {
        rmdir($path);
    } else {
        unlink($path);
    }
    echo 'success';
}

?>