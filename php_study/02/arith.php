<?php 		
	$a = 3;
	$b = 5;

	$c = $a + $b;
	$c++;

	$c = $c + $a;
	$d = $a + $c * $b;

	echo "\$d : $d";    // \$는 이스케이프 문자로 $ 기호를 브라우저에 출력함.
	echo "<br>";
	
	$a = 10;
	$b = $a % 3;
	$b--;

    $c = $a - $b;
    $c = $c - 5;

    echo "\$c : $c";
?>     		