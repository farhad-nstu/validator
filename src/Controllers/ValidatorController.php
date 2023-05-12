<?php
namespace FarhadNstu\Validator\Controllers;

use Illuminate\Http\Request;
use FarhadNstu\Validator\Validator;

class ValidatorController
{
    public function __invoke(Validator $validator) {
        $results = $validator->make(['name','age'], [
            'name' => 'required',
            'email' => 'required',
            'dob' => 'required',
            'age' => 'required'
        ]);
        // if(count($results) > 0) {
        //     return $results; 
        // }
        // $quote = $validator->justDoIt();
        // return view('inspire::index', compact('results'));
        if($validator->fails()) {
            // to get all generated errors
            foreach ($validator->errors() as $error) {
                echo $error."<br>";
            } 

            // to get the first error
            // echo $validator->errorFirst();
        }
        if($validator->passed()){
            return "proceed to the next...";
        }
    }
}
