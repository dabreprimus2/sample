<?php

    header("content-type: text/xml");

	$easy 	= array(array("what is 1+1 ?",array("1","2","3","4")));
	$medium = array(array("what is 2*2 ?",array("2","4","6","8")));
	$hard 	= array(array("what is 2+(2*3) ?",array("4","8","12","16")));

	$easyanswer   = 2;
	$mediumanswer = 2;
	$hardanswer   = 2;

    $quiz = array(
	    "easy" => $easy,		// easy question and answer
	    "medium" => $medium,	// medium question and answer
	    "hard" => $hard			// hard question and answer
	);


	// $to 	= $_REQUEST['to'];
	// $from   = $_REQUEST['from'];
	$answer = $_REQUEST['Body'];
	$reply  = array();

	if (is_numeric($answer)) {
		if($answer == 2){
			$reply = 'Correct answer';
		}
		else{
			$reply = 'Wrong answer';
		}
	}
	else if(is_string($answer)){
		array_push($reply, $quiz[$answer][0][0]);
		foreach ($quiz[$answer][0][1] as $key => $value) {
			array_push($reply, PHP_EOL);
			array_push($reply, $value);
		}
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
