<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Working in Progress</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 800px;
            margin-top: 100px;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .card-header {
            background-color: #0d6efd;
            color: white;
            border-radius: 15px 15px 0 0 !important;
            text-align: center;
            padding: 20px;
        }
        .card-body {
            padding: 40px;
            text-align: center;
        }
        .construction-icon {
            font-size: 80px;
            color: #ffc107;
            margin-bottom: 20px;
        }
        .btn-back {
            background-color: #0d6efd;
            color: white;
            padding: 10px 30px;
            border-radius: 25px;
            margin-top: 20px;
        }
        .btn-back:hover {
            background-color: #0b5ed7;
            color: white;
        }
        .current-route {
            background-color: #e9ecef;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
            font-family: monospace;
            word-break: break-all;
        }
        .info-box {
            background-color: #f8f9fa;
            border-left: 4px solid #0d6efd;
            padding: 15px;
            margin-top: 20px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2 class="mb-0">🚧 Page Under Construction 🚧</h2>
            </div>
            <div class="card-body">
                <div class="construction-icon">
                    🔨
                </div>
                <h3 class="mb-3">This page is working in progress</h3>
                <p class="text-muted mb-4">
                    We're currently working on this feature. Please check back later or contact the administrator for more information.
                </p>

                <div class="current-route">
                    <strong>Current Route:</strong><br>
                    {{ request()->url() }}
                </div>

                <div class="info-box">
                    <h5>📋 Information:</h5>
                    <ul class="mb-0">
                        <li>Route Name: {{ Route::currentRouteName() ?? 'N/A' }}</li>
                        <li>Method: {{ request()->method() }}</li>
                        <li>Timestamp: {{ now()->format('Y-m-d H:i:s') }}</li>
                    </ul>
                </div>

                <a href="{{ url()->previous() }}" class="btn btn-back">
                    ← Go Back
                </a>
                <a href="{{ route('dashboard') }}" class="btn btn-back ms-2">
                    🏠 Dashboard
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
