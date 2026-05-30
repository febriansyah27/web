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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            font-size: 11px;
        }
        
        .container {
            max-width: 210mm;
            margin: 0 auto;
            padding: 15mm;
            background: white;
        }
        
        h1 {
            font-size: 24px;
            margin-bottom: 5px;
            color: #1a365d;
            border-bottom: 3px solid #1a365d;
            padding-bottom: 8px;
        }
        
        h2 {
            font-size: 14px;
            margin-top: 12px;
            margin-bottom: 8px;
            color: #1a365d;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 4px;
        }
        
        h3 {
            font-size: 12px;
            margin-top: 8px;
            margin-bottom: 4px;
            color: #2d3748;
            font-weight: 600;
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
        
        .contact-info {
            display: flex;
            gap: 15px;
            margin-bottom: 12px;
            font-size: 10px;
            flex-wrap: wrap;
        }
        
        .contact-item {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        strong {
            font-weight: 600;
            color: #2d3748;
        }
        
        em {
            font-style: italic;
            color: #666;
        }
        
        code {
            background-color: #f7fafc;
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
            border-top: 1px solid #e2e8f0;
            margin: 8px 0;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 8px;
        }
        
        td {
            padding: 3px;
            border: 1px solid #e2e8f0;
        }
        
        blockquote {
            border-left: 3px solid #1a365d;
            padding-left: 10px;
            margin-left: 0;
            color: #666;
            font-style: italic;
            margin-bottom: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        {!! Illuminate\Support\Str::markdown($cvText) !!}
    </div>
</body>
</html>
