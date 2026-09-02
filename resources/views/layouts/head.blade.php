{{--
    Shared document head.

    Every view includes this with a $pageTitle, which stays the canonical way to
    set the title. On top of that each view may now define optional variables to
    control its own SEO metadata without touching a controller:

      $pageTitle        - required, the <title>
      $metaDescription  - unique description for this page
      $metaImage        - absolute or relative URL of the social sharing image
      $canonical        - override the canonical URL (defaults to current URL)
      $robots           - e.g. 'noindex, nofollow' for private pages
      $jsonLd           - an array (or array of arrays) rendered as JSON-LD
--}}
@php
    $siteName = 'languageCourses';
    $metaTitle = $pageTitle ?? $siteName;
    $metaDescription = $metaDescription
        ?? 'languageCourses - szkoła językowa online. Kursy angielskiego, niemieckiego i innych języków prowadzone przez doświadczonych lektorów. Zapisz się online.';
    $metaImageUrl = isset($metaImage) ? url($metaImage) : asset('storage/img/logo.png');
    $canonicalUrl = $canonical ?? url()->current();
    $metaRobots = $robots ?? 'index, follow';
@endphp
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Primary SEO --}}
    <title>{{ $metaTitle }}</title>
    <meta name="description" content="{{ $metaDescription }}">
    <meta name="robots" content="{{ $metaRobots }}">
    <link rel="canonical" href="{{ $canonicalUrl }}">
    <meta name="theme-color" content="#12202E">

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ $siteName }}">
    <meta property="og:locale" content="pl_PL">
    <meta property="og:title" content="{{ $metaTitle }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:url" content="{{ $canonicalUrl }}">
    <meta property="og:image" content="{{ $metaImageUrl }}">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $metaTitle }}">
    <meta name="twitter:description" content="{{ $metaDescription }}">
    <meta name="twitter:image" content="{{ $metaImageUrl }}">

    <link rel="icon" href="{{ asset('storage/img/logo.png') }}">

    {{-- Fonts: preconnect first so the stylesheet request starts sooner. --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/coursesStyle.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <script defer src="{{ asset('js/bootstrap.bundle.js') }}"></script>

    {{-- Structured data. Views pass a single schema array or a list of them.

         JSON_HEX_TAG is essential here: the payload is printed unescaped, and
         admin-editable content (course names, descriptions) flows into it, so
         a literal "</script>" in the data must not be able to close the tag. --}}
    @isset($jsonLd)
        @foreach ((array_is_list($jsonLd) ? $jsonLd : [$jsonLd]) as $schema)
            <script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) !!}</script>
        @endforeach
    @endisset
</head>
