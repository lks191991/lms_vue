<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CsvController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    
	
	/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function csvUploadVideo()
    {
        $courses = Course::where('status','=',1)->orderBy('name')->get();
        
        return view('csv',  compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function csvUploadVideoPost(Request $request)
    {        
        $validator = Validator::make($request->all(), [
            'course' => 'required',
            
        ]);
        

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {    
            
            return Redirect::back()
                ->withErrors($validator) // send back all errors to the form
                ->withInput();
        } else {
            
						
						$file = $request->file('uploaded_file_csv');
						if ($file) {
							$filename = $file->getClientOriginalName();
							$extension = $file->getClientOriginalExtension(); //Get extension of uploaded file
							$tempPath = $file->getRealPath();
							$fileSize = $file->getSize(); //Get size of uploaded file in bytes
							//Check for file extension and size
							$this->checkUploadedFileProperties($extension, $fileSize);
							//Where uploaded file will be stored on the server 
							$location = 'uploads'; //Created an "uploads" folder for that
							// Upload file
							$file->move($location, $filename);
							// In case the uploaded file path is to be stored in the database 
							$filepath = public_path($location . "/" . $filename);
							// Reading file
							$file = fopen($filepath, "r");
							$importData_arr = array(); // Read through the file and store the contents as an array
							$i = 0;
							//Read the contents of the uploaded file 
							while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
							$num = count($filedata);
							// Skip first row (Remove below comment if you want to skip the first row)
							if ($i == 0) {
							$i++;
							continue;
							}
							for ($c = 0; $c < $num; $c++) {
							if(!empty($filedata[$c][0]))
							{
							$importData_arr[$i][] = $filedata[$c];
							}
							}
							$i++;
							}
							fclose($file); //Close after reading
							$j = 0;
							
							foreach ($importData_arr as $importData) {
							$j++;
							$topicName = str_replace("'", "\'", $importData[0]);
							$topicName = str_replace('"', "'+String.fromCharCode(34)+'", $importData[0]);
							$videoDescription = str_replace("'", "\'", $importData[1]);
							$videoDescription = str_replace('"', "'+String.fromCharCode(34)+'", $importData[1]);
							
							$topicName = addslashes(trim(ucwords(strtolower($topicName))));
							$videoDescription = addslashes(trim(ucwords(strtolower($videoDescription))));
							$topicData = Topic::where("topic_name",$topicName)->where("subject_id",$request->subject)->first();
							if(isset($topicData))
							{
								$toipic_id= $topicData->id;
							}
							else
							{
							$topic = new Topic();
							$topic->subject_id = $request->subject;
							$topic->topic_name = $topicName;
							$topic->status = 0;
							$topic->save();
							$toipic_id= $topic->id;
							}
							$video = new Video();
							$video->course_id = $request->course;
							$video->video_url = trim($importData[2]);
							$video->description = $videoDescription;
							$video->topic_id = $toipic_id;
							$video->user_id = 1;
							$video->status = 1;            
							$video->save();

							}
							return response()->json([
							'message' => "$j records successfully uploaded"
							]);
							} 
							         
            
            
            //return redirect()->route('backend.videos.index')->with('success', 'Video created Successfully');
        }
    }
	
	public function checkUploadedFileProperties($extension, $fileSize)
	{
		$valid_extension = array("csv", "xlsx"); //Only want csv and excel files
		$maxFileSize = 2097152; // Uploaded file size limit is 2mb
		if (in_array(strtolower($extension), $valid_extension)) {
		if ($fileSize <= $maxFileSize) {
		} else {
		throw new \Exception('No file was uploaded', Response::HTTP_REQUEST_ENTITY_TOO_LARGE); //413 error
		}
		} else {
		throw new \Exception('Invalid file extension', Response::HTTP_UNSUPPORTED_MEDIA_TYPE); //415 error
		}
		}
		
}
