<form action="{{ route('events.store') }}" method="POST" id="eventForm" class="space-y-5">
    @csrf
    
    <!-- Event Title -->
    <div>
        <label class="block mb-1 font-semibold text-gray-700">
            <i class="fas fa-heading mr-2 text-cyan-600"></i> Event Title
        </label>
        <input type="text" name="title" 
               class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 transition" 
               placeholder="Enter event title" required>
    </div>
    
    <!-- Description -->
    <div>
        <label class="block mb-1 font-semibold text-gray-700">
            <i class="fas fa-align-left mr-2 text-cyan-600"></i> Description
        </label>
        <textarea name="description" 
                  class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 transition" 
                  placeholder="Write a short description"></textarea>
    </div>
    
    <!-- Event Date -->
    <div>
        <label class="block mb-1 font-semibold text-gray-700">
            <i class="fas fa-calendar-alt mr-2 text-cyan-600"></i> Event Date
        </label>
        <input type="date" name="event_date" 
               class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 transition" 
               required>
    </div>

    <!-- Dynamic Fields -->
    <div id="fieldsContainer" class="space-y-3"></div>

    <!-- Add Field Button -->
    <button type="button" id="addField" 
            class="w-full flex items-center justify-center gap-2 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
        <i class="fas fa-plus"></i> Add Custom Field
    </button>

    <!-- Submit -->
    <button type="submit" 
            class="w-full flex items-center justify-center gap-2 bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition">
        <i class="fas fa-save"></i> Save Event
    </button>
</form>

<!-- Script -->
<script>
    let fieldsContainer = document.getElementById('fieldsContainer');
    let addFieldBtn = document.getElementById('addField');
    let fieldIndex = 0;

    addFieldBtn.addEventListener('click', () => {
        let fieldHTML = `
            <div class="border border-gray-200 p-4 rounded-lg bg-gray-50 shadow-sm transform transition-all duration-300">
                <label class="block mb-1 font-semibold text-gray-700">
                    <i class="fas fa-tag mr-2 text-cyan-600"></i> Field Label
                </label>
                <input type="text" name="fields[${fieldIndex}][label]" 
                       class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-cyan-500 transition" 
                       placeholder="Enter label" required>

                <label class="block mt-3 mb-1 font-semibold text-gray-700">
                    <i class="fas fa-list mr-2 text-cyan-600"></i> Field Type
                </label>
                <select name="fields[${fieldIndex}][type]" 
                        class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-cyan-500 transition fieldType" required>
                    <option value="text">Text</option>
                    <option value="number">Number</option>
                    <option value="date">Date</option>
                    <option value="select">Select (Dropdown)</option>
                </select>

                <div class="optionsContainer mt-3 hidden">
                    <label class="block mb-1 font-semibold text-gray-700">
                        <i class="fas fa-list-ul mr-2 text-cyan-600"></i> Options (comma separated)
                    </label>
                    <input type="text" name="fields[${fieldIndex}][options]" 
                           class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-cyan-500 transition" 
                           placeholder="Option1, Option2, Option3">
                </div>
            </div>
        `;
        fieldsContainer.insertAdjacentHTML('beforeend', fieldHTML);

        let typeSelect = fieldsContainer.querySelector(`select[name="fields[${fieldIndex}][type]"]`);
        let optionsContainer = fieldsContainer.querySelectorAll(`.optionsContainer`)[fieldIndex];
        typeSelect.addEventListener('change', () => {
            optionsContainer.classList.toggle('hidden', typeSelect.value !== 'select');
        });

        fieldIndex++;
    });
</script>

<!-- Font Awesome CDN -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
