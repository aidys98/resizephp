<?php
    require_once('func.php');
	var_dump($_FILES);
    if (!empty($_FILES['image']['tmp_name'])){
        if (!empty($_FILES['image']['error'])) {
            echo 'Произошла ошибка загрузки: '.$_FILES['image']['error'];
        }
        
        if ($_FILES['image']['size'] > 2 * 1024 * 1024) {
            echo 'Файл слишком большой';
        }
        else {
            $w = $_FILES['image']['size'];
            $h = $_FILES['image']['size'];
        }
        
        switch($_FILES['image']['type']) {
            case 'image/jpeg':
            $type = 'jpeg';
            break;
                
            case 'image/png':
            $type = 'png';
            break;
                
            case 'image/gif':
            $type = 'gif';
            break;
            
            default: 
            echo  'Неправильный тип изображения';
            break;
        }
        
        if (!move_uploaded_file($_FILES['image']['tmp_name'],'images/original/'.$_FILES['image']['name'])) {
            echo  'Не удалось загрузить файл';
        }
        
       
        
        echo  'Файл успешно загружен ';
        echo '<a href="images/original/'.$_FILES['image']['name'].'">Исходное изображение<br><img src="images/original/'.$_FILES['image']['name'].'" /></a><br>';  
            /*'<img src="images/original/'.$_FILES['image']['name'].'">';*/
        
         if (!resize_image($type,'images/original/'.$_FILES['image']['name'])){
            echo 'Не удалось изменить размер изображения';
        }
        else {
            echo 'Размер изображения успешно изменён ';
            echo  '<a href="images/mini/'.$_FILES['image']['name'].'">Изменённое изображение<br><img src="images/mini/'.$_FILES['image']['name'].'"></a><br>';
                /*'<img src="images/mini/'.$_FILES['image']['name'].'">';*/
        }
    }
    else {
        echo  'Вы не загрузили файл!';
               
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <form action="upload.php" enctype="multipart/form-data" method="post">
        Введите ширину: <input type="text" id="width" name="width"><br>
        Введите длину: <input type="text" id="height" name="height"><br>
        <input type="file" name="image"><br>
        <input type="submit" name="Прикрепить">
    </form>
  
</body>
</html>