<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理画面</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- TailwindCSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">
    <!-- ヘッダー -->
    <header class="bg-gray-800 text-white text-center py-4 text-xl font-bold">
        管理画面
    </header>

    <!-- コンテンツ -->
    <div class="container mt-4">
        @yield('content') <!-- 管理画面の各ページがここに挿入される -->
    </div>

   <!-- フッター -->
   <footer class="bg-gray-800 text-center py-4 text-white mt-auto">
        <p>&copy; 2025 Laravel Blog</p>
    </footer>
</body>
</html>
