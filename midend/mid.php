<?php
$inputArray = [];
foreach ($_POST as $key => $value)
{
	switch($key)
	{
		case 'header':
			$inputArray['header'] =$value;
			break;
    case 'questionList':
      $inputArray['questionList'] =$value;
      break;
    case 'question':
      $inputArray['question'] =$value;
      break;
		case 'username':
			$inputArray['username'] =$value;
			break;
		case 'password':
			$inputArray['password'] =$value;
			break;
		case 'examName':
			$inputArray['examName'] =$value;
			break;
    case 'input':
      $inputArray['input'] =$value;
      break;
    case 'output':
      $inputArray['output'] =$value;
      break;
		case 'functionName':
			$inputArray['functionName'] =$value;
			break;
    case 'keyword';
      $inputArray['keyword'] =$value;
      break;
		case 'topic':
			$inputArray['topic'] =$value;
			break;
		case 'difficulty':
			$inputArray['difficulty'] =$value;
			break;
  case 'constraint':
			$inputArray['constraint'] =$value;
			break;
   case 'loop':
			$inputArray['loop'] =$value;
			break;

    case 'pointWorth':
      $inputArray['pointWorth'] =$value;
      break;
    case 'pointList':
      $inputArray['pointList'] =$value;
    case 'autoNotes':
      $inputArray['pointList'] =$value;
		  break;
    case 'parameters':
			$inputArray['parameters'] =$value;
			break;
		case 'maxGrade':
			$inputArray['maxGrade'] =$value;
			break;
		case 'status':
			$inputArray['status'] =$value;
			break;
    case 'grade':
      $inputArray['grade'] =$value;
      break;

   //OTher Grades
   case 'functionGrade':
      $inputArray['functionGrade'] =$value;
      break;

   case 'syntaxGrade':
      $inputArray['syntaxGrade'] =$value;
      break;

   case 'constraintGrade':
      $inputArray['constraintGrade'] =$value;
      break;

   case 'loopGrade':
      $inputArray['loopGrade'] =$value;
      break;

   case 'TC1Grade':
      $inputArray['TC1Grade'] =$value;
      break;
   case 'TC2Grade':
      $inputArray['TC2Grade'] =$value;
      break;
   case 'TC3Grade':
      $inputArray['TC3Grade'] =$value;
      break;
   case 'TC4Grade':
      $inputArray['TC4Grade'] =$value;
      break;
   case 'TC5Grade':
      $inputArray['TC5Grade'] =$value;
      break;
   case 'TC6Grade':
      $inputArray['TC6Grade'] =$value;
      break;


   //Other Grades ends
    case 'teacherNotes':
      $inputArray['teacherNotes'] =$value;
      break;
    case 'id':
            $inputArray['id'] =$value;

		default:
			break;
	}
}

$url='';
$flag = false;
switch($inputArray['header'])
{
	//------------------------------------------------------------------------
	case 'login':
		$url = 'https://web.njit.edu/~kd335/BetaFinal/backend/login.php';
		break;
  case 'addQuestionRequest':
        $url = 'https://web.njit.edu/~kd335/BetaFinal/backend/addQuestion.php';
        break;
    //------------------------------------------------------------------------
  case 'examCreate':
        $url = 'https://web.njit.edu/~kd335/BetaFinal/backend/examCreate.php';
        break;
	//------------------------------------------------------------------------
	case 'questionBankRequest':
		$url = 'https://web.njit.edu/~kd335/BetaFinal/backend/getQuestionBank.php';
		break;
  case 'studentExamListRequest':
        $url = 'https://web.njit.edu/~kd335/BetaFinal/backend/studentExamListRequest.php';
        break;
    //------------------------------------------------------------------------
  case 'takeExamRequest':
        $url = 'https://web.njit.edu/~kd335/BetaFinal/backend/takeExamRequest.php';
        break;
    //------------------------------------------------------------------------
  case 'examStudentList':
        $url = 'https://web.njit.edu/~kd335/BetaFinal/backend/studentExamListRequest.php';
        break;
	//------------------------------------------------------------------------
	case "teacherExamListRequest":
		$url = 'https://web.njit.edu/~kd335/BetaFinal/backend/teacherExamListRequest.php';
		break;
	//------------------------------------------------------------------------
	case 'examReview':
		$url = 'https://web.njit.edu/~kd335/BetaFinal/backend/examReview.php';
		break;
	//------------------------------------------------------------------------
 case 'questionBankSortRequest':
        $url='https://web.njit.edu/~kd335/BetaFinal/backend/searchQuestionBank.php';
        break;

case 'persistExam':
        $url='https://web.njit.edu/~kd335/BetaFinal/backend/persistExam.php';
        break;
    //=========================================================================

case 'deleteQuestion':
      $url='https://web.njit.edu/~kd335/BetaFinal/backend/deleteQuestion.php';
      break;
//=========================================================================
case 'examUpdate':
		$url = 'https://web.njit.edu/~kd335/BetaFinal/backend/examUpdate.php';
		break;
	//------------------------------------------------------------------------
case 'examRelease':
		$url = 'https://web.njit.edu/~kd335/BetaFinal/backend/examRelease.php';
		break;
    //------------------------------------------------------------------------
case 'teacherExamScoreRequest':
		$url = 'https://web.njit.edu/~kd335/BetaFinal/backend/teacherExamScoreRequest.php';
		break;

	default:
		$flag = true;
		break;
}


if ($flag != true){
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $inputArray);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

//	$response = json_decode(curl_exec($curl));
	$response = json_decode(curl_exec($curl));
	curl_close($curl);


	echo json_encode($response);

}
else
{
	echo "Failure mid cannot reach";
}
