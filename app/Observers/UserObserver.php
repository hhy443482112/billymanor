<?php

namespace App\Observers;

use App\Models\User;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class UserObserver
{
    public function saving(User $user)
    {
        // 这样写扩展性更高，只有空的时候才指定默认头像
        if (empty($user->avatar)) {
            $user->avatar = 'https://tva4.sinaimg.cn/crop.436.54.720.720.180/63a8f0e5gw1eghdzji7w6j20xc0nidw7.jpg';
        }
    }
}