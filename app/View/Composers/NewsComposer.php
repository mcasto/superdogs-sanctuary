<?php

namespace App\View\Composers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class NewsComposer
{
    public function compose(View $view): void
    {
        $newsItems = $this->getNewsItems();
        $view->with('newsItems', $newsItems);
    }

    protected function getNewsItems(): Collection
    {
        $newsPath = resource_path('views/news');

        if (!File::isDirectory($newsPath)) {
            return collect();
        }

        return collect(File::files($newsPath))
            ->filter(fn($file) => $file->getExtension() === 'php')
            ->map(function ($file) {
                $content = File::get($file->getPathname());
                $metadata = $this->parseMetadata($content);
                $filename = $file->getFilenameWithoutExtension();

                // Remove .blade from filename
                $slug = str_replace('.blade', '', $filename);

                return [
                    'title' => $metadata['title'] ?? $this->generateTitle($slug),
                    'date' => $metadata['date'] ?? $this->extractDateFromFilename($slug),
                    'slug' => $slug,
                    'view' => 'news.' . str_replace('.blade', '', $filename),
                ];
            })
            ->sortByDesc('date')
            ->values();
    }

    protected function parseMetadata(string $content): array
    {
        // Match: {{-- title: Title Here | date: 2026-01-30 --}}
        if (preg_match('/\{\{--\s*title:\s*(.+?)\s*\|\s*date:\s*(\d{4}-\d{2}-\d{2})\s*--\}\}/', $content, $matches)) {
            return [
                'title' => trim($matches[1]),
                'date' => $matches[2],
            ];
        }

        return [];
    }

    protected function extractDateFromFilename(string $slug): ?string
    {
        if (preg_match('/^(\d{4}-\d{2}-\d{2})/', $slug, $matches)) {
            return $matches[1];
        }

        return null;
    }

    protected function generateTitle(string $slug): string
    {
        // Remove date prefix and convert to title case
        $title = preg_replace('/^\d{4}-\d{2}-\d{2}-/', '', $slug);

        return ucwords(str_replace('-', ' ', $title));
    }
}
