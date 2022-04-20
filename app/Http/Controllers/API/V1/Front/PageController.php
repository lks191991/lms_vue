<?php
   
namespace App\Http\Controllers\API\V1\Front;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\V1\Front\BaseController as BaseController;
use App\Models\User;
use App\Models\Page;
use Illuminate\Support\Facades\Auth;


   
class PageController extends BaseController
{
    
    /**
     * Companylist api
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$id)
    {
        $pageId = $id;
		if($pageId=='')
		{
			$errorMsg = "Page not found";       
           return $this->sendError($errorMsg); 
		}
		else
		{
			$page = Page::where(['id' => $pageId])->first(); 
			return $this->sendResponse($page, 'Page');
		}
       

    }
    

}