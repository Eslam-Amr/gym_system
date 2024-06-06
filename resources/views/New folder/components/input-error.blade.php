{{-- @props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-sm text-red-600 space-y-1']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif --}}
{{-- @props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-sm text-red-600 space-y-1', 'id' => 'error-messages']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>

    <script>
        // JavaScript to hide the error messages after 30 seconds
        setTimeout(function() {
            var errorMessages = document.getElementById('error-messages');
            if (errorMessages) {
                errorMessages.style.display = 'none';
            }
        }, 150); // 30 seconds
    </script>
@endif --}}

{{-- @props(['messages'])

@if ($messages)
    @foreach ($messages as $index => $messageGroup)
        <ul {{ $attributes->merge(['class' => 'text-sm text-red-600 space-y-1', 'id' => 'error-messages-' . $index]) }}>
            @foreach ((array) $messageGroup as $message)
                <li>{{ $message }}</li>
        <script>
            // JavaScript to hide the error messages after 30 seconds
            setTimeout(function() {
                var errorMessages = document.getElementById("error-messages-{{ $index }}");
                if (errorMessages) {
                    errorMessages.style.display = 'none';
                }
            }, 150); // 30 seconds
        </script>
            @endforeach
        </ul>

    @endforeach
@endif --}}
{{-- @props(['messages'])

@if ($messages)
    @foreach ($messages as $groupIndex => $messageGroup)
        <ul {{ $attributes->merge(['class' => 'text-sm text-red-600 space-y-1 error-messages', 'id' => 'error-messages-' . $groupIndex]) }}>
            @foreach ((array) $messageGroup as $index => $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>

        <script>
            // JavaScript to hide the error messages after 30 seconds
            setTimeout(function() {
                var errorMessages = document.getElementByClass('error-messages');
                if (errorMessages) {
                    errorMessages.style.display = 'none';
                }
            }, 150); // 30 seconds
        </script>
    @endforeach
@endif --}}
{{-- @props(['messages'])

@if ($messages)
    @foreach ($messages as $groupIndex => $messageGroup)
        <ul {{ $attributes->merge(['class' => 'text-sm text-red-600 space-y-1 error-messages']) }}>
            @foreach ((array) $messageGroup as $index => $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>

        <script>
            // JavaScript to hide the error messages after 30 seconds
            setTimeout(function() {
                var errorMessages = document.querySelector('.error-messages');
                if (errorMessages) {
                    errorMessages.style.display = 'none';
                }
            }, 150); // 30 seconds
        </script>
    @endforeach
@endif --}}

@props(['messages'])

@if ($messages)
    @foreach ($messages as $groupIndex => $messageGroup)
        <ul style="text-decoration: none !important; " {{ $attributes->merge(['class' => 'text-sm text-red-600 space-y-1 text-danger error-messages']) }}>
            @foreach ((array) $messageGroup as $index => $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    @endforeach

    <script>
        // JavaScript to hide all error message groups after 30 seconds
        setTimeout(function() {
            var errorMessages = document.querySelectorAll('.error-messages');
            if (errorMessages) {
                errorMessages.forEach(function(message) {
                    message.style.display = 'none';
                });
            }
        },5000); // 30 seconds
    </script>
@endif
