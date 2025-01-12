<!-- Массив $_FILES используется для обработки данных о загруженных файлах  -->
<!-- move_upload_file() - переместить файл из временной папки true - файл загружен false - не загружен-->
<?php 
if(!empty($_FILES)){
   $file =($_FILES['attachment']);
   $srcFilename= $file['name'];
   // Собрать путь до нового файла
   $newFilePath= __DIR__.'/uploads/'.$srcFilename;
   // Путь к временному файлу 
   $tmpFilePath = $file['tmp_name'];

   echo '<br>';
   echo $srcFilename;
   echo '<br>';
   echo $srcFilePath;
   // Перемещаем файл из временной папки в постоянную
   // move_uploaded_file первый аргумент - путь к временному файлу, второй - путь куда нужно переместить
   // file_exists - проверить существование файла

   // Запишим расширение файла в переменную
   $extension=pathinfo($srcFilename, PATHINFO_EXTENSION);

$allowedExtensions = ['jpg', 'png','gif', 'jpeg', 'webp','svg'];
if(!in_array($extension, $allowedExtensions)){
    $error='Загрузка данного типа файла запрещена';
}else if($file['error'] !==0){
    $error = 'Ошибка при загрузке файла';
   }else if(file_exists($newFilePath)){
    $error = 'Файл с таким именем существует';
   } else if (move_uploaded_file($tmpFilePath, $newFilePath)){
    $result='http://localhost/upload_files/uploads/'.$srcFilename;
   }else{
    $error='ошибка при загрузке файла';
   }
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    if(!empty($result)){
        echo $result;
    }else{
echo $error;
    }
    ?>
<form action="./upload.php" method="post" enctype="multipart/form-data">
<input type="file" name="attachment" id="">
<button type="submit">Загрузить файл</button>
</form>
</body>

</html>