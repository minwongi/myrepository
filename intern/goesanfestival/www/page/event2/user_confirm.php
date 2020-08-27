<?php
include_once ("../../common.php");
?>

<!doctype html>
<html lang="ko">

<head>
    <meta charset="utf-8">
    <title>사용자 정보 입력폼</title>
    <style>
        body{
            margin: 0;
            padding: 0;
            font-family: sans-serif;
            background: black;
        }

        .box{
            width: 80%;
            padding: 40px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: black;
            text-align: center;
        }

        .box h1 {
            color: white;
            text-transform: uppercase;
            font-weight: 500;
        }

        .box input[type = "text"],.box input[type = "password"]{
            border:0;
            background: white;
            display: block;
            margin: 20px auto;
            /* text-align: center; */
            border:2px solid #8C8C8C;
            padding: 14px 10px;
            width: 300px;
            outline: none;
            color: black;
            border-radius: 24px;
            transition: 0.25s;
        }

        .box input[type = "text"]:focus,.box input[type = "password"]:focus{
            /* width: 400px; */
            border-color: #2ecc71;
        }

        .box input[type = "submit"]{
            border:0;
            background: red;
            display: block;
            margin: 20px auto;
            text-align: center;
            border:2px solid red;
            padding: 14px 130px;
            outline: none;
            color: white;
            border-radius: 24px;
            transition: 0.25s;
            cursor: pointer;
        }
        
    </style>
</head>

<body>
    <h1>사용자 정보 입력</h1>
        <form class="box" action="<?php echo G5_URL;?>/page/event2/person.php" method="POST">
        <!-- <h1>Login</h1> -->
        <div style="text-align: center;">
            <img src="img/userconfirm_logo.png" width="550" height="180">
        </div>
        <input type="text" name="name" value="" placeholder=" 성 명">
        <input type="text" name="phone" value="" placeholder=" 연락처">
        <input type="submit" name="" value="참여하기" style="font-size:16px;">
    </form>
</body>

</html>