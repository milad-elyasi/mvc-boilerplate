<?php

namespace App\Controllers;

use Core\App;
use Core\Request;
use App\Models\Post;
use App\Models\Users;
use UserRepository;

class BaseController
{
    public function index()
    {
        return view('blog.index');
    }

    public function create()
    {
        $title = 'Create new Post';
        $status = Post::$status;
        $users = App::get('DB')->selectAll(Users::$table);
        return view('blog.create', compact('title', 'status', 'users'));
    }

    public function store()
    {
        $params = [
            'title' => (empty($_POST['title'])) ? '' : trim(strip_tags($_POST['title'])),
            'starting_date' => (empty($_POST['starting_date'])) ? '' : trim(strip_tags($_POST['starting_date'])),
            'ending_date' => (empty($_POST['ending_date'])) ? '' : trim(strip_tags($_POST['ending_date'])),
            'status' => (empty($_POST['status'])) ? 0 : trim(strip_tags($_POST['status'])),
            'user_id' => (empty($_POST['user'])) ? 0 : trim(strip_tags($_POST['user'])),
        ];

        if (empty($params['title'])) {
            return redirect('blog/create');
        }

        try {
            App::get('DB')->insert(Post::$table, $params);
        } catch (Exception $e) {
            include "Views/500.php";
        }

        return redirect('blog');
    }

    public function edit()
    {
        if (Request::get('id') == null) {
            include "Views/404.php";
            exit(0);
        }

        $id = trim(strip_tags(Request::get('id')));

        $task = App::get('DB')->first(Post::$table, id: $id);
        if (empty($task)) {
            include "Views/404.php";
            exit(0);
        }

        $task = $task[0];
        $title = $task->title . ' | blog edit';
        $status = Post::$status;

        return view('blog.update', compact('task', 'title', 'status'));
    }

    public function update()
    {

        $params = [
            'title' => (empty($_POST['title'])) ? '' : trim(strip_tags($_POST['title'])),
            'starting_date' => (empty($_POST['starting_date'])) ? '' : trim(strip_tags($_POST['starting_date'])),
            'ending_date' => (empty($_POST['ending_date'])) ? '' : trim(strip_tags($_POST['ending_date'])),
            'status' => (empty($_POST['status'])) ? 0 : trim(strip_tags($_POST['status']))
        ];

        if (empty($params['title'])) {
            include "Views/500.php";
            exit(0);
        }

        try {
            App::get('DB')->update(Post::$table, $params, $id);
        } catch (Exception $e) {
            include "Views/500.php";
        }

        return redirect('blog');
    }

    public function delete()
    {
        if (Request::get('id') == null) {
            include "Views/404.php";
        }

        $id = trim(strip_tags(Request::get('id')));

        $task = App::get('DB')->first(Post::$table, id: $id);
        if (!empty($task)) {
            App::get('DB')->delete(Post::$table, $id);
        }

        return redirect('blog');
    }
}
