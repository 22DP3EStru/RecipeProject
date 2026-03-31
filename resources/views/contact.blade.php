@extends('layouts.app')

@section('title', 'Kontakti - Vecmāmiņas Receptes')
@section('meta_description', 'Vecmāmiņas Receptes — sazinies ar mums, ja ir jautājumi, ieteikumi vai nepieciešama palīdzība.')

@section('hero_title', 'Kontakti')
@section('hero_text', 'Vecmāmiņas Receptes — sazinies ar mums, ja ir jautājumi, ieteikumi vai nepieciešama palīdzība.')

@section('content')
<style>
    .contact-page {
        color: var(--text);
    }

    .hero {
        padding: 18px 20px 32px;
        text-align: center;
    }

    .hero-title {
        font-family: Georgia, "Times New Roman", serif;
        font-size: 4rem;
        line-height: 1.08;
        color: var(--accent);
        font-weight: 400;
        margin-bottom: 12px;
    }

    .hero-text {
        color: var(--muted);
        font-size: 16px;
        line-height: 1.7;
        max-width: 820px;
        margin: 0 auto;
        overflow-wrap: anywhere;
        word-break: break-word;
    }

    .section-block + .section-block {
        margin-top: 28px;
    }

    .intro-box,
    .contact-card,
    .tip-box {
        background: var(--surface);
        border: 1px solid var(--line);
        padding: 28px;
        min-width: 0;
        overflow: hidden;
    }

    .intro-box {
        text-align: center;
    }

    .intro-icon {
        font-size: 3.5rem;
        margin-bottom: 16px;
    }

    .intro-box h2,
    .section-title,
    .contact-card h3,
    .tip-box h3 {
        font-family: Georgia, "Times New Roman", serif;
        color: var(--accent);
        font-weight: 500;
    }

    .intro-box h2 {
        font-size: 2.3rem;
        margin-bottom: 12px;
    }

    .intro-box p,
    .muted {
        color: var(--muted);
        line-height: 1.8;
        overflow-wrap: anywhere;
        word-break: break-word;
    }

    .section-title {
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 1.9rem;
        overflow-wrap: break-word;
        word-break: break-word;
    }

    .section-subtext {
        color: var(--muted);
        line-height: 1.7;
        margin-bottom: 22px;
        overflow-wrap: anywhere;
        word-break: break-word;
    }

    .contact-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
    }

    .contact-card {
        background: var(--surface-soft);
        transition: 0.2s ease;
    }

    .contact-card:hover {
        background: #fffaf5;
    }

    .contact-icon {
        font-size: 2.5rem;
        margin-bottom: 14px;
    }

    .contact-card h3 {
        font-size: 1.6rem;
        margin-bottom: 12px;
        overflow-wrap: break-word;
        word-break: break-word;
    }

    .contact-card p,
    .contact-card div,
    .contact-card span,
    .contact-card strong,
    .tip-box p {
        overflow-wrap: anywhere;
        word-break: break-word;
    }

    .contact-card strong {
        color: var(--text);
    }

    .contact-line {
        margin-bottom: 8px;
    }

    .contact-line:last-child {
        margin-bottom: 0;
    }

    .contact-value {
        display: inline;
        font-weight: 700;
        color: var(--text);
        overflow-wrap: anywhere;
        word-break: break-word;
    }

    .tip-box {
        background: var(--surface-soft);
    }

    @media (max-width: 900px) {
        .hero-title {
            font-size: 2.8rem;
        }
    }

    @media (max-width: 640px) {
        .hero {
            padding: 10px 8px 24px;
        }

        .hero-title {
            font-size: 2.3rem;
        }

        .intro-box,
        .contact-card,
        .tip-box {
            padding: 20px;
        }

        .contact-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="contact-page">

    <div class="section-block intro-box">
        <div class="intro-icon">📞</div>
        <h2>Kā ar mums sazināties</h2>
        <p>
            Ja pamanīji kļūdu, vēlies ieteikt uzlabojumu vai ir jautājums par “Vecmāmiņas Receptes”, izmanto kādu no zemāk redzamajiem kontaktiem.
        </p>
    </div>

    <div class="section-block">
        <h3 class="section-title">📋 Kontaktinformācija</h3>
        <p class="section-subtext">
            Izvēlies atbilstošāko saziņas veidu atkarībā no jautājuma vai situācijas.
        </p>

        <div class="contact-grid">
            <div class="contact-card">
                <div class="contact-icon">👤</div>
                <h3>Galvenais kontakts</h3>
                <div class="muted">
                    <div class="contact-line">E-pasts: <span class="contact-value">info@vecmaminasreceptes.lv</span></div>
                    <div class="contact-line">Tālrunis: <span class="contact-value">+371 20000000</span></div>
                    <div class="contact-line">Darba laiks: <span class="contact-value">P–Pk 09:00–18:00</span></div>
                </div>
            </div>

            <div class="contact-card">
                <div class="contact-icon">🛠️</div>
                <h3>Tehniskais atbalsts</h3>
                <div class="muted">
                    <div class="contact-line">E-pasts: <span class="contact-value">support@vecmaminasreceptes.lv</span></div>
                    <div class="contact-line">Atbildes laiks: <span class="contact-value">24–48h</span></div>
                    <div class="contact-line">Iekļauj: <span class="contact-value">lietotājvārdu + īsu problēmas aprakstu</span></div>
                </div>
            </div>

            <div class="contact-card">
                <div class="contact-icon">💬</div>
                <h3>Ieteikumi / sadarbība</h3>
                <div class="muted">
                    <div class="contact-line">E-pasts: <span class="contact-value">sadarbiba@vecmaminasreceptes.lv</span></div>
                    <div class="contact-line">Raksti, ja ir idejas jaunām funkcijām vai saturam.</div>
                </div>
            </div>
        </div>
    </div>

    <div class="section-block tip-box">
        <h3>📌 Ātrais jautājums</h3>
        <p class="muted" style="margin-top: 10px;">
            Ja jautājums ir par konkrētu recepti, pievieno receptes nosaukumu un, ja iespējams, arī saiti uz to. Tas palīdzēs ātrāk saprast situāciju un sniegt precīzāku atbildi.
        </p>
    </div>

</div>
@endsection