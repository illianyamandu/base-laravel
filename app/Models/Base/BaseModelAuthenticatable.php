<?php

namespace App\Models\Base;

use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Auth\{Authenticatable, MustVerifyEmail};
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\{Authenticatable as AuthenticatableContract, CanResetPassword as CanResetPasswordContract};
use Illuminate\Foundation\Auth\Access\Authorizable;

class BaseModelAuthenticatable extends BaseModel implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable;
    use Authorizable;
    use CanResetPassword;
    use MustVerifyEmail;
}
