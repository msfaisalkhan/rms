<?php

namespace App\Controllers;
use App\Controllers\Controller;
use App\Models\User;
use Respect\Validation\Validator as v; 
use App\Models\Student;
use App\Models\Company;

class StudentsController extends Controller{
	
	/**
	* List all users
	* 
	* @return
	*/
	public function index($request, $response,  $args){
	    $students = Student::all();
	    $companies = Company::all();
		return $this->view->render($response,'students/index.twig', ['students'=>$students, 'companies'=>$companies]);
		
	}



	/**
	* Display a student
	* 
	* @return
	*/
	public function view($request, $response, $args){
	
	    $student = Student::find( $args['id']);
		
		return $this->view->render($response,'students/view.twig', ['student'=>$student]);
		
	}


	
	/**
	* Create A New student
	* 
	* @return
	*/
	public function add($request, $response,  $args){
		$companies = Company::all();
	
        if($request->isPost()){
           
            /**
            * validate input before submission
            * @var 
            * 
            */ 
            $validation = $this->validator->validate($request, [
                'first_name' => v::notEmpty(),
                'mobile_no' => v::notEmpty(),
                'email' => v::notEmpty(),
                'placed_year' => v::notEmpty(),
                // 'department' => v::notEmpty(),
                'usn' => v::notEmpty(),	
            ]);


		//redirect if validation fails
		if($validation->failed()){
			$this->flash->addMessage('error', 'Validation Failed!'); 
		
			return $response->withRedirect($this->router->pathFor('students/add.twig')); 
		}
		
            $student = Student::create([
                'first_name' => $request->getParam('first_name'),
                'last_name' => $request->getParam('last_name'),
                'mobile_no' => $request->getParam('mobile_no'),
                'email' => $request->getParam('email'),
                'placed_year' => $request->getParam('placed_year'),
                // 'department' => $request->getParam('department'),
                'usn' => $request->getParam('usn'),
                'position' => $request->getParam('position'),
                'company_id' => $request->getParam('company_id'),               
            ]);

                $this->flash->addMessage('success', 'student Added Successfully');
                //redirect to eg. students/view/8 
                return $response->withRedirect($this->router->pathFor('students.view', ['id'=>$student->id]));
           
        }
		return $this->view->render($response,'students/add.twig',['companies'=>$companies]);
		
	}

    
	
	/**
	* Edit student
	* 
	* @return
	*/
	public function edit($request, $response,  $args){
	
              //find the student
            $student = Student::find( $args['id']);
            $companies = Company::all();

			//only admin and the person that created the student can edit or delete it.
			// if($this->auth->user()->role_id <= 3) {
                
			// $this->flash->addMessage('error', 'You are not allowed to perform this action!'); 
		
			// return $this->view->render($response,'students/edit.twig', ['student'=>$student]);

			// }

		
        //if form was submitted
        if($request->isPost()){
        
         $validation = $this->validator->validate($request, [
                'first_name' => v::notEmpty(),	
                'last_name' => v::notEmpty(),
                // 'company_id' => v::notEmpty(),
                'mobile_no' => v::notEmpty(),
                'email' => v::notEmpty(),
                'placed_year' => v::notEmpty(),
                // 'department' => v::notEmpty(),
                'usn' => v::notEmpty(),
                	
            ]);
        //redirect if validation fails
		if($validation->failed()){
			$this->flash->addMessage('error', 'Validation Failed!'); 
		
			return $this->view->render($response,'students/edit.twig', ['student'=>$student, 'companies'=>$companies]);
		}
		
            //save Data
            $student =  Student::where('id', $args['id'])
                            ->update([
                                'first_name' => $request->getParam('first_name'),
                                'last_name' => $request->getParam('last_name'),
                                'email' => $request->getParam('email'),
                                'usn' => $request->getParam('usn'),
                                'mobile_no' => $request->getParam('mobile_no'),
                                'placed_year' => $request->getParam('placed_year'),
                                // 'department' => $request->getParam('department'),
                                'position' => $request->getParam('position'),
                                'company_id' => $request->getParam('company_id'),
                                ]);
            
            if($student){
                $this->flash->addMessage('success', 'student Updated Successfully');
                //redirect to eg. students/view/8 
                return $response->withRedirect($this->router->pathFor('students.view', ['id'=>$args['id']]));
            }
        }
        
	    
		return $this->view->render($response,'students/edit.twig', ['student'=>$student, 'companies'=>$companies]);
		
	}


/**
	* Delete a student
	* 
	* @return
	*/
	public function delete($request, $response,  $args){
		$student = Student::find( $args['id']);
		
		if($student->delete()){
			$this->flash->addMessage('success', 'Student Deleted Successfully');
			return $response->withRedirect($this->router->pathFor('students.index'));
		}
	}

}