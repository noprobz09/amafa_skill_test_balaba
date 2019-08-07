<?php

namespace App\Repositories;

use App\Person;

Class PersonRepository {

	public function __construct() {
		$this->model = new Person;
	}


	public function store(array $data) {

		$data = [
			'firstname' 	=> $data['firstname'],
            'lastname' 	    => $data['lastname'],
            'age' 	        => $data['age'],
            'gender' 	    => $data['gender'],
		];

		return $this->model->create($data);
	}

	public function update(array $data)
	{
		$data = [
			'firstname' 	=> $data['firstname'],
            'lastname' 	    => $data['lastname'],
            'age' 	        => $data['age'],
            'gender' 	    => $data['gender'],
        ];
        
		return $this->model->where('id', $data['id'])->update($data);
    }
    

    public function get() 
    {
        return $this->model->orderBy('created_at', 'DESC')->get();
    }

    public function find($id) 
    {
        return $this->model->find($id);
    }


    public function delete($id)
    {
        return $this->model->where('id', $id)->delete();
    }



}