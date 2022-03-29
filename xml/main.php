<?php
require_once("Person.php");

$person = new Person();
$container="container2";
$info= "info2";
// var_dump($person);
// echo "<pre>";
// print_r($person);
// echo "<pre>";
if (isset($_POST['insert'])) {

    $person->insert($_POST['name'], $_POST['phone'], $_POST['address'], $_POST['email']);
}
if (isset($_POST['update'])) {

    $person->update($_POST['name'], $_POST['phone'], $_POST['address'], $_POST['email']);
}
if (isset($_POST['delete'])) {

    $person->delete($_POST['name']);
}
if(isset($_POST['search'])){

   $person_data = $person->search($_POST['name']);
//    var_dump($person_data);
    $container="container";
    $info = "info";
}
if(isset($_POST['next'])){

     $person_data = $person->get_next();
    //  var_dump($person_data);
     $container="container";
     $info = "info";
 }
 if(isset($_POST['prev'])){

    $person_data = $person->get_prev();
   //  var_dump($person_data);
    $container="container";
    $info = "info";
}

?>





<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        input {
            margin-bottom: 10px;
            margin-left: 5px;

        }

        button {
            margin-bottom: 10px;
        }

        .container {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
        }

        .form {
            border: 1px solid black;
            width: 25vw;
            height: 60vh;
            padding-top: 20px;
            box-sizing: border-box;
        }

        p {
            margin-bottom: 5px;
            margin-top: 0;
        }

        .info {
            border: 1px solid black;
            width: 25vw;
            margin-bottom: 15vh;
        }

        .info2 {
            display: none;
        }

        .container2 {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 95vh;
            overflow-y: hidden;
        }

        span {
            border: 0.5px solid black;
            padding: 2px;
            margin-left: 5px;
        }
    </style>
</head>

<body>
    <div class="<?php echo$container;?>">
        <div class="<?php echo$info;?>">
           <?php 
             if(isset($_POST['search']) || isset($_POST['next']) || isset($_POST['prev']) ){
                 if($person_data != null){
                echo "name : ". $person_data[0] . "<br>";
                echo "phone : ". $person_data[1] . "<br>";
                echo "address : ". $person_data[2] . "<br>";
                echo "email : ". $person_data[3] . "<br>";
                 }else echo "the name you entered is invalid";
             }
           ?>
        </div>
        <div class='form'>
            <form action="" method="POST">

                <span>name :</span><input type="text" name="name"><br>
                <span>phone :</span><input type="text" name="phone"><br>
                <span>address :</span><input type="text" name="address"><br>
                <span>email :</span><input type="text" name="email"><br>
                <button type="submit" name="insert">insert</button>
                <button type="submit" name="update">update</button>
                <button type="submit" name="delete">delete</button>
                <br>


                <button type="submit" name="search">search by name</button>
                <br>
                <button type="submit" name="prev"><< prev</button>
                <button type="submit" name="next">next >></button>

            </form>
        </div>
    </div>
</body>

</html>