<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Response;

/**
 * Serves the SEO discovery endpoints: an XML sitemap of the publicly indexable
 * pages, and a robots.txt whose Sitemap directive resolves to an absolute URL
 * for the current environment (a static file cannot do that).
 */
class SitemapController extends Controller
{
    /**
     * XML sitemap covering the public pages plus every course detail page.
     */
    public function index(): Response
    {
        $urls = [
            [
                'loc' => route('home'),
                'changefreq' => 'weekly',
                'priority' => '1.0',
                'lastmod' => null,
            ],
            [
                'loc' => route('courses.index'),
                'changefreq' => 'daily',
                'priority' => '0.9',
                'lastmod' => null,
            ],
            [
                'loc' => route('regulamin'),
                'changefreq' => 'yearly',
                'priority' => '0.3',
                'lastmod' => null,
            ],
        ];

        foreach (Course::all() as $course) {
            $urls[] = [
                'loc' => route('courses.show', ['id' => $course->id]),
                'changefreq' => 'weekly',
                'priority' => '0.8',
                'lastmod' => optional($course->updated_at)->toAtomString(),
            ];
        }

        $xml = view('sitemap', compact('urls'))->render();

        return response($xml, 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
    }

    /**
     * robots.txt with an absolute Sitemap URL.
     */
    public function robots(): Response
    {
        $lines = [
            'User-agent: *',
            'Allow: /',
            '',
            '# Private and transactional areas carry no search value.',
            'Disallow: /admin',
            'Disallow: /cart',
            'Disallow: /profile',
            'Disallow: /user/',
            'Disallow: /auth/',
            'Disallow: /register',
            '',
            'Sitemap: ' . route('sitemap'),
            '',
        ];

        return response(implode("\n", $lines), 200, ['Content-Type' => 'text/plain; charset=UTF-8']);
    }
}
