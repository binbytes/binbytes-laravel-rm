<div class="btn-group btn-group-sm" role="group">
    @isset($showUrl)
        <a class="btn btn-white btn-show" rel="{{ $id?? '' }}" href="{{ $showUrl }}">
            <i class="material-icons">remove_red_eye</i>
        </a>
    @endisset
    @isset($editUrl)
        <a class="btn btn-white btn-edit" rel="{{ $id?? '' }}" href="{{ $editUrl }}">
            <i class="material-icons">edit</i>
        </a>
    @endisset
    @isset($deleteUrl)
        <button class="btn btn-white btn-delete" rel="{{ $id ?? '' }}" rel="{{ $deleteUrl }}">
            <i class="material-icons">delete</i>
        </button>
    @endisset
    @isset($downloadUrl)
        <a href="{{ $downloadUrl }}" rel="{{ $id ?? '' }}" class="btn btn-white">
            <i class="fas fa-download"></i>
        </a>
    @endisset
    @isset($billUrl)
        <a href="{{ $billUrl }}" rel="{{ $id ?? '' }}" class="btn btn-white btn-bill">
            <i class="fas fa-file-invoice"></i>
        </a>
    @endisset
</div>