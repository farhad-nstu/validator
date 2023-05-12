<?php

namespace FarhadNstu\Validator;

use Illuminate\Support\Facades\Http;

class Validator {
    private $valid = false;
    private $errors;
    // public function justDoIt() {
    //     $response = Http::get('https://inspiration.goprogram.ai/');

    //     return $response['quote'] . ' -' . $response['author'];
    // }

    public function make($request, $attributes) {
        $invalidList = [];
        foreach($attributes as $key => $attribute) {
            if(! in_array($key, $request)) {
                $invalidList[$key] = $key." is required";
            }
        }
        if (count($invalidList) > 0) {
            $this->valid = true;
            $this->errors = $invalidList;
        }
        return ;
    }

    public function fails() {
        if($this->valid){
            return true;
        }
    }

    public function passed() {
        if(! $this->valid){
            return true;
        }
    }

    public function errors() {
        return $this->errors;
    }

    public function errorFirst(){
        return array_values($this->errors)[0];
    }
}
