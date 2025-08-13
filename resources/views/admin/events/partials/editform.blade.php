<form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data" id="eventForm" class="space-y-5 overflow-y-auto">
    @csrf
    @method('PUT')
    
    <!-- Event Title -->
    <div>
        <label class="block mb-1 font-semibold text-gray-700">Event Title</label>
        <input type="text" name="title" value="{{ old('title', $event->title) }}" class="w-full border rounded-lg p-3" required>
    </div>

    <!-- Category -->
    <div>
        <label class="block mb-1 font-semibold text-gray-700">Category</label>
        <select name="category" class="w-full border rounded-lg p-3" required>
            <option value="">-- Select Category --</option>
            @foreach(['Seminar','Workshop','Kompetisi','Lomba','Pelatihan'] as $cat)
                <option value="{{ $cat }}" {{ old('category', $event->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
            @endforeach
        </select>
    </div>

    <!-- Poster -->
    <div>
        <label class="block mb-1 font-semibold text-gray-700">Event Poster</label>
        <input type="file" name="poster" accept="image/*" id="posterInput" class="w-full border rounded-lg p-3">
        @if($event->poster)
            <img id="posterPreview" src="{{ asset('storage/'.$event->poster) }}" class="mt-3 max-h-48 rounded-lg shadow" alt="Preview Poster">
        @else
            <img id="posterPreview" class="mt-3 max-h-48 rounded-lg shadow hidden" alt="Preview Poster">
        @endif
    </div>

    <!-- Description -->
    <div>
        <label class="block mb-1 font-semibold text-gray-700">Description</label>
        <textarea name="description" class="w-full border rounded-lg p-3">{{ old('description', $event->description) }}</textarea>
    </div>

    <!-- Event Date -->
    <div>
        <label class="block mb-1 font-semibold text-gray-700">Event Date</label>
        <input type="date" name="event_date" value="{{ old('event_date', $event->event_date) }}" class="w-full border rounded-lg p-3" required>
    </div>

    <!-- Dynamic Fields -->
    <div id="fieldsContainer" class="space-y-3">
        @php $fieldIndex = 0; @endphp
        @foreach($event->fields as $field)
            <div class="relative border p-4 rounded-lg bg-gray-50 shadow-sm" data-field="{{ $fieldIndex }}">
                <!-- Tombol hapus -->
                <button type="button" onclick="removeField({{ $fieldIndex }})" 
                        class="absolute top-2 right-2 text-red-500 hover:text-red-700 text-lg font-bold">✖</button>
                
                <input type="hidden" name="fields[{{ $fieldIndex }}][id]" value="{{ $field->id }}">

                <label>Field Label</label>
                <input type="text" name="fields[{{ $fieldIndex }}][label]" value="{{ $field->label }}" class="w-full border rounded p-2" required>

                <label class="mt-2 block">Field Type</label>
                <select name="fields[{{ $fieldIndex }}][type]" class="w-full border rounded p-2 fieldType">
                    @foreach(['text','email','number','date','textarea','radio','checkbox','select'] as $type)
                        <option value="{{ $type }}" {{ $field->type == $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
                    @endforeach
                </select>

                <div class="optionsContainer mt-2 {{ in_array($field->type, ['radio','checkbox','select']) ? '' : 'hidden' }}">
                    <label>Options (comma separated)</label>
                    <input type="text" name="fields[{{ $fieldIndex }}][options]" 
                           value="{{ $field->options ? implode(',', (array) $field->options) : '' }}" 
                           class="w-full border rounded p-2" placeholder="Option1,Option2">
                </div>
            </div>
            @php $fieldIndex++; @endphp
        @endforeach
    </div>

    <!-- Add Field Button -->
    <button type="button" id="addField" class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg">
        + Add Custom Field
    </button>

    <!-- Submit -->
    <button type="submit" class="w-full bg-green-500 text-white px-4 py-2 rounded-lg">
        Update Event
    </button>
</form>

<script>
    let fieldsContainer = document.getElementById('fieldsContainer');
    let addFieldBtn = document.getElementById('addField');
    let fieldIndex = {{ $fieldIndex ?? 0 }};

    // Poster Preview
    document.getElementById('posterInput').addEventListener('change', function(e) {
        const preview = document.getElementById('posterPreview');
        const file = e.target.files[0];
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('hidden');
        } else {
            preview.classList.add('hidden');
        }
    });

    // Add New Field
    addFieldBtn.addEventListener('click', () => {
        let fieldHTML = `
            <div class="relative border p-4 rounded-lg bg-gray-50 shadow-sm" data-field="${fieldIndex}">
                <button type="button" onclick="removeField(${fieldIndex})" 
                        class="absolute top-2 right-2 text-red-500 hover:text-red-700 text-lg font-bold">✖</button>
                
                <label>Field Label</label>
                <input type="text" name="fields[${fieldIndex}][label]" class="w-full border rounded p-2" required>

                <label class="mt-2 block">Field Type</label>
                <select name="fields[${fieldIndex}][type]" class="w-full border rounded p-2 fieldType">
                    <option value="text">Text</option>
                    <option value="email">Email</option>
                    <option value="number">Number</option>
                    <option value="date">Date</option>
                    <option value="textarea">Textarea</option>
                    <option value="radio">Radio</option>
                    <option value="checkbox">Checkbox</option>
                    <option value="select">Select</option>
                </select>

                <div class="optionsContainer mt-2 hidden">
                    <label>Options (comma separated)</label>
                    <input type="text" name="fields[${fieldIndex}][options]" class="w-full border rounded p-2" placeholder="Option1,Option2">
                </div>
            </div>
        `;
        fieldsContainer.insertAdjacentHTML('beforeend', fieldHTML);

        let typeSelect = fieldsContainer.querySelector(`[data-field="${fieldIndex}"] .fieldType`);
        let optionsContainer = fieldsContainer.querySelector(`[data-field="${fieldIndex}"] .optionsContainer`);
        
        typeSelect.addEventListener('change', () => {
            let showOptions = ['radio', 'checkbox', 'select'].includes(typeSelect.value);
            optionsContainer.classList.toggle('hidden', !showOptions);
        });

        fieldIndex++;
    });

    function removeField(index) {
        let field = fieldsContainer.querySelector(`[data-field="${index}"]`);
        if (field) field.remove();
    }

    // Event untuk field lama (optionsContainer)
    document.querySelectorAll('.fieldType').forEach((select, idx) => {
        let optionsContainer = select.closest('[data-field]').querySelector('.optionsContainer');
        select.addEventListener('change', () => {
            let showOptions = ['radio', 'checkbox', 'select'].includes(select.value);
            optionsContainer.classList.toggle('hidden', !showOptions);
        });
    });
</script>
