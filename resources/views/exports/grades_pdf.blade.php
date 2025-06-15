<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <title>Atzīmes</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #eee; }
    </style>
</head>
<body>
    <h2>Mans atzīmju saraksts</h2>
    <table>
        <thead>
            <tr>
                <th>Priekšmets</th>
                <th>Atzīme</th>
                <th>Datums</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($grades as $grade)
                <tr>
                    <td>{{ $grade->subject->subject_name ?? 'Nezināms' }}</td>
                    <td>{{ $grade->grade }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
