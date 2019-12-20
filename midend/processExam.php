<?php

//middleend will be recieving each question individually, and the backend will be storing

//each question answer individually

//What middleend obtains

//COLLECTING VARS
$username = $_POST['username'];			//username
$examName = $_POST['examName'];			//examName

$id = $_POST['id'];

$functionName = $_POST['functionName'];		//required name of function

$topic = $_POST['topic'];			//question topic

$parameters=$_POST['parameters'];

$inputRaw = str_replace(' ', '',$_POST['input']);			//raw input string seperated by commas and colons

$outputRaw = str_replace(' ', '',$_POST['output']);			//raw case string seperated by commas

$loop =$_POST['loop'];

$constraint=$_POST['constraint'];

$answer = $_POST['answer'];			//student coding answer

$pointWorth=$_POST['maxGrade'];



//==============================================================

$notes="";
$SyntaxNotes="Correct Syntax";
$FunctionNotes="Correct Function Name";
$ConstraintNotes="You are following the Constraint";
$LoopNotes="No Loops Required";
$TestCase1 ="No Test Case";
$TestCase2 ="No Test Case";
$TestCase3 ="No Test Case";
$TestCase4 ="No Test Case";
$TestCase5 ="No Test Case";
$TestCase6 ="No Test Case";

$FunctionGradeTotal = 0.05*$pointWorth;//0.05*$pointWorth;
$SyntaxGradeTotal = 0.05*$pointWorth;//0.05 * $pointWorth;
$ConstraintGradeTotal = 0.05*$pointWorth;//0.05*$pointWorth;
$LoopGradeTotal = 0.05*$pointWorth;//0.05*$pointWorth;
$T1Grade = 0;
$T2Grade = 0;
$T3Grade = 0;
$T4Grade = 0;
$T5Grade = 0;
$T6Grade = 0;

if($loop=="None"){
$LoopGradeTotal = 0;
}

$grade=$pointWorth-$FunctionGradeTotal-$SyntaxGradeTotal-$ConstraintGradeTotal-$LoopGradeTotal;

$param = explode(',',$parameters);


//PREPARE INPUTS

$inputs=array();

switch($topic)

