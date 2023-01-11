<?php
namespace App;

use App\Models\Client;

class Helper {


public static function IdGenerator()
{
        $data = Client::orderBy('id','desc')->first();
        $prefix = 'LAC';
        if(!$data){
            $og_length = 5;
            $last_number = '';
        }else{
            $code = substr($data->client_number, strlen($prefix)+1);
            $actial_last_number = ($code/1)*1;
            $increment_last_number = ($actial_last_number)+1;
            $last_number_length = strlen($increment_last_number);
            $og_length = 5 - $last_number_length;
            $last_number = $increment_last_number;
        }
        $zeros = "";
        for($i=0;$i<$og_length;$i++){
            $zeros.="0";
        }
        return $prefix.'-'.$zeros.$last_number;
    }
}