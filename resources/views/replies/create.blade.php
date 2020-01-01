<form method="POST" 
  action="{{ $thread->path() . '/replies' }}"
  class="my-5">
  @csrf
  <textarea placeholder="Do you mind to share your opinion about the topic?"
    name="body" rows="6" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 focus:bg-white focus:border-blue-700 mb-3"></textarea>
    <button class="shadow bg-blue-800 hover:bg-blue-700 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded align-center" type="submit">
      Add reply
    </button>
    @include('threads.validate')
</form>