{
case 'Recursions':

	//echo json_encode("I'm in recursion");
	$input=explode(":",$inputRaw); //turns into array, which divides up the inputs. input[0] corresponds to output[0] and so on.

	$output=explode(":",$outputRaw); //turns into array, which divides into sample outputs.


	$in = explode(':',$inputRaw);

	$out = explode(',',$outputRaw);



  for($i=0; $i<count($out) ;$i++)

	{

		$buffs=explode(',',$in[$i]);


		$inputs[]="$buffs[0],$buffs[1]";

	}

	break;


case 'Arrays':


	//echo json_encode("I'm in arrays");
	$input=explode(":",$inputRaw); //turns into array, which divides up the inputs. input[0] corresponds to output[0] and so on.

	$output=explode(":",$outputRaw); //turns into array, which divides into sample outputs.


	$in = explode(':',$inputRaw);

	$out = explode(',',$outputRaw);
	$functionNameForThis = str_replace('"', '', strtok($answer,':'));
	$tokenForThis = substr($functionNameForThis, 4, $functionNameForThis-3);

	if ($tokenForThis == "Factorial")
	{
		for($i=0; $i<count($out);$i++)

		{

			//$buffs = explode(',',$in[$i]);


			//array_push($inputs,$buffs[0],$buffs[1]);

			$inputs[] = ("$in[$i]");


		}
		//echo json_encode($inputs[0]);

	}


	else
	{
		for($i=0;$i<count($out);$i++)

		{

			$buffs=explode(',',$in[$i]);

			//array_push($inputs,$buffs[0],$buffs[1]);

			$inputs[]="$buffs[0],$buffs[1]";
		}
	}


	break;


  case 'Conditionals':


	$input=explode(":",$inputRaw); //turns into array, which divides up the inputs. input[0] corresponds to output[0] and so on.

	$output=explode(":",$outputRaw); //turns into array, which divides into sample outputs.


	$in = explode(':',$inputRaw);

	$out = explode(',',$outputRaw);

	$functionNameForThis = str_replace('"', '', strtok($answer,':'));
	$tokenForThis = substr($functionNameForThis, 4, $functionNameForThis-7);
	echo json_encode($tokenForThis);
	//$fnameForThis = preg_split("/[\s]/",$tok);


	if ($tokenForThis == "Operation")
	{
		for($i=0; $i<count($out);$i++)

		{

			$buffs = explode(',',$in[$i]);


			//array_push($inputs,$buffs[0],$buffs[1]);

			$inputs[] = ("$buffs[0],$buffs[1],$buffs[2]");


		}

	}
	else
	{
		for($i=0; $i<count($out);$i++)

		{

			$buffs = explode(',',$in[$i]);


			//array_push($inputs,$buffs[0],$buffs[1]);

			$inputs[] = ("$buffs[0],$buffs[1]");


		}
	}


	//echo json_encode($inputs[0]);

	//echo json_encode($inputs);
	break;



  case 'Loops':

	$input=explode(":",$inputRaw); //turns into array, which divides up the inputs. input[0] corresponds to output[0] and so on.

	$output=explode(":",$outputRaw); //turns into array, which divides into sample outputs.



	$in = explode(':',$inputRaw);

	$out = explode(',',$outputRaw);



  for($i=0;$i<count($out);$i++)

	{

		$buffs=explode(',',$in[$i]);

		//array_push($inputs,$buffs[0],$buffs[1]);

		$inputs[]="$buffs[0],$buffs[1]";

	}

	//echo json_encode($inputs[0]);

	break;

  case 'Strings':

	$input=explode(":",$inputRaw); //turns into array, which divides up the inputs. input[0] corresponds to output[0] and so on.

	$output=explode(":",$outputRaw); //turns into array, which divides into sample outputs.



	$in = explode(':',$inputRaw);

	$out = explode(',',$outputRaw);



        for($i=0;$i<count($out);$i++)

	{

		$buffs=explode(',',$in[$i]);

		//array_push($inputs,$buffs[0],$buffs[1]);

		$inputs[]="$buffs[0],$buffs[1]";

	}



	break;


  case 'Lists':

	$in=explode(":",$inputRaw); //turns into array, which divides up the inputs. input[0] corresponds to output[0] and so on.

	$out=explode(",",$outputRaw); //turns into array, which divides into sample outputs.



//make array of params

  for($i=0;$i<count($out);$i++)

	{

		$buffs=explode(':',$in[$i]);

		//array_push($inputs,$buffs[0],$buffs[1]);

		$inputs[]="$buffs[0],$buffs[1]";


	}

	break;

}


//var_dump($inputs);



$count=count($out); # of inputs/outputs given

$copy=trim($answer,'"');

/*

$noSpace = preg_replace('/\s/', '', $answer); //getting rid of any kind of space in a string including tabs etc.

$noDoubleQuotes = str_replace('"', '', $noSpace); //replacing double quotes with no space

if (strpos($noDoubleQuotes,"def") == 0) //"def" exists in an answer
{

	$withoutDef = ltrim($noDoubleQuotes, "def"); //getting rid of def from the answer

	if (strpos($withoutDef,"(") != NULL && strpos($withoutDef,"(") < strpos($withoutDef,":")) //if "(" exists and it is before ":"
	{
		$positionOfParentheses = strpos($withoutDef,"("); //finding an index of "("

		$nameOfTheFunction = substr($withoutDef,0,$positionOfParentheses); //finding the name of the function which should be before "("

		$withoutNameOfTheFunction = ltrim($withoutDef,$nameOfTheFunction); //getting rid of the function name

		$withoutOpeningParentheses = ltrim($withoutNameOfTheFunction,"("); // getting rid of "("

		$positionOfColon = strpos($withoutOpeningParentheses,":"); //finding the position of a ":"

		$parametersOfTheFunction = substr($withoutOpeningParentheses,0,$positionOfColon); //finding inputed parameters(raw parameters like x,y,z) not actual values

		$enteredParameters = explode(",",$parametersOfTheFunction); //writing entered parameters in an array

		$numberOfParametersEntered = count($enteredParameters); //counting number of parameters entered


		if (strpos($withoutDef,")") > strpos($withoutDef,"(") && strpos($withoutDef,")") < strpos($withoutDef,":")) //if there are both "(" and ")" before ":"
		{
			$positionOfParentheses = strpos($withoutDef,"("); //finding an index of "("

			$nameOfTheFunction = substr($withoutDef,0,$positionOfParentheses); //finding the name of the function which should be before "("

			$withoutNameOfTheFunction = ltrim($withoutDef,$nameOfTheFunction); //getting rid of the function name

			$withoutOpeningParentheses = ltrim($withoutNameOfTheFunction,"("); // getting rid of "("

			$positionOfClosingParentheses = strpos($withoutOpeningParentheses,")"); //finding the position of a ")"

			$parametersOfTheFunction = substr($withoutOpeningParentheses,0,$positionOfClosingParentheses); //finding inputed parameters(raw parameters like x,y,z) not actual values

			$enteredParameters = explode(",",$parametersOfTheFunction); //writing entered parameters in an array

			$numberOfParametersEntered = count($enteredParameters); //counting number of parameters entered

		}
	}
	elseif (strpos($withoutDef,")") != NULL && strpos($withoutDef,")") < strpos($withoutDef,":"))
	{
		echo json_encode("There is just )");
	}
}


*/




