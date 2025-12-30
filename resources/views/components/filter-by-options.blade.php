<div class="position-relative">
    <select name="{{ $term }}" id="{{ $term }}" class="border-0 form-control form-select"
        onchange="window.location.href= '?{{ $term }}=' + this.value;"
        style="max-width: 250px; appearance: none; padding-right: 2.5rem;">
        <option value="">{{ $defaultValue }}</option>
        @foreach ($options as $option)
            <option value="{{ $option->id }}" {{ request()->query($term) == $option->id ? 'selected' : '' }}>
                {{ $option->$field }}
            </option>
        @endforeach
    </select>
    <i class="bi bi-chevron-down position-absolute end-0 top-50 translate-middle-y me-3 text-muted"></i>
</div>
