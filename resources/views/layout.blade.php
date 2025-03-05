<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>掲示板アプリ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-primary">
        <div class="container">
            <div>
            <div>
                <a class="navbar-brand text-white" href="{{ route('posts.index') }}">失敗アプリNOMOTO</a>
                </div>
                <div>
                <a class="navbar-brand text-white" href="{{ route('posts.index') }}">〜失敗は成功のもと〜</a>
                </div>
            </div>
                
            <div class="ml-auto"></div>
                <ul class="navbar-nav">
                    @if (Auth::check())
                        <li class="nav-item">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <a class="nav-link text-white" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>
                        </li>
                    @else
                    <li class="nav-item">
                         <a class="nav-link text-white" href="{{ route('login') }}">ログイン</a>
                         <a class="nav-link text-white" href="{{ route('register') }}">新規登録</a>
                    </li>
                    @endif
                </ul>
        </div>
    </nav>
    <div class="container mt-4">
        @yield('content')
    </div>
</body>
</html>