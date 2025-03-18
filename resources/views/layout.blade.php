<?php
    $someone = [
        "1" => "マイケル・ジョーダン（アメリカの元プロバスケットボール選手）",
        "2" => "オプラ・ウィンフリー（アメリカのTV司会者）",
        "3" => "孔子（古代中国の思想家）",
        "4" => "アルバート・アインシュタイン（ドイツ生まれの理論物理学者）",
        "5" => "ネルソン・マンデラ（南アフリカ史上初の黒人大統領）",
        "6" => "ウィンストン・チャーチル（イギリスの元首相）",
        "7" => "ビル・ゲイツ（アメリカの実業家）",
        "8" => "ロバート・ケネディ（アメリカの政治家）",
        "9" => "トルーマン・カポーティ（アメリカの小説家）",
        "10" => "ヘンリー・フォード（自動車会社フォード・モーターの創設者）",
        "11" => "マット・ビオンディ（アメリカの元競泳選手）",
        "12" => "ロベルト・バッジョ（イタリアのサッカー選手）",
        "13" => "",
        "14" => "",
        "15" => ""
      ];

    $massege = [
        "1" => "私はキャリアを通じて9000回以上シュートを外し、300試合に敗れ、決勝シュートを任されて26回も外しています。人生で何度も何度も失敗したからこそ、今の成功があるんです。",
        "2" => "傷を知恵に変えなさい。",
        "3" => "人生における最大の栄光は、決して転ばないことでは無い。何度転んでも起き上がることにあるのだ。",
        "4" => "失敗したことのない人間というのは、挑戦をしたことのない人間である。",
        "5" => "成功で私を判断しないでほしい。失敗から何度はい上がったかで判断してほしい。",
        "6" => "成功とは意欲を失わずに失敗に次ぐ失敗を繰り返すことである。",
        "7" => "成功を祝うのもいいですが、もっと大切なのは失敗から学ぶことです。",
        "8" => "大失敗を恐れぬ者だけが大成功を手にできるのである。",
        "9" => "失敗は成功の味を引き立てる調味料である。",
        "10" => "本当の失敗とは、失敗から何も学ばないことである。",
        "11" => "粘り強さは失敗を偉業へと変える。",
        "12" => "失敗ができるのは、勇気を持つ者だけだ。（PKを外すことができるのは、PKを蹴る勇気を持つ者だけだ。）",
        "13" => "一歩、成功に近づきました。あとで笑い話にしてやりましょう！",
        "14" => "興味深い失敗ですね。また一つ学びを得ましたね。",
        "15" => "失敗は成功のもと。どんどん失敗しましょう！"
    ];

      $random_number = rand(1, 15);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>失敗アプリNOMOTO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="https://cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-primary sticky-top">
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
                            <a class="nav-link text-white" href="{{ route('posts.index') }}">一覧に戻る</a>
                        </li>
                        <li class="nav-item">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <a class="nav-link text-white" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>
                        </li>
                    @else
                    <li class="nav-item">
                         <a class="nav-link text-white" href="{{ route('login') }}">ログイン</a>
                    </li>
                    <li class="nav-item">
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
            <p class="mb-0">
                <?=$someone[$random_number]?>
            </p>
            <p>
                <?=$massege[$random_number]?>
            </p>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger" role="alert">
        <div class="text-center">
        <h4 class="alert-heading">登録できませんでした。</h4>
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