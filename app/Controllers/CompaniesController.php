<?php

namespace App\Controllers;
use App\Controllers\Controller;
use App\Models\User;
use Respect\Validation\Validator as v; 
use App\Models\Company;

class CompaniesController extends Controller{
	
	/**
	* List all companies
	* 
	* @return
	*/
	public function index($request, $response,  $args){

        //find all companies by the user with this ID
        if(isset($args['user_id'])){
            $companies = Company::where('user_id',$args['user_id'] )->get();
             //get the user's details
	          $user = User::find($args['user_id']);

              return $this->view->render($response,'companies/index.twig', ['companies'=>$companies, 'user'=>$user]);
        }else{
            $companies = Company::all();
            return $this->view->render($response,'companies/index.twig', ['companies'=>$companies]);
        }

	}



	/**
	* Display a company
	* 
	* @return
	*/
	public function view($request, $response, $args){
	
	    $company = Company::find( $args['id']);
		
		return $this->view->render($response,'companies/view.twig', ['company'=>$company]);
		
	}


	
	/**
	* Create A New company
	* 
	* @return
	*/
	public function add($request, $response,  $args){
	
        if($request->isPost()){
           
            /**
            * validate input before submission
            * @var 
            * 
            */ 
            $validation = $this->validator->validate($request, [
                'name' => v::notEmpty(),	
            ]);


		//redirect if validation fails
		if($validation->failed()){
			$this->flash->addMessage('error', 'Validation Failed!'); 
		
			return $response->withRedirect($this->router->pathFor('companies/add.twig')); 
		}
		
            $company = Company::create([
                'name' => $request->getParam('name'),
                'address' => $request->getParam('address'),
            ]);

                $this->flash->addMessage('success', 'company Added Successfully');
                //redirect to eg. companies/view/8 
                return $response->withRedirect($this->router->pathFor('companies.view', ['id'=>$company->id]));
           
        }
		return $this->view->render($response,'companies/add.twig');
		
	}

    
	
	/**
	* Edit company
	* 
	* @return
	*/
	public function edit($request, $response,  $args){
	
              //find the company
            $company = Company::find( $args['id']);

			//only admin and the person that created the company can edit or delete it.
			// if($this->auth->user()->role_id < 3){
                
			// $this->flash->addMessage('error', 'You are not allowed to perform this action!'); 
		
			// return $this->view->render($response,'companies/edit.twig', ['company'=>$company]);

			// }

        //if form was submitted
        if($request->isPost()){
        
         $validation = $this->validator->validate($request, [
                'name' => v::notEmpty(),	
            ]);
        //redirect if validation fails
		if($validation->failed()){
			$this->flash->addMessage('error', 'Validation Failed!'); 
		
			return $this->view->render($response,'companies/edit.twig', ['company'=>$company]);
		}
		
            //save Data
            $company =  Company::where('id', $args['id'])
                            ->update([
                                'name' => $request->getParam('name'),
               					'address' => $request->getParam('address'),
                                ]);
            
            if($company){
                $this->flash->addMessage('success', 'company Updated Successfully');
                //redirect to eg. companies/view/8 
                return $response->withRedirect($this->router->pathFor('companies.view', ['id'=>$args['id']]));
            }
        }
        
	    
		return $this->view->render($response,'companies/edit.twig', ['company'=>$company]);
		
	}


/**
	* Delete a company
	* 
	* @return
	*/
	public function delete($request, $response,  $args){
		$company = Company::find( $args['id']);
		if($company->delete()){
			$this->flash->addMessage('success', 'Company Deleted Successfully');
			return $response->withRedirect($this->router->pathFor('companies.index'));
		}
	}

}