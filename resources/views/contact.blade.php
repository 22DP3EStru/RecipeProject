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

    .contact-stack {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .contact-section-card {
        background: rgba(255, 253, 249, 0.96);
        border: 1px solid rgba(122, 90, 67, 0.14);
        border-radius: 24px;
        padding: 28px;
        box-shadow: 0 14px 34px rgba(79, 59, 42, 0.06);
        min-width: 0;
        overflow: hidden;
    }

    .contact-hero-card {
        background: linear-gradient(180deg, #fffdf9 0%, #fbf5ee 100%);
        overflow: hidden;
    }

    .contact-hero-inner {
        display: grid;
        grid-template-columns: auto 1fr;
        gap: 24px;
        align-items: center;
    }

    .contact-hero-icon-wrap {
        width: 108px;
        height: 108px;
        border-radius: 50%;
        background: linear-gradient(135deg, #efe3d5 0%, #e7d5c3 100%);
        border: 4px solid #f0e5d8;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.8rem;
        box-shadow: 0 10px 24px rgba(122, 90, 67, 0.12);
        flex-shrink: 0;
    }

    .contact-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 7px 12px;
        border-radius: 999px;
        border: 1px solid rgba(122, 90, 67, 0.12);
        background: #f5ece2;
        color: var(--accent);
        font-size: 12px;
        font-weight: 800;
        letter-spacing: 0.02em;
        text-transform: uppercase;
        margin-bottom: 14px;
    }

    .contact-main-title {
        font-family: Georgia, "Times New Roman", serif;
        font-size: 2.55rem;
        font-weight: 500;
        color: var(--accent);
        margin: 0 0 10px;
        line-height: 1.08;
        overflow-wrap: break-word;
        word-break: break-word;
    }

    .contact-main-text {
        color: var(--muted);
        line-height: 1.85;
        font-size: 14px;
        max-width: 820px;
        overflow-wrap: anywhere;
        word-break: break-word;
    }

    .section-head {
        margin-bottom: 24px;
        padding-bottom: 14px;
        border-bottom: 1px solid rgba(221, 207, 192, 0.9);
    }

    .section-kicker {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 10px;
        padding: 7px 12px;
        border-radius: 999px;
        background: #f5ece2;
        border: 1px solid rgba(122, 90, 67, 0.12);
        color: var(--accent);
        font-size: 12px;
        font-weight: 800;
        letter-spacing: 0.02em;
        text-transform: uppercase;
    }

    .section-title {
        color: var(--accent);
        margin-bottom: 8px;
        font-family: Georgia, "Times New Roman", serif;
        font-size: 2rem;
        font-weight: 500;
        line-height: 1.1;
        overflow-wrap: break-word;
        word-break: break-word;
    }

    .section-subtext {
        color: var(--muted);
        line-height: 1.75;
        font-size: 14px;
        max-width: 760px;
        overflow-wrap: anywhere;
        word-break: break-word;
    }

    .contact-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 20px;
    }

    .contact-card {
        background: linear-gradient(180deg, #fcf8f3 0%, #f6ede3 100%);
        border: 1px solid rgba(122, 90, 67, 0.12);
        border-radius: 22px;
        padding: 24px;
        transition: 0.2s ease;
        box-shadow: 0 10px 22px rgba(79, 59, 42, 0.04);
        min-width: 0;
        overflow: hidden;
    }

    .contact-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 16px 30px rgba(79, 59, 42, 0.08);
    }

    .contact-icon {
        font-size: 2.5rem;
        margin-bottom: 14px;
    }

    .contact-card h3 {
        font-family: Georgia, "Times New Roman", serif;
        color: var(--accent);
        font-size: 1.65rem;
        margin-bottom: 12px;
        font-weight: 500;
        line-height: 1.15;
        overflow-wrap: break-word;
        word-break: break-word;
    }

    .muted {
        color: var(--muted);
        line-height: 1.8;
        overflow-wrap: anywhere;
        word-break: break-word;
    }

    .contact-line {
        margin-bottom: 10px;
    }

    .contact-line:last-child {
        margin-bottom: 0;
    }

    .contact-label {
        font-weight: 700;
        color: var(--accent);
    }

    .contact-value {
        display: inline;
        font-weight: 700;
        color: var(--text);
        overflow-wrap: anywhere;
        word-break: break-word;
    }

    .tip-box {
        background: linear-gradient(180deg, #faf4ed 0%, #f4eadf 100%);
    }

    .tip-box h3 {
        font-family: Georgia, "Times New Roman", serif;
        color: var(--accent);
        font-size: 2rem;
        font-weight: 500;
        margin-bottom: 10px;
        line-height: 1.1;
    }

    .tip-box p {
        color: var(--muted);
        line-height: 1.8;
        overflow-wrap: anywhere;
        word-break: break-word;
    }

    .quick-help-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 18px;
        margin-top: 22px;
    }

    .quick-help-card {
        background: #fffdf9;
        border: 1px solid rgba(122, 90, 67, 0.12);
        border-radius: 18px;
        padding: 20px;
        box-shadow: 0 8px 18px rgba(79, 59, 42, 0.04);
    }

    .quick-help-card h4 {
        color: var(--accent);
        margin-bottom: 8px;
        font-size: 15px;
        font-weight: 800;
    }

    .quick-help-card p {
        color: var(--muted);
        font-size: 13px;
        line-height: 1.7;
    }

</style>

<div class="contact-page">
    <div class="contact-stack">

        <div class="contact-section-card contact-hero-card">
            <div class="contact-hero-inner">
                <div class="contact-hero-icon-wrap">📞</div>

                <div>
                    <div class="contact-badge">Saziņa un atbalsts</div>
                    <h2 class="contact-main-title">Kā ar mums sazināties</h2>
                    <p class="contact-main-text">
                        Ja pamanīji kļūdu, vēlies ieteikt uzlabojumu vai ir jautājums par “Vecmāmiņas Receptes”,
                        izmanto kādu no zemāk redzamajiem kontaktiem.
                    </p>
                </div>
            </div>
        </div>

        <div class="contact-section-card">
            <div class="section-head">
                <div class="section-kicker">Kontaktinformācija</div>
                <h3 class="section-title">Izvēlies atbilstošāko saziņas veidu</h3>
                <p class="section-subtext">
                    Atkarībā no situācijas vari sazināties ar galveno kontaktu, tehnisko atbalstu vai rakstīt par sadarbību un idejām.
                </p>
            </div>

            <div class="contact-grid">
                <div class="contact-card">
                    <div class="contact-icon">👤</div>
                    <h3>Galvenais kontakts</h3>
                    <div class="muted">
                        <div class="contact-line">
                            <span class="contact-label">E-pasts:</span>
                            <span class="contact-value"> info@vecmaminasreceptes.site</span>
                        </div>
                        <div class="contact-line">
                            <span class="contact-label">Tālrunis:</span>
                            <span class="contact-value"> +371 27825277</span>
                        </div>
                        <div class="contact-line">
                            <span class="contact-label">Darba laiks:</span>
                            <span class="contact-value"> P–Pk 09:00–18:00</span>
                        </div>
                    </div>
                </div>

                <div class="contact-card">
                    <div class="contact-icon">🛠️</div>
                    <h3>Tehniskais atbalsts</h3>
                    <div class="muted">
                        <div class="contact-line">
                            <span class="contact-label">E-pasts:</span>
                            <span class="contact-value"> support@vecmaminasreceptes.site</span>
                        </div>
                        <div class="contact-line">
                            <span class="contact-label">Atbildes laiks:</span>
                            <span class="contact-value"> 24–48h</span>
                        </div>
                        <div class="contact-line">
                            <span class="contact-label">Iekļauj:</span>
                            <span class="contact-value"> lietotājvārdu + īsu problēmas aprakstu</span>
                        </div>
                    </div>
                </div>

                <div class="contact-card">
                    <div class="contact-icon">💬</div>
                    <h3>Ieteikumi / sadarbība</h3>
                    <div class="muted">
                        <div class="contact-line">
                            <span class="contact-label">E-pasts:</span>
                            <span class="contact-value"> sadarbiba@vecmaminasreceptes.site</span>
                        </div>
                        <div class="contact-line">
                            Raksti, ja ir idejas jaunām funkcijām, saturam vai sadarbības iespējām.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="contact-section-card tip-box">
            <h3>Ātrāks ceļš uz atbildi</h3>
            <p>
                Ja jautājums ir par konkrētu recepti, pievieno receptes nosaukumu un, ja iespējams, arī saiti uz to.
                Tas palīdzēs ātrāk saprast situāciju un sniegt precīzāku atbildi.
            </p>

            <div class="quick-help-grid">
                <div class="quick-help-card">
                    <h4>Par receptes kļūdu</h4>
                    <p>Norādi receptes nosaukumu, ko tieši pamanīji un, ja iespējams, pievieno saiti.</p>
                </div>

                <div class="quick-help-card">
                    <h4>Par konta problēmu</h4>
                    <p>Iekļauj savu lietotājvārdu un īsu aprakstu, lai varam ātrāk pārbaudīt situāciju.</p>
                </div>

                <div class="quick-help-card">
                    <h4>Par ideju vai uzlabojumu</h4>
                    <p>Apraksti savu ieteikumu pēc iespējas konkrētāk, lai vieglāk saprastu ieguvumu lietotājiem.</p>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection