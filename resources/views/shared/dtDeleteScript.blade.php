$('#{{ $dtTable }}').on('click', '.btn-delete', function (e) {

    if (! confirm("Are you sure you want to delete?")) {
        e.preventDefault();
        return false;
    } else {
        axios.delete($(this).attr('rel')).then(() => {
            {{ $dtVar }}.draw()
        })
    }
})