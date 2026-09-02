<!doctype html>
{{-- Declaring the document language is required for screen readers to pick the
     correct pronunciation rules (WCAG 3.1.1). The app locale drives it, with a
     Polish fallback because the interface copy is Polish. --}}
<html lang="{{ str_replace('_', '-', app()->getLocale() === 'en' ? 'pl' : app()->getLocale()) }}">
