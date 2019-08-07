<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\PersonRepository;

use App\Helpers\ResponseHelper;
use App\Helpers\ValidatorHelper;
use Illuminate\Http\Request;


Class PersonController extends Controller
{

    public function __construct(Request $request) {
        $this->repository = new PersonRepository;
        $this->validator = new ValidatorHelper;
        $this->request = $request;
    }


    public function lists()
    {
        try {

            $patients = $this->repository->get();

            if ($patients->count() > 0) {

                return $patients;
            }

            abort(200, 'Server Error');

        } catch ( \Exception $e ) {

            return ResponseHelper::failed($e->getMessage());
        }
    }

    public function add()
    {
        try {

            $params = [
                'firstname' => 'required',
                'lastname' => 'required',
                'age' => 'required',
                'gender' => 'required',
            ];

            $this->validator->validate($this->request->all(), $params);

            $person = $this->repository->store($this->request->all());

            if ($person) {

                return ['status' => true, 'message' => 'Successfully adding person.'];
            }

            abort(200, 'Server Error');

        } catch ( \Exception $e ) {

            return ResponseHelper::failed($e->getMessage());
        }
    }

    public function update()
    {
        try {

            $params = [
                'firstname' => 'required',
                'lastname' => 'required',
                'age' => 'required',
                'gender' => 'required',
                'id' => 'required',
            ];

            $this->validator->validate($this->request->all(), $params);

            $person = $this->repository->update($this->request->all());

            if ($person) {

                return ['status' => true, 'message' => 'Successfully updating person.'];
            }

            abort(200, 'Server Error');

        } catch ( \Exception $e ) {

            return ResponseHelper::failed($e->getMessage());
        }
    }

    public function view($id) 
    {
        try {

            $person = $this->repository->find($id);

            if ($person) {
                return ['status' => true, 'data' => $person];
            }

            abort(200, 'Server Error');

        } catch ( \Exception $e ) {

            return ResponseHelper::failed($e->getMessage());
        }
    }

    
    public function delete($id) 
    {
        try {

            $person = $this->repository->delete($id);

            if ($person) {
                return ['status' => true, 'mesasge' => 'successfully deleting person.'];
            }

            abort(200, 'Server Error');

        } catch ( \Exception $e ) {

            return ResponseHelper::failed($e->getMessage());
        }
    }

    

}
