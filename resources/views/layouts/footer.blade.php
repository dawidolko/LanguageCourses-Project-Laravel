{{--
    Site footer (contentinfo landmark).

    $fixedBottom is still accepted for backwards compatibility with the existing
    includes, but the layout no longer needs position:fixed: the body is a flex
    column and the footer is pushed down by the main region, which keeps it at
    the bottom on short pages without overlapping content on long ones.
--}}
<footer class="lc-footer" role="contentinfo">
    <div class="lc-shell">
        <div class="lc-footer-grid">
            <div>
                <h2>languageCourses</h2>
                <p>Szkoła językowa online. Uczymy w małych grupach, z lektorami, którzy prowadzą zajęcia na co dzień.</p>
            </div>

            <div>
                <h2>Serwis</h2>
                <ul>
                    <li><a href="{{ route('home') }}">Strona główna</a></li>
                    <li><a href="{{ route('courses.index') }}">Wszystkie kursy</a></li>
                    <li><a href="{{ route('regulamin') }}">Regulamin</a></li>
                </ul>
            </div>

            <div>
                <h2>Kontakt</h2>
                <ul>
                    <li>
                        <a href="mailto:languageCourses@contact.com">
                            <i class="bi bi-envelope-fill" aria-hidden="true"></i>
                            languageCourses@contact.com
                        </a>
                    </li>
                </ul>

                <h2 class="mt-4">Social media</h2>
                {{-- Icon-only links: the icon is decorative, the accessible name
                     comes from the visually hidden text. --}}
                <div class="lc-social">
                    <a href="https://facebook.com" target="_blank" rel="noopener noreferrer">
                        <i class="bi bi-facebook" aria-hidden="true"></i>
                        <span class="lc-visually-hidden">Facebook (otwiera się w nowej karcie)</span>
                    </a>
                    <a href="https://twitter.com" target="_blank" rel="noopener noreferrer">
                        <i class="bi bi-twitter" aria-hidden="true"></i>
                        <span class="lc-visually-hidden">Twitter (otwiera się w nowej karcie)</span>
                    </a>
                    <a href="https://instagram.com" target="_blank" rel="noopener noreferrer">
                        <i class="bi bi-instagram" aria-hidden="true"></i>
                        <span class="lc-visually-hidden">Instagram (otwiera się w nowej karcie)</span>
                    </a>
                    <a href="https://linkedin.com" target="_blank" rel="noopener noreferrer">
                        <i class="bi bi-linkedin" aria-hidden="true"></i>
                        <span class="lc-visually-hidden">LinkedIn (otwiera się w nowej karcie)</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="lc-footer-bottom">
            <p>&copy; {{ date('Y') }} languageCourses. Wszelkie prawa zastrzeżone.</p>
            <p><a href="{{ route('regulamin') }}">Regulamin serwisu</a></p>
        </div>
    </div>
</footer>

<script>
    // Show any server-rendered toasts once Bootstrap's bundle has parsed.
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof bootstrap === 'undefined') {
            return;
        }
        document.querySelectorAll('.toast').forEach(function (toastEl) {
            new bootstrap.Toast(toastEl).show();
        });
    });
</script>
