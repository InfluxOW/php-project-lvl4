@can('edit', $comment)
    <div class="modal fade" id="comment-modal-{{ $comment->id }}" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('comments.update', $comment->id) }}">
                    @method('PUT')
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Edit Comment') }}</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="message">{{ __('Update your message here') }}:</label>
                            <textarea required class="form-control" name="message"
                                      rows="3">{{ $comment->comment }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-outline-secondary text-uppercase"
                                data-dismiss="modal">{{ __('Cancel') }}
                        </button>
                        <button type="submit" class="btn btn-sm btn-outline-success text-uppercase">{{ __('Update') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endcan

<div class="modal fade" id="reply-modal-{{ $comment->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('comments.reply', $comment->id) }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Reply to Comment') }}</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="message">{{ __('Enter your message here') }}:</label>
                        <textarea required class="form-control" name="message" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary text-uppercase" data-dismiss="modal">
                        {{ __('Cancel') }}
                    </button>
                    <button type="submit" class="btn btn-sm btn-outline-success text-uppercase">{{ __('Reply') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
