<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>COACHTECH</title>
  <link rel="stylesheet" href="/css/style.css">
</head>
<body>
  <div class="container">
    <div class="card">
      <div class="card_header">
        <p class="title mb-15">@yield('title')</p>
        <div class="auth mb-15">
          <p class="detail">「@yield('user')」でログイン中</p>
          <form action="/logout" method="post">
            @csrf
            <input class="button btn-logout" type="submit" value="ログアウト">
          </form>
        </div>
      </div>
      @yield('content')
    </div>
  </div>
</body>
</html>