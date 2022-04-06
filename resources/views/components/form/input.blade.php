<div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label>
    <input type="{{ $type ?? 'text' }}" class="form-control @error($name) is-invalid @enderror"
        wire:model.defer="state.{{ $name }}" id="{{ $name }}" placeholder="{{ $placeholder }}">
    {{-- @if ($showError ?? true != false) --}}
    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
    {{-- @endif --}}
</div>
