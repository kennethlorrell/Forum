@extends('layouts.app')

@section('content')

  	<form class="w-full max-w-sm m-auto align-middle"
    method="POST" 
  	action="/threads">

  		@csrf

      <div class="md:flex md:items-center mb-6">
        <div class="md:w-1/3">
          <label class="block text-gray-600 font-bold md:text-right mb-1 md:mb-0 pr-4" for="title">
            Title
          </label>
        </div>
        <div class="md:w-2/3">
          <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="title" name="title" type="text"
          value="{{ old('title') }}" required>
        </div>
      </div>

      <div class="md:flex md:items-center mb-6">
        <div class="md:w-1/3">
          <label class="block text-gray-600 font-bold md:text-right mb-1 md:mb-0 pr-4" for="description">
            Description
          </label>
        </div>
        <div class="md:w-2/3">
          <textarea class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="description" 
          name="description" required>{{ old('description') }}</textarea>
        </div>
      </div>

      <div class="md:flex md:items-center mb-6">
        <div class="md:w-1/3">
          <label class="block text-gray-600 font-bold md:text-right mb-1 md:mb-0 pr-4" for="category">
            Category
          </label>
        </div>
        <div class="md:w-2/3">
          <div class="relative">
            <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state" 
            name="category_id" required>
              <option value="">Select one</option>
              @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') ==  $category->id ? 'selected' : ''}}>
                  {{ $category->name }}
                </option>
              @endforeach
            </select>
          <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
          <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
          </div>
        </div>
        </div>
      </div>

      <div class="md:flex md:items-center">
        <div class="md:w-1/3"></div>
        <div class="md:w-2/3">
          <button class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
            Create
          </button>
        </div>
      </div>
      <div class="my-5 text-center text-red-600">
        @include('threads.validate')
      </div>

    </form>

@endsection