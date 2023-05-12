<?php
namespace FarhadNstu\Validator\Controllers;

use FarhadNstu\Validator\Validator;

class ValidatorController
{
    public function __invoke(Validator $validator) {
        $request = [
            'name' => 'farhadghqwera',
            'age' => 'fdgf',
            'dob' => '1996-10-01',
            'email' => 'farhad@gmail.com',
            'address' => 'fdgfgfghfghfg'
        ];

        $results = $validator->make($request, [
            'name' => 'required|min:8|max:12',
            'email' => 'required',
            'dob' => 'required',
            'age' => 'required|numeric',
            'address' => 'digits_between:5,8|dfg'
        ]);

        if($validator->fails()) {
            // to get all generated errors
            foreach ($validator->errors() as $error) {
                echo $error."<br>";
            } 

            // to get the first error
            // echo $validator->errorFirst();
            return ;
        }
        if($validator->passed()){
            return "proceed to the next...";
        }
    }
}
