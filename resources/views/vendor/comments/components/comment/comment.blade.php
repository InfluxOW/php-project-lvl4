<div class="zero-bottom zero-top">
    @if(isset($reply) && $reply === true)
        <div id="comment-{{ $comment->id }}" class="custom-left">
    @endif
    <div class="comment">
        <a class="avatar">
            <img src="{{ isset($comment->commenter->image) ? $comment->commenter->image->url : "https://udemy-project-1.s3.eu-west-3.amazonaws.com/avatars/default-user-image.png" }}">
        </a>
        <div class="content">
            <a class="author">{{ $comment->commenter->name }}</a>
            <div class="metadata">
                <span class="date">{{ $comment->created_at->diffForHumans() }}</span>
            </div>
            <div class="text">
                {!! $comment->comment!!}
            </div>
            <div class="actions">
                <p>
                    <a data-toggle="modal" data-target="#reply-modal-{{ $comment->id }}"
                        class="reply">Reply
                    </a>
                    @can('edit', $comment)
                    <a data-toggle="modal" data-target="#comment-modal-{{ $comment->id }}"
                        class="edit">Edit
                    </a>
                    @endcan
                    @can('delete', $comment)
                    <a href="{{ route('comments.delete', $comment) }}" data-confirm="Are you sure?" data-method="delete" rel="nofollow">Delete</a>
                    <form id="comment-delete-form-{{ $comment->id }}"
                        action="{{route('comments.delete', $comment->id)  }}" method="POST" style="display: none;">
                        @method('DELETE')
                        @csrf
                    </form>
                    @endcan
                </p>
            </div>
        </div>

            @include('comments::components.comment.forms')
            <br/>

            @foreach($comment->allChildrenWithCommenter as $child)
                @include('comments::components.comment.comment', [
                        'comment' => $child,
                        'reply' => true
                    ])
            @endforeach
    </div>

    {!! isset($reply) && $reply === true ? '</div>' : '' !!}
</div>
