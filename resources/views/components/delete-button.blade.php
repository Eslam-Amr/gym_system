<form class="d-inline" id="deleteForm-{{ $id }}" action="{{ $href }}" method="post">
    @csrf
    @method('DELETE')
    <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $id }})">

        <i class="fe fe-trash-2 fa-2x"></i>
    </button>
</form>
