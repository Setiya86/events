<form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data" id="eventForm" class="space-y-5 overflow-y-auto">
    @csrf
    
    <!-- Event Title -->
    <div>
        <label class="block mb-1 font-semibold text-gray-700">Event Title</label>
        <input type="text" name="title" class="w-full border rounded-lg p-3" required>
    </div>

    <!-- Category -->
    <div>
        <label class="block mb-1 font-semibold text-gray-700">Category</label>
        <select name="category" class="w-full border rounded-lg p-3" required>
            <option value="">-- Select Category --</option>
            <option value="Seminar">Seminar</option>
            <option value="Workshop">Workshop</option>
            <option value="Kompetisi">Kompetisi</option>
            <option value="Lomba">Lomba</option>
            <option value="Pelatihan">Pelatihan</option>
        </select>
    </div>

    <!-- Poster -->
    <div>
        <label class="block mb-1 font-semibold text-gray-700">Event Poster</label>
        <input type="file" name="poster" accept="image/*" id="posterInput" class="w-full border rounded-lg p-3">
        <img id="posterPreview" class="mt-3 max-h-48 rounded-lg shadow hidden" alt="Preview Poster">
    </div>

    <!-- Description -->
    <div>
        <label class="block mb-1 font-semibold text-gray-700">Description</label>
        <textarea name="description" class="w-full border rounded-lg p-3"></textarea>
    </div>

    <!-- Event Date -->
    <div>
        <label class="block mb-1 font-semibold text-gray-700">Event Date</label>
        <input type="date" name="event_date" class="w-full border rounded-lg p-3" required>
    </div>

    <!-- Dynamic Fields -->
    <div id="fieldsContainer" class="space-y-3"></div>

    <!-- Add Field Button -->
    <button type="button" id="addField" class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg">
        + Add Custom Field
    </button>

    <!-- Submit -->
    <button type="submit" class="w-full bg-green-500 text-white px-4 py-2 rounded-lg">
        Save Event
    </button>
</form>

<script>
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

    // Dynamic Fields
    let fieldsContainer = document.getElementById('fieldsContainer');
    let addFieldBtn = document.getElementById('addField');
    let fieldIndex = 0;

    addFieldBtn.addEventListener('click', () => {
        let fieldHTML = `
            <div class="relative border p-4 rounded-lg bg-gray-50 shadow-sm" data-field="${fieldIndex}">
                <!-- Tombol hapus -->
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

        let typeSelect = fieldsContainer.querySelectorAll('.fieldType')[fieldIndex];
        let optionsContainer = fieldsContainer.querySelectorAll('.optionsContainer')[fieldIndex];
        
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
</script>
