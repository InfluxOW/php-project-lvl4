@if(isset($reply) && $reply === true)
    <div id="comment-{{ $comment->id }}" class="media">
@else
    <li id="comment-{{ $comment->id }}" class="media">
@endif
<img class="mr-3" src="https://www.gravatar.com/avatar/{{ md5($comment->commenter->email) }}.jpg?s=64"
        alt="{{ $comment->commenter->name }} Avatar">
<div class="media-body">
    <h5 class="mt-0 mb-1">
        <a href="{{ route('users.show', $comment->commenter) }}">{{ $comment->commenter->name }}</a>
        <small class="text-muted">- {{ $comment->created_at->diffForHumans() }}</small>
    </h5>
    <div>
        {!! $comment->comment!!}
    </div>

    <p>
        <button data-toggle="modal" data-target="#reply-modal-{{ $comment->id }}"
                class="btn btn-sm btn-link text-uppercase">{{ __('Reply') }}
        </button>
        @can('edit', $comment)
            <button data-toggle="modal" data-target="#comment-modal-{{ $comment->id }}"
                    class="btn btn-sm btn-link text-uppercase">{{ __('Edit') }}
            </button>
        @endcan
        @can('delete', $comment)
            <a href="#"
                onclick="event.preventDefault();document.getElementById('comment-delete-form-{{ $comment->id }}').submit();"
                class="btn btn-sm btn-link text-danger text-uppercase">{{ __('Delete') }}</a>
    <form id="comment-delete-form-{{ $comment->id }}"
            action="{{route('comments.delete', $comment->id)  }}" method="POST" style="display: none;">
        @method('DELETE')
        @csrf
    </form>
    @endcan
    </p>

        @include('comments::components.comment.forms')
        <br/>

        @foreach($comment->allChildrenWithCommenter as $child)
            @include('comments::components.comment.comment', [
                    'comment' => $child,
                    'reply' => true
                ])
        @endforeach
</div>

    {!! isset($reply) && $reply === true ? '</div>' : '</li>' !!}
