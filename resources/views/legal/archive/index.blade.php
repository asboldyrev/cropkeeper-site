@extends('layouts.site')

@section('title', 'Архив редакций — ' . $legalDocument['title'] . ' — Cropkeeper')
@section('description', 'Архив предыдущих редакций документа «' . $legalDocument['title'] . '» Cropkeeper.')

@section('content')
<section class="legal-hero">
    <div class="shell legal-hero__inner">
        <p class="eyebrow"><span></span> Архив документов</p>
        <h1>{{ $legalDocument['title'] }}</h1>
        <p>Предыдущие опубликованные редакции документа.</p>
        @if ($legalDocument['canonical_route'])
            <a class="button button--outline" href="{{ route($legalDocument['canonical_route']) }}">Открыть действующую редакцию</a>
        @endif
    </div>
</section>

<section class="legal-section">
    <div class="shell">
        <article class="legal-document legal-document--archive-index">
            @if (count($archive))
                <div class="legal-archive-list">
                    @foreach ($archive as $revision)
                        <a class="legal-archive-item" href="{{ route('legal.archive.revision', ['document' => $documentCode, 'revision' => $revision['revision']]) }}">
                            <span>
                                <strong>{{ $revision['label'] }}</strong>
                                <small>Архивная редакция · больше не действует</small>
                            </span>
                            <i data-lucide="arrow-up-right" aria-hidden="true"></i>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="legal-notice">
                    <i data-lucide="info" aria-hidden="true"></i>
                    <p>Предыдущих опубликованных редакций пока нет.</p>
                </div>
            @endif
        </article>
    </div>
</section>
@endsection
