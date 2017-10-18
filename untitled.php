<?php

	session_start();

    header("content-type: text/xml");

	$question 	= array(

						0  => array("x-7=3. What is the value of x?","10".PHP_EOL." x=3+7 -> x=10"),
						1  => array("5-x= 3. What is the value of x?","2".PHP_EOL." –x=3-5 -> –x=-2 -> x=2"),
						2  => array("4x=20. What is the value of x?","5".PHP_EOL." x=20/4 ->  x=5"),
						3  => array("2x+3x=30. What is the value of x?","6".PHP_EOL." 5x=30 ->  x=30/5 -> x=6"),
						4  => array("5x-98=- 2x. What is the value of x?","14".PHP_EOL." 7x=98 ->  x=98/7 -> x=14"),
						5  => array("100/z=-4. What is the value of x?","-25".PHP_EOL." 100=-4z  -> 100/4=-z -> z=-25"),
						6  => array("1-3x=- 14. What is the value of x?","5".PHP_EOL." -3x=- 14-1 -> -3x=- 15 -> x=5"),
						7  => array("x+(-8)=- 20. What is the value of x?","-12".PHP_EOL." x-8=- 20 -> x=-20+8 -> x=-12"),
						8  => array("5-x= 3. What is the value of x?","-4".PHP_EOL." 8x-2=- 34 -> 8x=-32 -> x=-4"),
						9  => array("5-x= 3. What is the value of x?","5".PHP_EOL." 2x-6=4 -> 2x=10 -> x=5"),
						10 => array("5-x= 3. What is the value of x?","1.2".PHP_EOL." x=30-24x -> 25x=30 -> x=30/25 -> x=1.2"),
						11 => array("5-x= 3. What is the value of x?","15".PHP_EOL." x+5=20 -> x=15"),
						12 => array("5-x= 3. What is the value of x?","3.4".PHP_EOL." -14=- 10(x-2) -> 14=10x-20 -> 34=10x -> x=3.4"),
						13 => array("5-x= 3. What is the value of x?","4".PHP_EOL." 2x+8=4x -> 2x=8 -> x=4"),
						14 => array("5-x= 3. What is the value of x?","16".PHP_EOL." 3x+2=5x-30 -> -2x=- 32 -> x=16"),

						);
	

	$from   = $_POST['From'];
	$answer = $_POST['Body'];

	$reply  = array();

	$input = array('start','Start', 'START', 'restart', 'Restart', "RESTART");

	if(in_array($answer, $input)) {
		$_SESSION['value']=0;
		$reply = printqt(0,$question);
		$_SESSION['value']++;
	}
	elseif (is_numeric($answer)) {
		if(isset($_SESSION['value']) && $_SESSION['value'] < 15){
			$reply = printqt($_SESSION['value'],$question);
			$_SESSION['value']++;
		}
		else{
			$reply = 'Thank you for playing with TYA, press start to play again';
		}
	}
	else{
		$reply = 'Invalid input, To begin with TYA type "start". ';
	}


	function printqt($num,$question){
		if($num == 0){
			$makereply['welcome'] = 'Welcome to TYA'.PHP_EOL;
			$makereply['qt']	  = $question[0][0];
		}
		else{
			$makereply['prevans'] = 'previous answer : '.$question[$num-1][1].PHP_EOL.PHP_EOL;
			$makereply['nextqt']  = 'next question : '.$question[$num][0];
		}
		return $makereply;
	}

    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>

<Response>
	<Sms>
			<?php
				if(is_array($reply)){
					foreach($reply as $key => $value){
						echo $value;
					}
				}
				else{
					echo $reply;
				}
			?>
	</Sms>
</Response>
