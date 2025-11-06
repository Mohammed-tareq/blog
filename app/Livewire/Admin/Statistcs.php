<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Livewire\Component;

class Statistcs extends Component
{
    public function render()
    {

        $categories = Category::count();
        $posts = Post::count();
        $comments = Comment::count();
        $users = User::count();
        return view('livewire.admin.statistcs',[
            'categories' => $categories,
            'posts' => $posts,
            'comments' => $comments,
            'users' => $users,
        ]);
    }
}
