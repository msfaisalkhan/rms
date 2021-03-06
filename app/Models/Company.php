<?php 


namespace App\Models;

 
/**
* Extend eloquent model class 
* read more https://laravel.com/docs/5.1/eloquent
*/
use Illuminate\Database\Eloquent\Model;
/**
* To enable CakePHP's ORM, uncomment the line below
* Read more => https://book.cakephp.org/3.0/en/orm.html 
*/

//use Cake\ORM\TableRegistry; 


class Company extends Model
{
	
	//optional: define database table name if different from 'books'
	protected $table = 'companies';

	//avoiding laravel creating time and create coloumn in sql
	public $timestamps = false;
	
	protected $fillable = [
		'id',
		'name',
		'address',
	];

	/**
	* Every book belongs to a user. 
	* That is,  books table has a user_id column which refers to the id of the user
	* So let's define the relationship below
	*/
	public function users(){
		return $this->hasMany('App\Models\User');
	}

	public function students(){
		return $this->hasMany('App\Models\Student');
	}
	
}