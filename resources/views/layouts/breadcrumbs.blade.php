{{--
    Breadcrumb trail.

    Usage:  @include('layouts.breadcrumbs', ['crumbs' => [
                ['label' => 'Kursy', 'url' => route('courses.index')],
                ['label' => $course->name],           // last item: no url
            ]])

    "Strona główna" is prepended automatically. The matching BreadcrumbList
    JSON-LD is emitted by the individual views via $jsonLd, because structured
    data belongs in <head> while this markup belongs in <body>.
--}}
@php
    $trail = array_merge(
        [['label' => 'Strona główna', 'url' => route('home')]],
        $crumbs ?? []
    );
    $lastIndex = count($trail) - 1;
@endphp

<nav class="lc-breadcrumb" aria-label="Ścieżka nawigacji">
    <ol>
        @foreach ($trail as $i => $crumb)
            <li>
                @if ($i === $lastIndex || empty($crumb['url']))
                    <span aria-current="page">{{ $crumb['label'] }}</span>
                @else
                    <a href="{{ $crumb['url'] }}">{{ $crumb['label'] }}</a>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
