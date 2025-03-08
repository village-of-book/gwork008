<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>掲示板アプリ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
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

    @if(session('success'))
    <div class="alert alert-success" role="alert">
        <div class="text-center">
        <h4 class="alert-heading">{{ session('success') }}</h4>
            <hr>
            <p class="mb-0">マイケル・ジョーダン（アメリカの元プロバスケットボール選手）</p>
            <p>私はキャリアを通じて9000回以上シュートを外し、300試合に敗れ、決勝シュートを任されて26回も外しています。人生で何度も何度も失敗したからこそ、今の成功があるんです。</p>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger" role="alert">
        <div class="text-center">
        <h4 class="alert-heading">失敗を登録できませんでした。</h4>
            <hr>
            <p class="mb-0">また一つ学びを得ましたね</p>            
            <p>失敗は成功のもと。どんどん失敗しましょう！</p>
        </div>
    </div>
    @endif

    <div class="container mt-4">
        @yield('content')
    </div>
</body>
</html>