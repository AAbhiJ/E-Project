<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizen</title>
    <?php
        require_once "init.php";

        $results = NULL;

        //  $response = $client->delete($params);
        // $response = $client->indices()->delete(['index'=>'test']);
        //         die();

        if(isset($_POST['import'])){
            print_r($_POST);
        }
// die();
        if(isset($post['import']) and false){
            $fp = fopen($_GET['fileName'],"r") or die("Unable to open file!");
            while(!feof($fp)) {

                $dat = null;
                $get = fgets($fp);
                echo"<br>$get";

                echo"<br><br>while<br>";
                $i = 0;
                if(strpos($get, '{') !== false)
                while(strpos($get, '}') === false){
                        $dat.=$get;
                        $i++;
                    $get = fgets($fp);
                }

                $dat.="}";
                $dat = json_decode($dat);
                $dat = json_decode(json_encode($dat), true);

                if($dat!=null and count($dat)>0){
                    $params = [
                        'index'=>'test',
                        'body'=>[
                            'name'=> $dat['name'],
                            'age'=> $dat['age'],
                            'city'=> $dat['city'],
                        ]
                    ];
                    $response = $client->index($params);    
                }
              }
              fclose($fp);

        }

        if(isset($_GET['Search'])){
            $se = $_GET['Search'];
            echo $se;
            // $params = [
            //     'index' => 'students',
            //     'body'  => [
            //         'query' => [
            //             'bool' => [
            //                 'should' => [
            //                     ['match' => ['name' => $se]],
            //                     ['match' => ['text' => $se]]
            //                 ]
            //             ]
            //         ]
            //     ]
            // ];


            $params = [
                'index' => 'students',
                'body'  => [
                    'query' => [
                        'multi_match' => [
                            'regexp' => [
                                // 'name' => '\''.$se.'.\''
                                // 'name' => '[a-zA-Z]*a*'
                                'text' =>  '[a-zA-Z]*'.$se.'[a-zA-Z]*'
                            ]
                            ,
                            'regexp' => [
                                // 'name' => '\''.$se.'.\''
                                // 'name' => '[a-zA-Z]*a*'
                                'name' =>  '[a-zA-Z]*'.$se.'[a-zA-Z]*'
                            ]        
                        ]
                ]
                ]
            ];

            $data = [
                'index' => 'students',
                'body' => [
                  'query' => [
                    'bool' => [
                      'should' => [
                        ['regexp' => ['name' => ".*".$se.".*"]],
                        ['regexp' => ['text' => ".*".$se.".*"]],
                      ]
                    ]
                  ]
                ]
              ];



            // 'name' => '.*'.$se.'.*'

            // $results = $client->get($params);
            // $results = $client->search($params);
            $results = $client->search($data);
        }


    ?>
</head>
<body>
    <form action="index.php" method="get" autocomplete="off">
        <label for="text">
            Search For Something
        </label>
        <input type="text" name="Search" id="seach">
        <input type="submit" value="Search">
    </form>

    <form action="index.php" method="post" autocomplete="off">
        <label for="text">
            add File Name
        </label>
        <input type="text" name="fileName" id="fname">
        <input type="submit" value="upload" name="import">
    </form>


    <?php

        echo "<pre>",print_r($results["hits"]["hits"]),"</pre>";

        // if(isset($results))
        // print_r($results["hits"]["hits"]) ;
    ?>
</body>
</html> 