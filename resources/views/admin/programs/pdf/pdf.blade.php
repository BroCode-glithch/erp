<!DOCTYPE html>
<html>
<head>
    <title>{{ $title ?? setting('general.site_name') . ' - Programs PDF' }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            font-size: 14px;
            background: #f8fafc;
            margin: 0;
            padding: 0;
            position: relative;
        }
        .watermark {
            position: fixed;
            top: 35%;
            left: 10%;
            width: 80%;
            text-align: center;
            opacity: 0.08;
            font-size: 120px;
            color: #2563eb;
            transform: rotate(-30deg);
            z-index: 0;
            pointer-events: none;
            user-select: none;
        }
        .container {
            position: relative;
            z-index: 1;
            padding: 32px 24px;
            max-width: 700px;
            margin: 0 auto;
        }
        .system-title {
            text-align: center;
            font-size: 2.2rem;
            color: #2563eb;
            font-weight: 800;
            margin-bottom: 8px;
            letter-spacing: 2px;
        }
        .subtitle {
            text-align: center;
            font-size: 1.2rem;
            color: #374151;
            margin-bottom: 28px;
            font-style: italic;
        }
        table {
            margin: 0 auto;
            width: 80%;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }
        th, td {
            border: 1px solid #d1d5db;
            padding: 10px 8px;
            text-align: center;
        }
        th {
            background: #2563eb;
            color: #fff;
            font-size: 1rem;
            letter-spacing: 1px;
        }
        tr:nth-child(even) td {
            background: #f3f4f6;
        }
        tr:hover td {
            background: #e0e7ff;
        }
    </style>
</head>
<body>
    <div class="watermark">Programs</div>
    <div class="container">
        <div class="system-title">{{ setting('general.site_name') }}</div>
        <div class="subtitle">{{ $title ?? 'Programs List' }}</div>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Created At</th>
                    <th>UPdated At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($programs as $program)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><em>{{ $program->name }}</em></td>
                        <td>{{ $program->created_at }}</td>
                        <td>{{ $program->updated_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
