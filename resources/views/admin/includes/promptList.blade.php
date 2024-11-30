@foreach ($prompts as $item)
    <div class="card border shadow-lg rounded-3">
        <div class="card-body">
            <div class="row">
                <div class="col-md">
                    <h5 class="card-title">{{ $item->text }}</h5>
                    <p class="card-text">{{ $item->description }}</p>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('admin.prompts.edit', $item->id) }}" class="btn btn-sm btn-primary"><i class="align-middle" data-feather="edit"></i></a>
                    <form action="{{ route('admin.prompts.delete', $item->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">
                            <i class="align-middle" data-feather="trash-2"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
