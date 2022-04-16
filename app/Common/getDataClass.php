<?php

namespace app\Common;

use App\Post;

class getDataClass
{
    public static function getData()
    {
      $posts = Post::where('status', 1)->orderBy('updated_at', 'DESC')->get();

      return $posts;
    }
}