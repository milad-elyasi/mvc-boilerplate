<?php

namespace App\Models;

class Post
{
    public static string $table = 'blog';

    public static array $status = [
        0 => 'To Do',
        1 => 'In Progress',
        2 => 'Done'
    ];
}
