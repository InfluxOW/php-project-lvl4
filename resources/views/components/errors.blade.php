@if ($errors->any())
    @foreach ($errors->all() as $error)
    <div class="ui negative message">
        <i class="close icon"></i>
        <div class="header">
          {{ $error }}
        </div>
    </div>
    @endforeach
@endif

<script>
$('.message .close')
    .on('click', function() {
$(this)
    .closest('.message')
    .transition('fade')
;
    });
</script>
