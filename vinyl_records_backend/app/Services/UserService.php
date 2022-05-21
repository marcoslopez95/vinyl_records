<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserService extends BaseService{

    public function __construct(UserRepository $repository)
    {
        parent::__construct($repository);
    }

    public function _update(int $id, array $data)
    {
        $request['password'] = Hash::make($data['password']);
        $user = $this->repository->_show($id);

        if($data['avatar_'] != env('APP_URL').$user->avatar){
            $img = $data['avatar_'];
            $now = Carbon::now()->format('Y-m-d');
            $pos = strpos($img, ';');
            $type = explode(':', substr($img, 0, $pos))[1];
            $ext = preg_split("[/]", $type);
            $img = str_replace('data:image/'.$ext[1].';base64,', '', $img);
            $img_ = base64_decode($img);
            $var_for = uniqid().'-'.$now. '.'.$ext[1];
            $success = Storage::put('public/'.$var_for, $img_);
            $data['avatar'] = '/storage/'.$var_for;
        }
        unset($data['avatar_']);

        try{
            $update = $this->repository->_update($id,$data);
        }catch(\Exception $e){
            throw new Exception("Error al actualizar el usuario");
        }
        $user->fresh();

        $user->tastes()->sync($data['tastes']);

        return $user;
    }

    public function _show(int $id)
    {
        $user = parent::_show($id);

        $user->avatar = $user->avatar != null ? env('APP_URL'). $user->avatar : null;

        return $user;
    }
}
