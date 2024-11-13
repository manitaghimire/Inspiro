<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Upload;

class UploadPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function update(User $user, Upload $upload)
    {
        return $user->id === $upload->user_id;
    }
    public function delete(User $user, Upload $upload)
    {
        return $user->id === $upload->user_id;
    }
}
