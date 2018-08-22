<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    public function saving(User $user)
    {
        // 这样写扩展性更高，只有空的时候才指定默认头像
        if (empty($user->avatar)) {
            $user->avatar = 'https://i.pximg.net/img-original/img/2018/06/12/01/00/00/69191228_p0.png';
        }
    }
}