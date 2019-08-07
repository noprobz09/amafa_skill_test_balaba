<?php

namespace App\Helpers;

use Request;
use Validator as Validate;

class ValidatorHelper
{	
	public $messages = [];

	public $isValid = false;

	public function validate(array $data, array $rules)
    {
        $validator = Validate::make($data, $rules);

         if ($validator->fails()) {
         	$this->isValid = false;
            
    		abort(200, (string)implode('//', (array)$validator->errors()->all()));
            
    	}

    	$this->isValid = true;

    	return [];
    }


    public function isValid()
    {
        return $this->isValid;
    }

    public function getMessage()
    {
        return $this->messages;
    }
}
