<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            padding-bottom: 20px;
        }

        .header h1 {
            color: #333333;
            font-size: 24px;
            margin: 0;
        }

        .content {
            color: #555555;
            font-size: 16px;
            line-height: 1.5;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            color: #999999;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Welcome to OmegaZero Technology</h1>
        </div>

        <div class="content">
            <p>{{$body}}</p>
        </div>

        <div class="footer">
            <p>This email was sent from OmegaZero Technology.</p>
        </div>
    </div>
</body>
</html>
