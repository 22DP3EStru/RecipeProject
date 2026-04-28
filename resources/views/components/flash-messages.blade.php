@if (session('success') || session('error') || session('warning') || session('info'))
    <div class="flash-messages">
        @if (session('success'))
            <div class="flash-message success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="flash-message error">
                {{ session('error') }}
            </div>
        @endif

        @if (session('warning'))
            <div class="flash-message warning">
                {{ session('warning') }}
            </div>
        @endif

        @if (session('info'))
            <div class="flash-message info">
                {{ session('info') }}
            </div>
        @endif
    </div>
@endif