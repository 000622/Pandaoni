@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Kelola Gambar Landing Page</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row g-4">
        @foreach($images as $img)
        <div class="col-md-4">
            <div class="card">
                @if($img->image)
                    <img src="{{ asset('storage/' . $img->image) }}" class="card-img-top" style="height:180px;object-fit:cover;">
                @else
                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height:180px;">
                        <span class="text-muted">Belum ada gambar</span>
                    </div>
                @endif
                <div class="card-body">
                    <h6 class="card-title">{{ $img->label }}</h6>
                    <form action="{{ route('admin.site-images.update', $img) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="image" class="form-control mb-2" accept="image/*" required>
                        @error('image') <div class="text-danger small mb-2">{{ $message }}</div> @enderror
                        <button type="submit" class="btn btn-sm btn-primary">Upload / Ganti</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection