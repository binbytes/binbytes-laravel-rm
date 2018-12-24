<div class="btn-group btn-group-sm" role="group">
    @isset($showUrl)
        <a class="btn btn-white" href="{{ $showUrl }}">
            <i class="material-icons">remove_red_eye</i>
        </a>
    @endisset
    @isset($editUrl)
        <a class="btn btn-white" href="{{ $editUrl }}">
            <i class="material-icons">edit</i>
        </a>
    @endisset
    @isset($deleteUrl)
        <button class="btn btn-white btn-delete" rel="{{ $deleteUrl }}">
            <i class="material-icons">delete</i>
        </button>
    @endisset
    @isset($downloadUrl)
        <a href="{{ $downloadUrl }}" class="btn btn-white">
            <i class="fas fa-download"></i>
        </a>
    @endisset
</div>