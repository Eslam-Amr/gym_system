@props(['value'])

<label style="color: red" class="text-danger">
    {{ $value ?? $slot }}
</label>
