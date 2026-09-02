{{--
    Transient success toast. The live region wrapper is always present in the
    DOM (not only when a message exists) so assistive tech has it registered
    before the content arrives.
--}}
<div class="lc-toast-region" aria-live="polite" aria-atomic="true">
    @if (Session::has('successToast'))
        <div id="themeToast" class="toast" role="status">
            <div class="d-flex">
                <div class="toast-body">{{ Session::get('successToast') }}</div>
                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Zamknij powiadomienie"></button>
            </div>
        </div>
    @endif
</div>
