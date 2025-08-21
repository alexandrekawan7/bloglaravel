@extends('layouts.app')
@section('content')
<div class="container">
  <h1>Editar post</h1>
  <section class="mt-3">
    <form method="POST" action="{{ "/edit/" . $post->id }}" enctype="multipart/form-data">
    @method('PUT')
    @csrf
      <!-- Error message when data is not inputted -->
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      <div class="card p-3 flex flex-col">
        <label for="floatingInput">Título</label>
        <input class="form-control border rounded p-2" type="text" name="title" value="{{ $post->title }}">
        <label for="floatingTextArea">Descrição</label>
        <textarea class="form-control border rounded p-2" name="description" id="floatingTextarea" cols="30" rows="10">{{ $post->description }}</textarea>
        <img id="imagePreview" src="{{ asset('images/' . $post->image) }}" style="max-width: 300px; max-height: 200px; border-radius: 8px; margin-bottom: 10px; border: 2px solid #ddd;"/>
        <label for="formFile" class="bg-black text-white px-4 py-2 rounded cursor-pointer hover:bg-gray-800 transition-colors duration-200 inline-block" style="background-color: black; color: white; padding: 8px 16px; border-radius: 4px; cursor: pointer; display: inline-block; margin-top: 8px;">
          Escolher imagem
          <input id="formFile" style="display: none;" type="file" name="image" onchange="previewImage(this)">
        </label>

        <div class="flex justify-end">
          <button type="submit" class="btn btn-dark form-control" style="background-color: black; color: white; padding: 8px 16px; border-radius: 4px; border: none; font-weight: 500; margin-top: 16px; transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='#333'" onmouseout="this.style.backgroundColor='black'">
            Salvar Post
          </button>
        </div>
      </div>
      
    </form>
  </section>
    
</div>

<script>
function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.src = '';
        preview.style.display = 'none';
    }

    
    document.querySelector('#mainForm').addEventListener('submit', (ev) => ev.preventDefault())
}
</script>

@endsection