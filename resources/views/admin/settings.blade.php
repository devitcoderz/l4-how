@extends('admin.layouts.app')

@section('content')
<main class="content">
    <div class="container-fluid p-1">
        <h1 class="h3 mb-3">Settings</h1>
        @if (Session::has("message"))
            <div style="background-color: {{Session::get('message')['bg']}}; padding:5px;">
                <b>{{Session::get('message')['msg']}}</b>
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <form action="{{route('admin.save-settings')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="banner_img" class="form-label">Banner Image</label>
                                @if (!empty($settings->banner_img) && Storage::disk('public')->exists('images/' . $settings->banner_img))
                                    <div class="mb-2">
                                        <img src="{{ Storage::url('images/' . $settings->banner_img) }}" alt="Banner Image" class="img-thumbnail" style="max-width: 200px;">
                                    </div>
                                @elseif(empty($settings->banner_img))
                                    <div class="mb-2">
                                        <img src="{{ asset('images/heading.gif') }}" alt="Banner Image" class="img-thumbnail" style="max-width: 200px;">
                                    </div>
                                @endif
                                <input type="file" class="form-control @error('banner_img') is-invalid @enderror" id="banner_img" name="banner_img">
                                @error('banner_img')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Background Image -->
                            <div class="col-md-6 mb-3">
                                <label for="background_img" class="form-label">Background Image</label>
                                @if (!empty($settings->background_img) && Storage::disk('public')->exists('images/' . $settings->background_img))
                                    <div class="mb-2">
                                        <img src="{{ Storage::url('images/' . $settings->background_img) }}" alt="Background Image" class="img-thumbnail" style="max-width: 200px;">
                                    </div>
                                @elseif(empty($settings->background_img))
                                    <div class="mb-2">
                                        <img src="{{ asset('images/btx2-background.png') }}" alt="Background Image" class="img-thumbnail" style="max-width: 200px;">
                                    </div>
                                @endif
                                <input type="file" class="form-control @error('background_img') is-invalid @enderror" id="background_img" name="background_img">
                                @error('background_img')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            

                            <!-- Shadow Color -->
                            <div class="col-md-6 mb-3">
                                <label for="shadow_color" class="form-label">Shadow Color</label>
                                <input type="color" class="form-control form-control-color @error('shadow_color') is-invalid @enderror" id="shadow_color" name="shadow_color" value="{{ old('shadow_color', $settings->shadow_color ?? '#32cd32') }}">
                                @error('shadow_color')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Countdown Color -->
                            <div class="col-md-6 mb-3">
                                <label for="countdown_color" class="form-label">Countdown Color</label>
                                <input type="color" class="form-control form-control-color @error('countdown_color') is-invalid @enderror" id="countdown_color" name="countdown_color" value="{{ old('countdown_color', $settings->countdown_color ?? '#32cd32') }}">
                                @error('countdown_color')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Table Colors -->
                            <div class="col-md-6 mb-3">
                                <label for="table_title_color" class="form-label">Table Title Color</label>
                                <input type="color" class="form-control form-control-color @error('table_title_color') is-invalid @enderror" id="table_title_color" name="table_title_color" value="{{ old('table_title_color', $settings->table_title_color ?? '#32cd32') }}">
                                @error('table_title_color')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="table_border_color" class="form-label">Table Border Color</label>
                                <input type="color" class="form-control form-control-color @error('table_border_color') is-invalid @enderror" id="table_border_color" name="table_border_color" value="{{ old('table_border_color', $settings->table_border_color ?? '#32cd32') }}">
                                @error('table_border_color')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="table_prizes_color" class="form-label">Table Prizes Color</label>
                                <input type="color" class="form-control form-control-color @error('table_prizes_color') is-invalid @enderror" id="table_prizes_color" name="table_prizes_color" value="{{ old('table_prizes_color', $settings->table_prizes_color ?? '#32cd32') }}">
                                @error('table_prizes_color')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="table_text_color" class="form-label">Table Text Color</label>
                                <input type="color" class="form-control form-control-color @error('table_text_color') is-invalid @enderror" id="table_text_color" name="table_text_color" value="{{ old('table_text_color', $settings->table_text_color ?? '#ffffff') }}">
                                @error('table_text_color')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Button Colors -->
                            <div class="col-md-6 mb-3">
                                <label for="button_text_color" class="form-label">Button Text Color</label>
                                <input type="color" class="form-control form-control-color @error('button_text_color') is-invalid @enderror" id="button_text_color" name="button_text_color" value="{{ old('button_text_color', $settings->button_text_color ?? '#ffffff') }}">
                                @error('button_text_color')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="button_background_color" class="form-label">Button Background Color</label>
                                <input type="color" class="form-control form-control-color @error('button_background_color') is-invalid @enderror" id="button_background_color" name="button_background_color" value="{{ old('button_background_color', $settings->button_background_color ?? '#222222') }}">
                                @error('button_background_color')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="button_background_hover_color" class="form-label">Button Background Hover Color</label>
                                <input type="color" class="form-control form-control-color @error('button_background_hover_color') is-invalid @enderror" id="button_background_hover_color" name="button_background_hover_color" value="{{ old('button_background_hover_color', $settings->button_background_hover_color ?? '#32cd32') }}">
                                @error('button_background_hover_color')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="text_color" class="form-label">Text Color</label>
                                <input type="color" class="form-control form-control-color @error('text_color') is-invalid @enderror" id="text_color" name="text_color" value="{{ old('text_color', $settings->text_color ?? '#fffff') }}">
                                @error('text_color')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
