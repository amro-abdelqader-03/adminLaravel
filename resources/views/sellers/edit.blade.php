@extends('sellers.layout')
     
@section('content')
<div class="card mt-5">
  <h2 class="card-header">Edit seller</h2>
  <div class="card-body">
  
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-primary btn-sm" href="{{ route('sellers.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
    </div>
  
    <form action="{{ route('sellers.update',$seller->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
  
        <div class="mb-3">
            <label for="inputName" class="form-label"><strong>Shop name:</strong></label>
            <input 
                type="text" 
                name="name" 
                value="{{ $seller->name }}"
                class="form-control @error('name') is-invalid @enderror" 
                id="inputName" 
                placeholder="Name">
            @error('name')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>
  
        <div class="mb-3">
            <label for="inputLocation" class="form-label"><strong>Shope location:</strong></label>
            <input 
                type="text" 
                name="location" 
                value="{{ $seller->location }}"
                class="form-control @error('location') is-invalid @enderror" 
                id="inputLocation" 
                placeholder="location">
            @error('email')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Update</button>
    </form>
  
  </div>
</div>
@endsection