//echo($copy);


//---------------------



//echo '<br><br>NOW GRADING.....<br><br>';


//$header = strtok($answer,':');
$header = str_replace('"', '', strtok($answer,':'));	//extract function header
//echo json_encode($header);

$position = strpos($header,"(");
$tok = substr($header, 4, $position-4);
//echo json_encode($position);
//echo json_encode($tok);
//$tok = strtok("(");
//echo json_encode($tok);

$pos1 = strpos($header,'(');
//echo json_encode($pos1);
//$pos2=strpos($header,')',$pos1+1);

$position2 = strpos($header, ")");
$studentParams = substr($header,$position+1,$position2-$position-1);
//echo json_encode($studentParams);

$sInput=explode(',',$studentParams); //get student input parameters
//echo $sInput;
//echo json_encode($sInput[2]);
//var_dump ($sInput);



//echo json_encode("function header is : $tok ");



//echo json_encode("Student provided input : $sInput[0]");

$fname = preg_split("/[\s]/",$tok);
//echo json_encode("Fname: $fname[0]");


//echo $fname[1];

//PRELIM TESTS -----------------------------------------

//echo '<br>';



//CHECK CODE-------------------------------------

  $file = "exec.py";

  $handle = fopen($file, 'w');// or die ('Cannot open file: '.$file);

  fwrite($handle, $copy);

  fclose($handle);



  $check = exec("python check.py");

  if($check != 1)

  {

    //$file=readfile('test.txt');

    $check = exec("python check.py >|txt.txt");

    $mesg=shell_exec('tail -3 txt.txt');



    $faulty=explode('^',$mesg);

    $copy=str_replace(trim($faulty[0]),"  a=a",$copy); //Fixes erroneous code



//echo "$mesg<br>$faulty[0] $faulty[1]";

		$points_off=($pointWorth * 0.05);


    $SyntaxNotes= "Your code has a ' $faulty[1]'  error/issue originating from ' $faulty[0]'. Points off: '$points_off',";

    $SyntaxGradeTotal= 0;



//var_dump($copy);

	//echo '<br>';

//var_dump($faulty[0]);



    //echo '<br><br>';

  }


//CHECK PARAMS-----------------------------------

  //if(strstr($tok,$functionName)==FALSE)

  if(strcmp($fname[0],$functionName)!= 0)
  {

$points_off=($pointWorth * 0.05);
	//$tok=strtok($answer,':');

	$FunctionNotes="You got the function name wrong, it should be '$functionName', you provided: '$fname[0]' instead. Points taken off: '$points_off'.";
 $FunctionGradeTotal= 0;

  }
