{{--
    Flash messages (success / error / status).

    Wrapped in a polite live region so the message is announced without
    stealing focus, and each carries a text label rather than relying on the
    colour of the alert alone (WCAG 1.4.1).
--}}
<div aria-live="polite" aria-atomic="true">
    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            <span class="lc-alert-title">
                <i class="bi bi-exclamation-octagon-fill" aria-hidden="true"></i>
                Błąd
            </span>
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            <span class="lc-alert-title">
                <i class="bi bi-check-circle-fill" aria-hidden="true"></i>
                Sukces
            </span>
            {{ session('success') }}
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-info" role="alert">
            <span class="lc-alert-title">
                <i class="bi bi-info-circle-fill" aria-hidden="true"></i>
                Informacja
            </span>
            {{ session('status') }}
        </div>
    @endif
</div>
