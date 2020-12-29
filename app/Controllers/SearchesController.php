<?php

namespace App\Controllers;
use App\Controllers\Controller;
use App\Models\User;
use Respect\Validation\Validator as v; 
use App\Models\Search;
use App\Models\Student;
use App\Models\Company;


class SearchesController extends Controller{
	
	/**
	* List all searches
	* 
	* @return
	*/
	public function index($request, $response,  $args){

        //find all searches by the user with this ID
        if(isset($args['user_id'])){
            $searches = Search::where('user_id',$args['user_id'] )->get();
             //get the user's details
	          $user = User::find($args['user_id']);

              return $this->view->render($response,'searches/index.twig', ['searches'=>$searches, 'user'=>$user]);
        }else{
            $searches = Search::all();
            return $this->view->render($response,'searches/index.twig', ['searches'=>$searches]);
        }

	}



	/**
	* Display a search
	* 
	* @return
	*/
	public function view($request, $response, $args){
	
	    $search = Search::find( $args['id']);
		
		return $this->view->render($response,'searches/view.twig', ['search'=>$search]);
		
	}


	
	/**
	* Create A New search
	* 
	* @return
	*/
	public function add($request, $response,  $args){
	
        if($request->isPost() OR !empty($args['searchTerm'])){
           
            /**
            * validate input before submission
            * @var 
            * 
            */ 
            $validation = $this->validator->validate($request, [
                'searchterm' => v::notEmpty()	
            ]);


		// //redirect if validation fails
		// if($validation->failed()){
		// 	$this->flash->addMessage('error', 'You can\'t submit an empty search field!'); 
		
		// 	return $response->withRedirect($this->router->pathFor('searches/add.twig')); 
		// }

		if (!empty($args['searchTerm'])) {
			$searchTerm = $args['searchTerm'];
		} else {
			$searchTerm = $request->getParam('searchterm');
		}

		if (!empty($request->getParam('searchterm'))) {

			Search::firstOrCreate([
                'title' => $searchTerm,
                'user_id' => $this->auth->user()->id
            ]);
		}
            

                // $this->flash->addMessage('success', 'search Added Successfully');
                //redirect to eg. searches/view/8 

            $students = Student::where('first_name','LIKE','%'.$searchTerm.'%')->orwhere('last_name', 'LIKE','%'.$searchTerm.'%')->orwhere('usn', 'LIKE','%'.$searchTerm.'%')->orwhere('mobile_no','LIKE','%'.$searchTerm.'%')->orwhere('email', 'LIKE','%'.$searchTerm.'%')->orwhere('placed_year', 'LIKE','%'.$searchTerm.'%')->get();
            $companies = Company::where('name','LIKE','%'.$searchTerm.'%')->orwhere('address','LIKE','%'.$searchTerm.'%')->get();
            // $state = State::where('name',$searchTerm)->get();
            // $country = Country::where('name',$searchTerm)->get();

               		return $this->view->render($response,'searches/add.twig',['students'=>$students,'companies'=>$companies , 'searchTerm'=>$searchTerm]);
           
        }
		return $this->view->render($response,'searches/add.twig');
		
	}

    
	
}