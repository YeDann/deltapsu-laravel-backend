<!DOCTYPE html>
<html>
<head>
    <title>410 - Gone</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
            background-color: #f5f5f5;
        }
        .error-container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #e74c3c;
            font-size: 48px;
            margin-bottom: 20px;
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
        }
        p {
            color: #666;
            line-height: 1.6;
            margin-bottom: 30px;
        }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 0 10px;
        }
        .btn:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <h1>410</h1>
        <h2>Gone</h2>
        <p>The resource you are looking for has been permanently removed and is no longer available.</p>
        <p>This page has been retired and will not be coming back.</p>
        
        <a href="{{ url('/') }}" class="btn">Go to Homepage</a>
        <a href="{{ url()->previous() }}" class="btn">Go Back</a>
    </div>
</body>
</html>