<?php
   
namespace App\Http\Controllers\API\V1\Front;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\V1\Front\BaseController as BaseController;
use App\Models\User;
use App\Models\UserSubscription;
use App\Models\Course;
use App\Models\Video;
use App\Models\QuizScore;
use App\Models\QuizReport;
use App\Models\QnsAns;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use Image;

class QuizController extends BaseController
{
    
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    
    public function getQuiz(Request $request)
    {
        	$data = $request->all();
			if(isset($data['video_id']) && !empty($data['video_id']))
            {
                $QnsAns = QnsAns::select('id','course_id', 'topic_id', 'video_id','question', 'ans1', 'ans2', 'ans3', 'ans4')->where(['video_id' => $data['video_id']])->inRandomOrder()->limit(3)->get();
                $returnData['quiz'] = $QnsAns;
                $returnData['durationTime'] = 0;//in minutes

                $quizScore = QuizScore::where(['video_id' => $data['video_id']])->first(); 
                if(isset($quizScore))
                {
                    $returnData['quizScore'] = $quizScore;
                }
                else
                {
                    $returnData['quizScore'] = 0; 
                } 
            }
            elseif(isset($data['course_id']) && !empty($data['course_id']))
            {
                $QnsAns = QnsAns::select('id','course_id', 'topic_id', 'video_id','question', 'ans1', 'ans2', 'ans3', 'ans4')->where(['course_id' => $data['course_id']])->inRandomOrder()->limit(25)->get();
                $returnData['quiz'] = $QnsAns;
                $returnData['durationTime'] = 45;//in minutes
                $quizScore = QuizScore::where(['course_id' => $data['course_id']])->first(); 
                if(isset($quizScore))
                {
                    $returnData['quizScore'] = $quizScore;
                }
                else
                {
                    $returnData['quizScore'] = 0; 
                } 
            }
            
		
			return $this->sendResponse($returnData, 'Video Flag successfully.');
			
       
    }

    public function quizSubmit(Request $request)
    {
        	$input = $request->all();
			$ansdata = json_decode($request->getContent(), true);
			print_r($ansdata);
			exit;
			
            $ansdata = json_decode($input['ansdata']);
            $totalQns = 0;
            $rightQns = 0;
            $wrongQns = 0;
            foreach($ansdata as $ans)
            {
                $totalQns++;
                $quizReport = new QuizReport(); 
                $quizReport->user_id = Auth::guard('api')->user()->id;
                $quizReport->course_id = $input['course_id'];
                $quizReport->video_id = $input['video_id'];
                $quizReport->quiz_type = $input['quiz_type'];
                $quizReport->qnsans_id = $ans['qnsans_id'];
                $quizReport->rightans = $ans['rightans'];
                $quizReport->save();
                $QnsAns = QnsAns::where(['id' => $ans['qnsans_id']])->first();
                if(isset($QnsAns))
                {
                    if($QnsAns->rightans == $ans['rightans'])
                    {
                        $rightQns++;
                    }
                    else
                    {
                        $wrongQns++;
                    }
                }
            }

            $percent = (($rightQns/$totalQns) *100);
            $quizScore = new QuizScore(); 
            $quizScore->user_id = Auth::guard('api')->user()->id;
            $quizScore->course_id = $input['course_id'];
            $quizScore->video_id = $input['video_id'];
            $quizScore->quiz_type = $input['quiz_type'];
            $quizScore->total_right_ans = $rightQns;
            $quizScore->total_wrong_ans = $wrongQns;
            $quizScore->total_qns = $totalQns;
            $quizScore->percent = $percent;
			$quizScore->save();
                
            
			return $this->sendResponse($quizScore, 'Quiz submit successfully.');
			

    }
	

}