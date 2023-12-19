<?php

use Domain\User\Models\User;

/**
 *
 * @return User
 */
function currentUser(): User
{
    return auth()->user();
}
