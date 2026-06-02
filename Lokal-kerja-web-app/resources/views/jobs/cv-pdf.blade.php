<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>CV</title>
    <style>
    * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            line-height: 1.6;
            color: #1f2937;
            font-size: 11px;
            background: #ffffff;
        }

        .container {
            max-width: 210mm;
            margin: 0 auto;
            padding: 15mm;
            background: white;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 8px;
            color: #14532d;
            border-bottom: 3px solid #14532d;
            padding-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        h2 {
            font-size: 14px;
            margin-top: 14px;
            margin-bottom: 8px;
            color: #166534;
            border-bottom: 2px solid #bbf7d0;
            padding-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        h3 {
            font-size: 12px;
            margin-top: 8px;
            margin-bottom: 4px;
            color: #111827;
            font-weight: 700;
        }

        p {
            margin-bottom: 6px;
            text-align: justify;
        }

        ul, ol {
            margin-left: 20px;
            margin-bottom: 8px;
        }

        li {
            margin-bottom: 4px;
        }

        strong {
            font-weight: 700;
            color: #111827;
        }

        em {
            font-style: italic;
            color: #4b5563;
        }

        code {
            background-color: #f3f4f6;
            padding: 2px 4px;
            border-radius: 3px;
            font-family: 'Courier New', monospace;
            font-size: 10px;
        }

        .section {
            margin-bottom: 10px;
        }

        hr {
            border: none;
            border-top: 1px solid #d1fae5;
            margin: 8px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 8px;
        }

        td {
            padding: 3px;
            border: 1px solid #d1fae5;
        }

        blockquote {
            border-left: 3px solid #14532d;
            padding-left: 10px;
            margin-left: 0;
            color: #4b5563;
            font-style: italic;
            margin-bottom: 8px;
        }

        a {
            color: #166534;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        {!! Illuminate\Support\Str::markdown($cvText) !!}
    </div>
</body>
</html>
