<?php

namespace FarhadNstu\Validator;

use Illuminate\Support\Facades\Http;

class Validator {
    private $valid = false;
    private $errors;

    public function make($request, $attributes) {
        $invalidList = [];
        foreach($attributes as $key => $attribute) {
            $attArr = explode("|", $attribute);
            for($i=0;$i<count($attArr);$i++){
                $param = $attArr[$i];

                // check is : exist in parameter. if exist then take upto that :
                if (preg_match('/:/', $param)){
                    $target = substr($param, strpos($param, ':') + 1);
                    if(preg_match('/,/', $target)){
                        $tmp = explode(',', $target);
                        $min = $tmp[0];
                        $max = $tmp[1];
                    }
                    $param = substr($param, 0, strpos($param, ':'));
                    $strVal = strval($request[$key]);
                }

                switch ($param) {
                    case 'required':
                        if(! array_key_exists($key, $request)) {
                            $invalidList[$key] = $key." is required <br>";
                        }
                        break;
                    case 'numeric':
                        if(! is_numeric($request[$key])){
                            $invalidList[$key] = $key." should be numeric <br>";
                        }
                        break;
                    case 'min':
                        if(strlen($strVal) < $target){
                            $invalidList[$key] = $key." should be minimum $target characters <br>";
                        }
                        break;
                    case 'max':
                        if(strlen($strVal) > $target){
                            $invalidList[$key] = $key." can be maximum $target characters <br>";
                        }
                        break;
                    case 'digits_between':
                        if(strlen($strVal) < $min || strlen($strVal) > $max ){
                            $invalidList[$key] = $key." should be between $min and $max characters <br>";
                        }
                        break;
                    
                    default:
                        echo "$param is not a valid validator param <br>";
                        break;
                }
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
