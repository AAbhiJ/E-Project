<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD</title>

    <?php

    require_once "init.php";


    function g($str){
        return $_POST[$str];
    }





    if(isset($_POST['submit'])){
        $name = g('name');
        $text = g('textF');

        $params = [
            'index'=>'students',
            'body'=>[
                'name'=>$name,
                'text'=>$text
            ]
        ];
        $response = $client->index($params);


        // Create Index

        // $params = [
        //     'index' => 'students'
        // ];
        
        
        // $checkIndex = $client->indices()->exists($params);
    
        // echo $checkIndex,"asd";
    
        // if($checkIndex)
        // $client->indices()->create($params);
    
    
        // Delete Index
    
        // $params = [
        //     'index' => 'my_index'
        // ];
        // $response = $client->indices()->delete($params);
    
    }

    ?>

</head>
<body>
    <form action="add.php" method="post">
        name<br>
        <input type="text" name="name">
        <br>
        Text<br>
        <input type="text" name="textF">
        <br>
        <input type="submit" value="Add" name="submit">
    </form>
    
</body>
</html>