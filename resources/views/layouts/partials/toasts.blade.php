<div class='toast' role='alert' aria-live='assertive' aria-atomic='true'>
    <div class='toast-header'>
        <i class='fas fa-exclamation-circle'></i>
        <strong class='mr-auto'>Notification</strong>
        <small>11 mins ago</small>
        <button type='button' class='ml-2 mb-1 close' data-dismiss='toast' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
    </div>
    <div class='toast-body'>
        @if (isset($toasts))
            {{ $toasts }}
        @endif
    </div>
</div>
