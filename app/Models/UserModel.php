<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
	protected $table      = 'users';
    protected $primaryKey = 'id';
    protected $returnType  = 'array';

    protected $allowedFields = ['firstname', 'lastname', 'email', 'username','password','active'];

    protected $useTimestamps = true; //La tabla debe contener los created_at y updated_at
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    //Reglas en https://codeigniter4.github.io/userguide/libraries/validation.html?highlight=alpha_numeric_space#available-rules
    protected $validationRules    = [
        'firstname'    => 'required|min_length[3]',
        'lastname'     => 'required|min_length[3]',
        'email'        => 'required|valid_email',
        'username'     => 'required|alpha_numeric|min_length[3]|is_unique[users.username]',
        'password'     => 'required|min_length[5]',
        'password_verify' => 'required_with[password]|matches[password]'
    ];

   /* protected $validationMessages = [
        'username'        => [
            'is_unique' => 'Lo lamentamos. Nombre de usuario se encuentra en uso. Favor especificar otro.'
        ]
    ];*/

    //Encriptando contraseñas
    protected $beforeInsert = ['beforeInsert'];
  	protected $beforeUpdate = ['beforeUpdate'];

    protected function beforeInsert(array $data){
	    $data = $this->passwordHash($data);
	    return $data;
	  }

	  protected function beforeUpdate(array $data){
	    $data = $this->passwordHash($data);
	    return $data;
	  }

	  protected function passwordHash(array $data){
	    if(isset($data['data']['password']))
	      $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
	    return $data;
	  }


}