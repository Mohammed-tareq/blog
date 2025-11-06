<?php

namespace App\Livewire\Admin;

use App\Models\Comment;
use App\Models\Post;
use Livewire\Component;

class LastPostsComments extends Component
{
    public function render()
    {
        $posts = Post::active()->with('category')->withCount('comments')->latest()->take(10)->get();
        $comments = Comment::active()->with(['post','user'])->latest()->take(10)->get();
        return view('livewire.admin.last-posts-comments',[
            'posts' => $posts,
            'comments' => $comments,
        ]);
    }
}
