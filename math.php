<?php

	session_start();

    header("content-type: text/xml");

	$answer = $_POST['Body'];

	if (strpos($answer, 'start') !== FALSE || strpos($answer, 'restart') !== FALSE) {
		$_SESSION['answer']='';
		$reply['welcome'] = printqt();
	}
	elseif (strpos($answer, 'add') !== FALSE || strpos($answer, 'sub') !== FALSE || strpos($answer, 'mul') !== FALSE || strpos($answer, 'div') !== FALSE) {
		$x = rand(20,30);
		$y = rand(1,10);
		switch ($answer) {
			case 'add':
				$reply = $x.' + '.$y;
				$_SESSION['answer']=$x+$y;
				break;
			case 'sub':
				$reply = $x.' - '.$y;
				$_SESSION['answer']=$x-$y;
				break;
			case 'mul':
				$reply = $x.' * '.$y;
				$_SESSION['answer']=$x*$y;
				break;
			case 'div':
				$reply = $x.' / '.$y;
				$_SESSION['answer']=$x/$y;
				break;	
			default:
				$makereply = 'Enter valid numer or type "restart" to start again'.PHP_EOL;
				break;
		}
	}
	elseif (is_numeric($answer) && is_numeric($_SESSION['answer'])) {
		if($answer == $_SESSION['answer']){
			$reply['prev'] = 'Correct answer'.PHP_EOL.PHP_EOL;
			$reply['welcome'] = printqt();
		}
		else{
			$reply['prev'] = 'Wrong answer'.PHP_EOL.PHP_EOL;
			$reply['welcome'] = printqt();
		}
	}
	else{
		$_SESSION['answer']='';
		$reply['welcome'] = printqt();
	}

	// print_r($_SESSION);

	function printqt(){

		$makereply = 'Choose one of the following :'.PHP_EOL.PHP_EOL.'add for ADDITION'.PHP_EOL.'sub for SUBTRACTION'.PHP_EOL.'mul for MULTIPLICATION'.PHP_EOL.'div for DIVIVSION'.PHP_EOL;

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
