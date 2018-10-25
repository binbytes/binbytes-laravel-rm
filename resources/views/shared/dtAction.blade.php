<div class="d-flex">
    @isset($updateUrl)
        <a class="btn btn-white" href="{{ $updateUrl }}">
            <i class="fas fa-eye"></i>
        </a>
    @endisset
    @isset($deleteUrl)
        {{ html()->form('DELETE', $deleteUrl)->open() }}
            <button type="submit" class="btn btn-white">
                <i class="fas fa-trash-alt"></i>
            </button>
        {{ html()->form()->close() }}
    @endisset
</div>