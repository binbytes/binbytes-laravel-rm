<div class="d-flex justify-content-center">
    @isset($showUrl)
        <a class="btn btn-white" href="{{ $showUrl }}">
            <i class="fas fa-eye"></i>
        </a>
    @endisset
    @isset($editUrl)
        <a class="btn btn-white" href="{{ $editUrl }}">
            <i class="fas fa-edit"></i>
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