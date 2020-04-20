@if ($errors->any())
    @foreach ($errors->all() as $error)
    <div class="ui negative important message">
        <i class="close icon"></i>
        <div class="header">
          {{ $error }}
        </div>
    </div>
    @endforeach
@endif
