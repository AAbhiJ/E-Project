<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizer</title>

    <?php
        require_once "init.php";

        $results = NULL;


        if(isset($_POST['send'])){


            $name = $_POST['name'];
            $age = $_POST['age'];
            $city = $_POST['city'];
        
            $head = "[
                {
                    'name':'$name',
                    'age':'$age',
                    'city':'$city'
                }
                ]";
        
            // $head = array(
            //     'file' => '@' .realpath('vendor1.json')
            // );

            print_r($head);
            $ch = curl_init();
        
            curl_setopt($ch, CURLOPT_URL, 'https://enterprise-search-deployment-a4007f.ent.us-west1.gcp.cloud.es.io/api/as/v1/engines/vendor/documents');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            
            $headers = array();
            $headers[] = 'Content-Type: application/json';
            $headers[] = 'Authorization: Bearer private-n1roq6tgc8ujj1ijq5wcscqe';
            curl_setopt($ch, CURLOPT_POSTFIELDS, $head);
            curl_setopt($ch, CURLOPT_USERPWD, 'elastic' . ':' . 'KLMF5FcbmCra0vo31LVyBttw');
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            
            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            }
            curl_close($ch);
            print_r($result);
        }

        if(isset($_GET['Search'])){
        
                $se = $_GET['Search'];
             
                $params = [
                'body'  => [
                    'query' => [
                        'multi_match' => [
                            'regexp' => [
                                'city' =>  '[a-zA-Z]*'.$se.'[a-zA-Z]*'
                            ]
                            ,
                            'regexp' => [
                                'name' =>  '[a-zA-Z]*'.$se.'[a-zA-Z]*'
                            ]        
                        ]
                    ]
                ]
            ];
    
    
            $params = "{
                'query':$se
            }";
    
                $ch = curl_init();
            
                curl_setopt($ch, CURLOPT_URL, 'https://enterprise-search-deployment-a4007f.ent.us-west1.gcp.cloud.es.io/api/as/v1/engines/vendor/search.json');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POST, 1);
                
                $headers = array();
                $headers[] = 'Content-Type: application/json';
                $headers[] = 'Authorization: Bearer search-ib9qahpun59xib1oqn2z7yny';
                curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
                curl_setopt($ch, CURLOPT_USERPWD, 'elastic' . ':' . 'KLMF5FcbmCra0vo31LVyBttw');
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                
                $results = curl_exec($ch);
                if (curl_errno($ch)) {
                    echo 'Error:' . curl_error($ch);
                }
                curl_close($ch);
                // print_r($results);
            }







    ?>


    <!-- Font -->

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Pattaya&display=swap" rel="stylesheet">

    <!-- CSS-->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <!-- Custom -->
    <link rel="stylesheet" href="assets/css/index.css">

</head>
<body>
    <header>
        <nav class="navbar navbar-expand-md">
            <a href="#" class="navbar-brand">Visvalizan</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navBar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navBar">
                <ul class="navbar-nav">
                    <li class="nav-item"><a href="#" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Features</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Contact</a></li>
                </ul>
            </div>
        </nav>
    </header>


    <section class="hero">
        <div class="container">
            <div class="heroText">
                <h1 class="brand-name">Visvalizan</h1>
                <p>A Business Analytics Tool</p>    
            </div>
        </div>
        <img src="assets/img/left-hero.svg" alt="Left" id="leftHero">
        <img src="assets/img/right-hero.svg" alt="Right" id="rightHero">                
    </section>
    <section class="features">
        <div class="container">
            <div class="searchBox box">
                <form action="index.php" method="get" autocomplete="off">
                    <input type="text" name="Search" id="serachBar" placeholder="Search a DataSet" class="searchInput">
                    <input type="submit" value="Search" id="uploadButton" class="buttonS">
                </form>
            </div>
            <div class="add box hide">
                <h5 class="SearchIcon">Insert <span>></span> </h5>
            <div class="addForm" id="formD">
            <form action="index.php" method="post" autocomplete="off">
                <input type="text" name="name" placeholder="Name" id="nameid" class="searchInput">
                <input type="text" name="age" placeholder="Age" id="ageid" class="searchInput">
                <input type="text" name="city" placeholder="City" id="cityid" class="searchInput"><br>
                <input type="submit" value="send" name="send"  class="buttonS">
            </form>
            </div>
            </div>
        </div>

        <div class="resultsDiv">
        <div class="container featuresContainer">
            <?php

            if(isset($results)){
                $results = json_decode(json_encode(json_decode($results)),true);
                // echo "<pre>",print_r($results),"</pre>";
                foreach($results['results'] as $res){
                // echo "<pre><h1>ASASAS</h1>",print_r($res),"</pre>";

            ?>
                <div class="resultCont">
                    <p>Name : <?php echo $res['name']['raw']; ?></p>
                    <p>Age : <?php echo $res['age']['raw']; ?></p>
                    <p>City : <?php echo $res['city']['raw']; ?></p>
                </div>
            <?php
                }
            }
            ?>
        </div>

    </section>

    <!-- Js -->
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

    <script>
        $(()=>{
            var status = false;
            $(".SearchIcon").click(()=>{
                // $("#formD").toggle("slow");
                if(status){
                    $(".add").removeClass("hide");
                    status = false;
                }
                else{
                    $(".add").addClass("hide");
                    status=true;
                }
            })

        })
    </script>

</body>
</html>