//check if student answer contains the constraint
if($constraint=="print")
{
  if(strpos($copy,$constraint) !== false)
    {
      //echo "\nStudents Answer is following the constraint restriction";

    }
  else {
      $points_off=($pointWorth*0.05);
      $ConstraintNotes="You are suppose to print the output instead you are returning the value. Points taken off: '$points_off'.";
      $ConstraintGradeTotal=0;
    }
}

//Check if student is use right loop

if($loop=="for"){
  if(strpos($copy,$loop)!==false)
    {
      //echo "\nStudent is using for loop as asked";
      $LoopNotes="Correct Loop";
    }
  else
    {
      $points_off=($pointWorth*0.1);
      $LoopNotes = "You didnt use FOR loop as asked in the question. Points taken off: '$points_off'.";
      $LoopGradeTotal = 0;
    }
}


if($loop=="while"){
  if(strpos($copy,$loop)!==false)
    {
      //echo "\nStudent is using while loop as asked";
      $LoopNotes="Correct Loop";
    }
  else
    {
      $points_off=($pointWorth*0.1);
      $LoopNotes = "You didnt use WHILE loop as asked in the question. Points taken off: '$points_off'.";
      $LoopGradeTotal = 0;
    }
}

if($loop=="None"){
  //echo json_encode("Not a Loop Question");
  $LoopNotes = "No Loops Required";
}


  //if(strstr($tok,$param[0])==FALSE)
	//echo json_encode($param[0]);
  if(strcmp($sInput[0],$param[0])!= 0)

  {
		$grade= $grade-($pointWorth * 0.05);

		$points_off=($pointWorth * 0.05);
	$notes = $notes . "You have got the function parameters wrong. You provided ' $sInput[0] ' instead of '$param[0]'. Points taken off: '$points_off'. ";

  }



//echo '\n';

//GRADING
$testCaseGrade = ($grade/$count);
$testCaseGrade = round($testCaseGrade,2);
/*
//echo json_encode($testCaseGrade);
//Multiply(2,3);
//echo json_encode($in[0]);
$testCaseInputsForCase1 = strtok($inputs[0], '');
$testCaseInput1 = $testCaseInputsForCase1[0];
$testCaseInput2 = $testCaseInputsForCase1[1];
$testCaseInputsForCase1 = strtok($inputs[1], '');
$testCaseInput3 = $testCaseInputsForCase1[0];
$testCaseInput4 = $testCaseInputsForCase1[1];
//echo json_encode($testCaseInput1[0]);
//$testCaseInputsNoSpace = preg_split("/[\s]/",$inputs[0]);
//$testCaseInput1(trim($testCaseInputsNoSpace[0],','));
//echo json_encode($testCaseInputsNoSpace[1]);
//$testCaseInputs = preg_split ("/\,/",$testCaseInputsNoSpace);
//$testCaseInput2 = $testCaseInputsNoSpace[1];
//echo json_enocde($testCaseInput2);

//echo json_encode($testCaseInputs[1]);
//$testCaseInput2 = strtok($in[1],',');
//$testCaseInput3 = strtok($in[2],',');
//$testCaseInput4 = strtok($in[3],',');

//echo json_encode($testCaseInput3.$testCaseInput4);

list($TestCase1, $T1Grade) = Multiply($testCaseInput1,$testCaseInput2,$out[0],$testCaseGrade);
list($TestCase2, $T2Grade) = Multiply($testCaseInput3,$testCaseInput4,$out[1],$testCaseGrade);



function Multiply($x,$y,$output,$caseGrade)
{
	//echo json_encode($caseGrade);
	if(($x * $y) == $output)
	{
		$TestCase1 = ("You have passed the test case");
		//echo json_encode($TestCase1);
		$T1Grade = $caseGrade;
		//echo json_encode($TestCase1);
		$testCase1Status = array($TestCase1, $T1Grade);
    return $testCase1Status;
	}

}
*/
//echo json_encode($T1Grade);


//echo"\nEach Test case grade: $TestCaseGrade";
//echo json_encode(substr($inputs[0],-1,1));
//echo json_encode(substr($inputs[0],0,3));

