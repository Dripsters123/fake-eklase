<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Average Grades</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #eee; }
    </style>
</head>
<body>
    <h2>Vidēja atzīme priekšmetos</h2>
    <table>
        <thead>
            <tr>
                <th>Priekšmets</th>
                <th>Vidējā atzīme</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($averages as $avg)
                <tr>
                    <td>{{ $avg->subject->subject_name ?? 'Unknown' }}</td>
                    <td>{{ number_format($avg->average_grade, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
