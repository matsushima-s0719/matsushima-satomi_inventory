<!doctype html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>在庫管理システム</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="d-flex flex-column min-vh-100 bg-light">
    <div id="app" class="d-flex flex-column flex-grow-1">
        {{-- ヘッダー（※色を変えたいときは下の #2c3e50 を好きなカラーコードに変えてOKです！） --}}
        <nav class="navbar navbar-expand-md navbar-dark shadow-sm" style="background-color: #2c3e50;">
            <div class="container">
                <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                    在庫管理システム
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="メニュー切替">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    {{-- 左側メニュー（ログイン中のみ表示） --}}
                    @auth
                        <ul class="navbar-nav me-auto ms-3">
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('items.index') }}">商品</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="#">入出庫履歴</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('categories.index') }}">カテゴリ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('suppliers.index') }}">仕入先</a>
                            </li>
                        </ul>
                    @endauth

                    {{-- 右側：ログインユーザー名＆ログアウトボタン --}}
                    <ul class="navbar-nav ms-auto align-items-center">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('login') }}">ログイン</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('register') }}">新規登録</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item me-3">
                                <span class="text-white">{{ Auth::user()->name }}さん</span>
                            </li>
                            <li class="nav-item">
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-light btn-sm">ログアウト</button>
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        {{-- メイン部分 --}}
        <main class="py-4 flex-grow-1">
            <div class="container">
                {{-- 成功・エラーのフラッシュメッセージ表示枠 --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="閉じる"></button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="閉じる"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>

        {{-- フッター --}}
        <footer class="py-3 text-center text-muted border-top bg-white mt-auto">
            <div class="container">
                <small>© 2026 在庫管理システム</small>
            </div>
        </footer>
    </div>
</body>

</html>
