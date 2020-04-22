<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('comments.store') }}">
            @csrf
            <input type="hidden" name="commentable_encrypted_key" value="{{ $model->getEncryptedKey() }}"/>

            <div class="form-group">
                <label for="message">{{ __('Enter your message here') }}:</label>
                <textarea class="form-control @if($errors->has('message')) is-invalid @endif" name="message"
                          rows="3"></textarea>
                <div class="invalid-feedback">
                    {{ __('Your message is required.') }}
                </div>
            </div>
            <button type="submit" class="btn btn-sm btn-outline-success text-uppercase">{{ __('Submit') }}</button>
        </form>
    </div>
</div>
<br/>
