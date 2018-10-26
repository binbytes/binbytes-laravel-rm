<div class="d-flex">
    @isset($approvedUrl)
        <a class="btn" href="{{ $approvedUrl }}">
            <i class="far fa-check-square"></i>
        </a>
    @endisset
    @isset($notApprovedUrl)
        <a class="btn" href="{{ $notApprovedUrl }}">
            <i class="far fa-window-close"></i>
        </a>
    @endisset
</div>