<?php

namespace app\Common;

use App\User;

class getUserClass
{
    public static function getUser()
    {
      $user = \Auth::user();

      return $user;
    }
}