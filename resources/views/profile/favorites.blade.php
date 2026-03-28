<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mani favorīti - Vecmāmiņas Receptes</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f6f1eb;
            color: #5f4633;
            min-height: 100vh;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 40px 20px 60px;
        }

        .page-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .page-header h1 {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 3.2rem;
            font-weight: 400;
            color: #7a5a43;
            margin-bottom: 12px;
        }

        .page-header p {
            font-size: 1.1rem;
            color: #8a6a54;
        }

        .nav-bar {
            background: #fff;
            border: 1px solid #d9c9ba;
            padding: 16px 18px;
            margin-bottom: 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .brand {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 1.3rem;
            color: #7a5a43;
            white-space: nowrap;
        }

        .nav-links {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            align-items: center;
        }

        .nav-links a {
            text-decoration: none;
            color: #2f2f2f;
            padding: 9px 14px;
            font-size: 15px;
            font-weight: 600;
            border: 1px solid transparent;
            transition: 0.2s ease;
        }

        .nav-links a:hover {
            border-color: #d9c9ba;
            background: #f8f4ef;
        }

        .nav-links a.active {
            background: #7a5a43;
            color: white;
            border-color: #7a5a43;
        }

        .content-box {
            background: #fff;
            border: 1px solid #d9c9ba;
            padding: 28px;
        }

        .section-title {
            text-align: center;
            font-family: Georgia, "Times New Roman", serif;
            font-size: 2rem;
            font-weight: 400;
            color: #7a5a43;
            margin-bottom: 24px;
        }

        .stats-box {
            background: #f2e8dc;
            border: 1px solid #dcc9b6;
            padding: 18px;
            margin-bottom: 24px;
            text-align: center;
        }

        .stats-box strong {
            display: block;
            font-size: 2rem;
            color: #7a5a43;
            margin-bottom: 6px;
            font-family: Georgia, "Times New Roman", serif;
            font-weight: 400;
        }

        .stats-box span {
            color: #7d6755;
            font-size: 15px;
        }

        .recipes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 20px;
        }

        .recipe-card {
            background: #fcfaf7;
            border: 1px solid #d9c9ba;
            padding: 22px;
        }

        .recipe-card h3 {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 1.7rem;
            font-weight: 400;
            color: #7a5a43;
            margin-bottom: 12px;
            line-height: 1.3;
        }

        .recipe-meta {
            font-size: 14px;
            color: #8a7767;
            margin-bottom: 14px;
            line-height: 1.7;
        }

        .recipe-description {
            font-size: 15px;
            color: #5d5249;
            line-height: 1.7;
            margin-bottom: 20px;
            min-height: 72px;
        }

        .card-actions {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-block;
            padding: 10px 16px;
            text-decoration: none;
            border: 1px solid #cdb9a8;
            background: #f8f4ef;
            color: #5f4633;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s ease;
            font-size: 14px;
        }

        .btn:hover {
            background: #efe6dc;
        }

        .btn-primary {
            background: #7a5a43;
            border-color: #7a5a43;
            color: white;
        }

        .btn-primary:hover {
            background: #684a36;
        }

        .btn-danger {
            background: #f4d9d9;
            border-color: #d9b3b3;
            color: #8b4d4d;
        }

        .btn-danger:hover {
            background: #ebcaca;
        }

        .empty-box {
            text-align: center;
            padding: 50px 20px;
            background: #fcfaf7;
            border: 1px solid #d9c9ba;
        }

        .empty-box h2 {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 2rem;
            font-weight: 400;
            color: #7a5a43;
            margin-bottom: 12px;
        }

        .empty-box p {
            color: #7d6755;
            margin-bottom: 22px;
            line-height: 1.7;
        }

        .pagination-wrapper {
            margin-top: 28px;
            padding-top: 20px;
            border-top: 1px solid #e3d6ca;
        }

        @media (max-width: 768px) {
            .page-header h1 {
                font-size: 2.4rem;
            }

            .nav-bar {
                flex-direction: column;
                align-items: stretch;
            }

            .brand {
                text-align: center;
            }

            .nav-links {
                justify-content: center;
            }

            .card-actions {
                flex-direction: column;
            }

            .card-actions .btn,
            .card-actions form,
            .card-actions button {
                width: 100%;
            }

            .content-box {
                padding: 18px;
            }
        }
    </style>
</head>
<body>

<div class="container">

    <div class="page-header">
        <h1>Mani favorīti</h1>
        <p>Šeit vari pārvaldīt savas iecienītākās receptes.</p>
    </div>

    <nav class="nav-bar">
        <div class="brand">Vecmāmiņas Receptes</div>

        <div class="nav-links">
            <a href="/dashboard">Vadības panelis</a>
            <a href="/recipes">Receptes</a>
            <a href="/categories">Kategorijas</a>
            <a href="/profile/recipes">Manas receptes</a>
            <a href="/profile/favorites" class="active">Favorīti</a>
            <a href="/admin">Admin</a>
        </div>
    </nav>

    <div class="content-box">
        <h2 class="section-title">❤️ Saglabātās receptes</h2>

        @if($recipes->count() > 0)

            <div class="stats-box">
                <strong>{{ method_exists($recipes, 'total') ? $recipes->total() : $recipes->count() }}</strong>
                <span>Kopā saglabātās receptes</span>
            </div>

            <div class="recipes-grid">
                @foreach($recipes as $recipe)
                    <div class="recipe-card">
                        <h3>{{ $recipe->title }}</h3>

                        <div class="recipe-meta">
                            @if(!empty($recipe->user?->name))
                                <div>Autors: {{ $recipe->user->name }}</div>
                            @endif

                            @if(!empty($recipe->category?->name))
                                <div>Kategorija: {{ $recipe->category->name }}</div>
                            @endif

                            @if(!empty($recipe->created_at))
                                <div>Datums: {{ $recipe->created_at->format('d.m.Y') }}</div>
                            @endif
                        </div>

                        <div class="recipe-description">
                            {{ Str::limit($recipe->description, 130) }}
                        </div>

                        <div class="card-actions">
                            <a href="{{ route('recipes.show', $recipe) }}" class="btn btn-primary">
                                Skatīt recepti
                            </a>

                            <form method="POST" action="{{ route('recipes.favorite.toggle', $recipe) }}">
                                @csrf
                                <button type="submit" class="btn btn-danger">
                                    Noņemt no favorītiem
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="pagination-wrapper">
                {{ $recipes->links() }}
            </div>

        @else

            <div class="empty-box">
                <h2>Tev vēl nav favorītu</h2>
                <p>
                    Kad pie receptes nospiedīsi sirsniņu, tā parādīsies šeit.
                </p>
                <a href="/recipes" class="btn btn-primary">Pārlūkot receptes</a>
            </div>

        @endif
    </div>

</div>

</body>
</html>