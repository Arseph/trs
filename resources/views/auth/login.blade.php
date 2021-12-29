<!doctype html>
<html lang="en">
  <head>
    <title> Training Registration System </title>
    <link rel="icon" href="{{ asset('public/images/dohlogo1.png') }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <link rel="stylesheet" href="{{ asset('public/css/style.css') }}">

  </head>
  <body>
  <section>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6 text-center mb-3 mt-3">
          <h2 class="heading-section">Training Registration System</h2>
          <span> <img src="{{ asset('public/images/dohlogo1.png') }}" style="width: 15%"/>&nbsp;
              <img src="{{ asset('public/images/dohro12logo2.png') }}" style="width: 15%"/>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-7 col-lg-5">
          <div class="wrap">
            <div class="text-center">
              <br>
              <img src="{{ asset('public/images/login.png') }}" alt="login image" class="img">
            </div>
            <div class="login-wrap p-4 p-md-5">
              <div class="d-flex">
                <div class="text-center">
                  <h5>Login</h5>
                </div>
              </div>
              <form method="POST" action="{{ asset('login') }}" class="signin-form">
                {{ csrf_field() }}
                <span class="help-block">
                    @if($errors->any())
                        <strong style="color: #A52A2A;">{{$errors->first()}}</strong>
                    @endif
                </span>
                <div class="form-group mt-3 mb-4">
                  <input type="text" class="form-control" name="username" autocomplete="off" required>
                  <label class="form-control-placeholder" for="username">Username</label>
                </div>
                <div class="form-group">
                  <input id="password-field" type="password" class="form-control" name="password" required>
                  <label class="form-control-placeholder" for="password">Password</label>
                  <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                </div>
                <div class="form-group">
                  <button type="submit" class="form-control btn btn-primary rounded submit px-3">Sign In</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="{{ asset('public/js/login/jquery.min.js') }}"></script>
  <script src="{{ asset('public/js/login/popper.js') }}"></script>
  <script src="{{ asset('public/js/login/bootstrap.min.js') }}"></script>
  <script src="{{ asset('public/js/login/main.js') }}"></script>

  </body>
</html>

