<div class="row">

    <!-- Data Tables -->
    <div class="col-md-6 mb-4">
        <div class="card-header overflow-hidden">
            <h5 class="mb-0">Last Posts</h5>
        </div>
        <div class="card overflow-hidden">
            <div class="table">
                <table class="table table-sm">
                    <thead>
                    <tr>
                        <th class="text-truncate">Title</th>
                        <th class="text-truncate">Category</th>
                        <th class="text-truncate">Comments</th>
                        <th class="text-truncate">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($posts as $post)
                        <tr>
                            @can('post.read')
                                <td class="text-truncate"><a
                                            href="{{ route('admin.posts.show', $post->id) }}">{{ substr($post->title, 0, 15) }}
                                        ...</a></td>
                            @endcan
                            @cannot('post.read')
                                <td class="text-truncate">{{ substr($post->title, 0, 15) }}...</td>
                            @endcannot
                            <td class="text-truncate">{{ substr($post->category->name,0,10) }}</td>
                            <td class="text-truncate text-center">{{ $post->comments_count }}</td>
                            <td>
                                <span class="badge bg-label-@if($post->status === 1)success @else danger @endif rounded-pill">{{ $post->status === 1 ? 'Active' : 'Inactive' }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No Posts Found</td>
                        </tr>

                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="card-header overflow-hidden">
            <h5 class="mb-0">Last Comments</h5>
        </div>
        <div class="card overflow-hidden">
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                    <tr>
                        <th class="text-truncate">Name</th>
                        <th class="text-truncate">Post</th>
                        <th class="text-truncate">Comment</th>
                        <th class="text-truncate">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($comments as $comment)
                        <tr>
                            @can('user.read')
                                <td class="text-truncate"><a
                                            href="{{ route('admin.users.show', $comment->user->id) }}">{{ substr($comment->user->name, 0, 8) }}
                                        ...</a></td>
                            @endcan
                            @cannot('user.read')
                                <td class="text-truncate">{{ substr($comment->user->name, 0, 8) }}...</td>
                            @endcannot
                            @can('post.comment')
                                <td class="text-truncate"><a
                                            href="{{ route('admin.posts.show', $comment->post->id) }}">{{ substr($comment->post->title, 0, 10) }}
                                        ...</a></td>
                            @endcan
                            @cannot('post.comment')
                                <td class="text-truncate">{{ substr($comment->post->title, 0, 10) }}...</td>
                            @endcannot
                            <td class="text-truncate text-center">{{ substr($comment->comment,0,15) }}...</td>
                            <td>
                                <span class="badge bg-label-@if($comment->status === 1)success @else danger @endif rounded-pill">{{ $comment->status === 1 ? 'Active' : 'Inactive' }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No Comments Found</td>
                        </tr>

                    @endforelse
                    </tbody>

                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <!--/ Data Tables -->
</div>
