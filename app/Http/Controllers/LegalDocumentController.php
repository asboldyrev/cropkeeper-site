<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class LegalDocumentController extends Controller
{
    public function agreement(): View
    {
        return $this->current('agreement');
    }

    public function offer(): View
    {
        return $this->current('offer');
    }

    public function personalData(): View
    {
        return $this->current('personal-data');
    }

    public function cookies(): View
    {
        return $this->current('cookies');
    }

    public function legacyPrivacy(): RedirectResponse
    {
        return redirect()->route('personal-data', status: 301);
    }

    public function archiveIndex(string $document): View
    {
        $definition = $this->document($document);

        return view('legal.archive.index', [
            'documentCode' => $document,
            'legalDocument' => $definition,
            'archive' => $definition['archive'] ?? [],
            'seoRobots' => 'noindex, follow',
        ]);
    }

    public function archiveRevision(string $document, string $revision): View
    {
        $definition = $this->document($document);
        $revisionDefinition = collect($definition['archive'] ?? [])
            ->firstWhere('revision', $revision);

        abort_unless($revisionDefinition, 404);

        return view($revisionDefinition['view'], [
            'documentCode' => $document,
            'legalDocument' => $definition,
            'legalRevision' => $revisionDefinition,
            'isArchivedRevision' => true,
            'seoRobots' => 'noindex, follow',
        ]);
    }

    private function current(string $document): View
    {
        $definition = $this->document($document);
        $current = $definition['current'] ?? null;

        abort_unless($current, 404);

        return view($current['view'], [
            'documentCode' => $document,
            'legalDocument' => $definition,
            'legalRevision' => $current,
            'isArchivedRevision' => false,
        ]);
    }

    private function document(string $document): array
    {
        $definition = config("legal.documents.{$document}");

        abort_unless(is_array($definition), 404);

        return $definition;
    }
}
