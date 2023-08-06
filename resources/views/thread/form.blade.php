<div>
    <select 
        name="category_id" 
        class="bg-slate-800 border-1 border-slate-900 rounded-md w-full p-3 text-white/60 text-xs capitalize mb-4"
    
    >
        <option value="">Seleccionar cateoria</option>
        @foreach ($categories as $category)
            <option 
                value="{{ $category->id }}"
                @if (old('category_id',$thread->category_id == $category->id))
                    selected
                @endif
            >
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    {{-- 
        si la validación de los datos del formulario falla, 
        old('body', $thread->title) rellenará el campo title con el último valor 
        que el usuario había introducido. Si no hay ningún valor antiguo disponible 
        (por ejemplo, si es la primera vez que el usuario ve el formulario), 
        entonces se utilizará $thread->title.    
    --}}
    <input 
        type="text" 
        name="title" 
        placeholder="Titulo"
        class="bg-slate-800 border-1 border-slate-900 rounded-md w-full p-3 text-white/60 text-xs mb-4"
        value="{{ old('body', $thread->title) }}"
    >

    <textarea 
        name="body" 
        rows="10"
        placeholder="Descripción del problema"
        class="bg-slate-800 border-1 border-slate-900 rounded-md w-full p-3 text-white/60 text-xs mb-4"
    >
    {{-- El método old en Laravel se utiliza para recuperar un valor antiguo 
        que se ha enviado con los datos del formulario. --}}
    {{ old('body',  $thread->body) }}
    </textarea>
</div>