for($i=0;$i<$count;$i++)
{

//echo "Emptying file if it exists";
//$i = 0;
$f = fopen("exec.py","r+");
if ($f !== false)
{
    ftruncate($f,0);
    fclose($f);
}
$file = "exec[$i].py";
$fh = fopen($file, "r ");
//echo fread($fh,filesize("exec[$i].py"));
fclose($fh);

//echo "\nCount total: $count";
$res="";
  //$inners=explode(',',$in[$i]);
//echo "\nInput is : $inputs[$i]";
//echo "\nOutput is: $out[$i]\n";

if (substr($inputs[$i],0,-1) == ',')
//if (substr($inputs[0],0,-1) == ',')
{
     $inputs[$i] = substr($inputs[$i],0,3);
		 //$inputs[0] = substr($inputs[0],0,3);
}

  $file = ("$fname[0].py");
	//$file = ("$fname.py");
  $handle = fopen($file, "w+");// or die ('Cannot open file: '.$file);
  //fwrite($handle, $copy."\nprint($fname[0]($inputs[$i]))");//newest addon
	//fwrite($handle, $copy."\nprint($fname[0]($inputs[0]))");
	if ($fname[0] == "Operation")
	{
			fwrite($handle, $copy."\nif '".substr($inputs[$i],1,2-1)."' == '+':\n	print ".substr($inputs[$i],4,4-3)."+".substr($inputs[$i],6,6-4).
														"\nelif '".substr($inputs[$i],1,2-1)."' == '-':\n	print ".substr($inputs[$i],4,4-3)."-".substr($inputs[$i],6,6-4).
														"\nelif '".substr($inputs[$i],1,2-1)."' == '*':\n	print ".substr($inputs[$i],4,4-3)."*".substr($inputs[$i],6,6-4).
														"\nelif '".substr($inputs[$i],1,2-1)."' == '/':\n	print ".substr($inputs[$i],4,4-3)."/".substr($inputs[$i],6,6-4));

	}
	else
	{
		fwrite($handle, $copy."\nprint($fname[0]($inputs[$i]))");
	}
  fclose($handle);

//echo "\nReading python file content\n";
//$file = "exec[$i].py";
//$file = "exec[0].py";
//$file = "exec.py";
$file = "exec[$i].py";
$fh = fopen($file, 'r');
//echo fread($fh,filesize("exec[$i].py"));
fclose($fh);

	//$res = exec("python ./$fname.py");
  $res = exec("python ./$fname[0].py");
	//$res = exec('sudo python ./$fname[0].py');
	//echo json_encode($res);
  //echo "\nResult of the program: $res";
  $TestCaseNumber = (int)($i + 1);

  if(($res == $out[0])&&($i==0)){
  $TestCase1 = "You have passed the test case: '$TestCaseNumber'.";
	//echo "\nCorrect";
 $T1Grade = $testCaseGrade;
 //echo "\n$TestCase1";
 //echo "\n$T1Grade";
}
  else if(($res != $out[0])&&($i==0)){
	$TestCase1="You have failed the test case: $TestCaseNumber. Test Parameters: '$inputs[$i]' Your program provided the result: ' $res ' instead of:$out[$i]. Points taken off: '$TestCaseGrade'";

	$T1Grade= 0;
  }

  if($res==$out[1]&&$i==1){
  $TestCase2 = "You have passed the test case: '$TestCaseNumber'.";
	//echo "\nCorrect";
 //echo "\n$TestCase2";
 	$T2Grade = $testCaseGrade;

 //echo "\n$T2Grade";
}
  else if (($res!=$out[1])&&($i==1)){
	$TestCase2="You have failed the test case: $TestCaseNumber. Test Parameters: '$inputs[$i]' Your program provided the result: ' $res ' instead of:$out[$i]. Points taken off: '$TestCaseGrade'";
  //echo "$TestCase2";
	$T2Grade = 0;
  }

  if($res==$out[2]&&$i==2){
  $TestCase3 = "You have passed the test case: '$TestCaseNumber'.";
	//echo "\nCorrect";
 //echo "\n$TestCase3";
 $T3Grade=$testCaseGrade;

 //echo "\n$T3Grade";
}
  else if (($res!=$out[2])&&($i==2)){
	$TestCase3="You have failed the test case: $TestCaseNumber. Test Parameters: '$inputs[$i]' Your program provided the result: ' $res ' instead of:$out[$i]. Points taken off: '$TestCaseGrade'";
  //echo "$TestCase3";
	$T3Grade= 0;
  }

if($res==$out[3]&&$i==3){
  $TestCase4 = "You have passed the test case: '$TestCaseNumber'.";
	//echo "\nCorrect";
  //echo "\n$TestCase4";
 $T4Grade=$testCaseGrade;

 //echo "\n$T4Grade";
}
  else if (($res!=$out[3])&&($i==3)){
	$TestCase4="You have failed the test case: $TestCaseNumber. Test Parameters: '$inputs[$i]' Your program provided the result: ' $res ' instead of:$out[$i]. Points taken off: '$TestCaseGrade'";
 //echo "$TestCase4";
	$T4Grade= 0;
  }

if($res==$out[4]&&$i==4){
  $TestCase5 = "You have passed the test case: '$TestCaseNumber'.";
	//echo "\nCorrect";
 //echo "\n$TestCase5";
 $T5Grade=$testCaseGrade;

 //echo "\n$T5Grade";
}
  else if (($res!=$out[4])&&($i==4)){
	$TestCase5="You have failed the test case: $TestCaseNumber. Test Parameters: '$inputs[$i]' Your program provided the result: ' $res ' instead of:$out[$i]. Points taken off: '$TestCaseGrade'";
 //echo "$TestCase5";
	$T5Grade= 0;
  }

if($res==$out[5]&&$i==5){
  $TestCase6 = "You have passed the test case: '$TestCaseNumber'.";
	//echo "\nCorrect";
 //echo "\n$TestCase6";
 $T6Grade=$testCaseGrade;

 //echo "\n$T6Grade";
}
  else if (($res!=$out[5])&&($i==5)){
	$TestCase6="You have failed the test case: $TestCaseNumber. Test Parameters: '$inputs[$i]' Your program provided the result: ' $res ' instead of:$out[$i]. Points taken off: '$TestCaseGrade'";
 //echo "$TestCase6";
	$T6Grade= 0;
  }


//echo "\n $i";
}


