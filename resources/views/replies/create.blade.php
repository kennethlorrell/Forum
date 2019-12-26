<form method="POST" 
  action="{{ $thread->path() . '/replies' }}"
  class="my-5">
  @csrf
  <textarea placeholder="Describe your emotions about the topic"
    name="body" rows="6" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 mb-3"></textarea>
    <button class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded align-center" type="submit">
      Add reply
    </button>
</form>