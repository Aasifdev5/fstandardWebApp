<div class="col-md-4 mb-3">
    <label class="form-label">Pattern ID</label>
    <input type="text" class="form-control" name="pattern_id" value="{{ old('pattern_id', $pattern->pattern_id ?? '') }}" required>
</div>

<div class="col-md-4 mb-3">
    <label class="form-label">Name</label>
    <input type="text" class="form-control" name="name" value="{{ old('name', $pattern->name ?? '') }}" required>
</div>

<div class="col-md-4 mb-3">
    <label class="form-label">Category</label>
    <input type="text" class="form-control" name="category" value="{{ old('category', $pattern->category ?? '') }}">
</div>

<div class="col-md-4 mb-3">
    <label class="form-label">Direction</label>
    <input type="text" class="form-control" name="direction" value="{{ old('direction', $pattern->direction ?? '') }}">
</div>

<div class="col-md-4 mb-3">
    <label class="form-label">Volatility Bias</label>
    <input type="text" class="form-control" name="volatility_bias" value="{{ old('volatility_bias', $pattern->volatility_bias ?? '') }}">
</div>

<div class="col-md-4 mb-3">
    <label class="form-label">Behavioral Bias</label>
    <input type="text" class="form-control" name="behavioral_bias" value="{{ old('behavioral_bias', $pattern->behavioral_bias ?? '') }}">
</div>

{{-- Dynamic JSON Editor --}}
<div class="col-md-12 mb-3">
    <label class="form-label">Definition JSON</label>
    <div id="definition-json-container">
        @php
            $keys = old('definition_keys', []);
            $values = old('definition_values', []);
            if(empty($keys) && isset($pattern->definition_json) && is_array($pattern->definition_json)){
                $keys = array_keys($pattern->definition_json);
                $values = array_values($pattern->definition_json);
            }
        @endphp

        @foreach($keys as $i => $key)
        <div class="row mb-2 definition-row">
            <div class="col-md-5">
                <input type="text" name="definition_keys[]" class="form-control" placeholder="Key" value="{{ $key }}" required>
            </div>
            <div class="col-md-5">
                <input type="text" name="definition_values[]" class="form-control" placeholder="Value" value="{{ $values[$i] ?? '' }}" required>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger remove-row">Remove</button>
            </div>
        </div>
        @endforeach
    </div>
    <button type="button" id="add-definition-row" class="btn btn-secondary btn-sm mt-2">Add Row</button>
</div>

<div class="col-md-4 mb-3 form-check">
    <input type="checkbox" class="form-check-input" name="is_active" {{ old('is_active', $pattern->is_active ?? false) ? 'checked' : '' }}>
    <label class="form-check-label">Is Active</label>
</div>

<div class="col-md-4 mb-3">
    <label class="form-label">Priority</label>
    <input type="number" class="form-control" name="priority" value="{{ old('priority', $pattern->priority ?? 0) }}">
</div>

<div class="col-md-4 mb-3">
    <label class="form-label">Confidence Weight</label>
    <input type="number" step="0.01" class="form-control" name="confidence_weight" value="{{ old('confidence_weight', $pattern->confidence_weight ?? 0) }}">
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('definition-json-container');
    const addBtn = document.getElementById('add-definition-row');

    addBtn.addEventListener('click', function () {
        const row = document.createElement('div');
        row.classList.add('row', 'mb-2', 'definition-row');
        row.innerHTML = `
            <div class="col-md-5">
                <input type="text" name="definition_keys[]" class="form-control" placeholder="Key" required>
            </div>
            <div class="col-md-5">
                <input type="text" name="definition_values[]" class="form-control" placeholder="Value" required>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger remove-row">Remove</button>
            </div>
        `;
        container.appendChild(row);
        row.querySelector('.remove-row').addEventListener('click', function () {
            row.remove();
        });
    });

    container.querySelectorAll('.remove-row').forEach(btn => {
        btn.addEventListener('click', function () {
            btn.closest('.definition-row').remove();
        });
    });
});
</script>
