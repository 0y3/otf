<?php
use RectorPrefix20211231\React\Dns\Query\RetryExecutor;
function display_error($validation, $filed){
    if(isset($validation)){
        if($validation->hasError($filed)){
            return $validation->getError($filed); 
        }
        else{return false;}
    }
}