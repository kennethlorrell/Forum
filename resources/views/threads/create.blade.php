@extends('layouts.app')

@section('content')

  <form method="POST" action="/threads">
    @csrf

    <div class="form-group">
      <label for="title">Title</label>
      <input class="form-control" id="title" name="title" 
      type="text" value="{{ old('title') }}" required>
    </div>

    <div class="form-group">
      <label for="description">Description</label>
      <textarea class="form-control" id="description" 
      name="description" required>{{ old('description') }}</textarea>
    </div>

    <div class="form-group">
      <label for="category">Category</label> 
      <select class="form-control" id="category" name="category_id" required>
        <option value="">Select one</option>
          @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id') ==  $category->id ? 'selected' : ''}}>
              {{ $category->name }}
            </option>
          @endforeach
      </select>
    </div>

    <div class="form-group">
      <button type="submit" class="btn btn-info text-white">Create</button>
    </div>

    @include('threads.validate')
  </form>

@endsection