$grade = $FunctionGradeTotal+$SyntaxGradeTotal+$ConstraintGradeTotal+$LoopGradeTotal+$T1Grade+$T2Grade+$T3Grade+$T4Grade+$T5Grade+$T6Grade;

//echo "\nFinal grade is $grade<br>";

//echo "\n$notes";


//what middlend needs to send to backend

$backendArray = array(

	'username'=>$username,

	'examName'=>$examName,

	'answer'=>$answer,

	'id'=>$id,

	'notes'=>$notes,

	'grade'=>$grade,

  'functionNotes'=>$FunctionNotes,

  'syntaxNotes'=>$SyntaxNotes,

  'constraintNotes'=>$ConstraintNotes,

  'loopNotes'=>$LoopNotes,

  'testCase1'=>$TestCase1,

  'testCase2'=>$TestCase2,

  'testCase3'=>$TestCase3,

  'testCase4'=>$TestCase4,

  'testCase5'=>$TestCase5,

  'testCase6'=>$TestCase6,

  'functionGrade'=>$FunctionGradeTotal,

  'syntaxGrade'=>$SyntaxGradeTotal,

  'constraintGrade'=>$ConstraintGradeTotal,

  'loopGrade'=>$LoopGradeTotal,

  'TC1Grade'=>$T1Grade,

  'TC2Grade'=>$T2Grade,

  'TC3Grade'=>$T3Grade,

  'TC4Grade'=>$T4Grade,

  'TC5Grade'=>$T5Grade,

  'TC6Grade'=>$T6Grade

);

//===========================CURL===================================

	$curl = curl_init();

	curl_setopt($curl, CURLOPT_POST, 1);

	curl_setopt($curl, CURLOPT_URL,'https://web.njit.edu/~kd335/BetaFinal/backend/persistExam.php');

	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

	curl_setopt($curl, CURLOPT_POSTFIELDS, $backendArray);

  	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);



	$responseDB = json_decode(curl_exec($curl));

	curl_close($curl);

	//echo json_encode($responseDB);
