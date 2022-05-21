<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

if(function_exists('create_image')){

    /**
     *Crear imagen
     */
    function custom_image($img)
    {
        try{
            $route_web = env('CUSTOM_URL') . '/images/';
            $now = Carbon::now()->format('Y-m-d');
            $ext = get_extension($img);
            $img = str_replace('data:image/'.$ext.';base64,', '', $img);
            $data = base64_decode($img);
            $var_for = uniqid().'-'.$now. '.'.$ext;
            $image = $route_web . $var_for;
            //$success = file_put_contents($file, $data);
            $success = Storage::put('public/'.$var_for, $data);
            return $success ?$image: false;
        }catch (\Exception $e){
            custom_error($e);
            return null;
        }

    }
}

if(function_exists('get_extension')){
    function get_extension($string)
    {
        $extension="";
        if(!empty($string)){
            if(substr($string,0,4)=='http'){
                return $extension=3;
            }else {
                $data = $string;
                $pos = strpos($data, ';');
                $type = explode(':', substr($data, 0, $pos))[1];
                $extension = preg_split("[/]", $type);
                return $extension[1];
            }
        }else{
            return null;
        }
    }
}




if (! function_exists('custom_response')){
    function custom_response(bool $success = true, string $message = '',$data = [],int $code = 200)
    {
        if (!$success) {
            if ($code == 200) {
                $code = 425;
            }
            $message = $message !== '' ? $message :'Error al ejecutar la consulta';
            $response['total'] = 0;
        }

        $response = [
            'success' => $success,
            'message' => $message,
            'data'    => $data,
        ];

        if ($message != 'index') {
            $response['total'] = 1;
        }else
        if ($message == 'index') {
            $response['total'] = count($data);
        }

        return response()->json($response, $code);
    }
}

if (! function_exists('custom_error')){
    function custom_error(\Exception $e)
    {
        $error = [
            'line'    => $e->getLine(),
            'file'    => $e->getFile(),
            'message' => $e->getMessage()
        ];

        Log::alert($error);
        return custom_response(false);
    }
}

