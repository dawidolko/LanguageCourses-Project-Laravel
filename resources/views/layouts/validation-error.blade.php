{{--
    Validation summary.

    Rendered in an aria-live region so screen reader users are told about the
    errors after a failed submit, and each item links to the field it refers to
    where a matching input exists.
--}}
<div aria-live="assertive" aria-atomic="true">
    @if ($errors->any())
        <div class="alert alert-danger" role="alert" tabindex="-1" id="lc-validation-summary">
            <p class="lc-alert-title">
                <i class="bi bi-exclamation-triangle-fill" aria-hidden="true"></i>
                {{ $errors->count() === 1 ? 'Popraw 1 błąd w formularzu.' : 'Popraw błędy w formularzu (' . $errors->count() . ').' }}
            </p>
            <ul>
                @foreach ($errors->keys() as $field)
                    @foreach ($errors->get($field) as $message)
                        <li><a href="#{{ $field }}">{{ $message }}</a></li>
                    @endforeach
                @endforeach
            </ul>
        </div>
    @endif
</div>
