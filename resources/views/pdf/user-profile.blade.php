<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <title>Lietotāja profils</title>
    @include('pdf.styles')
</head>
<body>
    <div class="header">
        <h1>{{ $user->name }}</h1>
        <p><strong>E-pasts:</strong> {{ $user->email }}</p>
    </div>

    <h2>Lietotāja pievienotās receptes</h2>

    <table>
        <thead>
            <tr>
                <th>Nosaukums</th>
                <th>Izveides datums</th>
                <th>Kategorija</th>
                <th>Vidējais vērtējums</th>
            </tr>
        </thead>
        <tbody>
            @foreach($recipes as $recipe)
                @php
                    $avg = $recipe->reviews->avg('rating');
                @endphp
                <tr>
                    <td>{{ $recipe->title }}</td>
                    <td>{{ optional($recipe->created_at)->format('d.m.Y') }}</td>
                    <td>{{ $recipe->category ?? '-' }}</td>
                    <td>{{ $avg ? number_format($avg, 1) : '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>