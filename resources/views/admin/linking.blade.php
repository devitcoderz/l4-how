@extends('admin.layouts.app')

@section('content')
<main class="content">
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Link Users & Prompts</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.link.prompts', $user) }}" method="POST">
                            @csrf
                            <div class="mb-1">
                                <label for="user-select" class="form-label">Select User</label>
                                <select name="selectedUser" id="user-select" class="form-select choices-single" data-live-search="true" aria-label="Select a User">
                                    <option selected disabled>- No user selected -</option>
                                    @foreach ($users as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('selectedUser')
                                    <p class="form-text text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-1">
                                <button type="submit" class="btn btn-success">View Prompts</button>
                            </div>
                        </form>
                        <br>
                        <div class="p-3">
                            <div class="mb-1">
                                <label class="form-label fw-bold">No user selected, select one to see their assigned prompts</label>
                            </div>
                            <div class="mb-1">
                                @foreach ($prompts as $prompt)
                                    <div class="card p-2">
                                        <div class="form-check">
                                            <input id="prompt-{{ $prompt->id }}" class="form-check-input" type="checkbox">
                                            <label for="prompt-{{ $prompt->id }}" class="form-check-label" aria-describedby="promptHelp">{{ $prompt->text }}</label>
                                            <div id="promptHelp" class="form-text">{{ $prompt->description }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection