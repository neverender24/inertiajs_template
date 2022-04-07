<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <title>Sign In - Your System Name</title>

    <link href="{{ mix('css/app.css') }}" rel="stylesheet" />
</head>

<body class="app">
    <div id="loader">
        <div class="spinner"></div>
    </div>
{{$errors}}
    <div class="peers ai-s fxw-nw h-100vh">
        <div class="d-n@sm- peer peer-greed h-100 pos-r bgr-n bgpX-c bgpY-c bgsz-cv"
            style='background-image:url("images/bg.jpg")'>
            <div class="pos-a centerXY">
                <div class="row text-center">
                    <div>
                        <img class="mw-50" src="images/logo.png" alt="">
                    </div>
                </div>
                <div class="row" style="color:white">
                    <h3>YOUR INFORMATION SYSTEM NAME</h3>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4 peer pX-40 pY-80 h-100 bgc-white scrollable pos-r" style="min-width:320px">
            <div class="row text-center" id="mobile-logo">
                <div class="col-offset-5 mb-1">
                    <img class="img-fluid" src="images/logo.png" alt="">
                    <h3>YOUR INFORMATION SYSTEM NAME</h3>
                </div>
            </div>
            <h4 class="fw-300 c-grey-900 mB-40">Login</h4>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                 @if ($errors)
                 <small class="text-danger"><strong>{{ $errors->first('email') }}</strong></small>
                 @endif
                <div class="mb-3">
                    <label class="text-normal text-dark form-label">Username</label>
                    <input type="email" name="email" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="text-normal text-dark form-label">Password</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <div class="">
                    <div class="peers ai-c jc-sb fxw-nw">
                        <div class="peer">
                            <div class="checkbox checkbox-circle checkbox-info peers ai-c"><input type="checkbox"
                                    id="inputCall1" name="inputCheckboxesCall" class="peer"> <label for="inputCall1"
                                    class="peers peer-greed js-sb ai-c form-label"><span
                                        class="peer peer-greed">Remember Me</span></label></div>
                        </div>
                        <div class="peer"><button type="submit" class="btn btn-primary btn-color">Login</button></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

<script>
    window.addEventListener("load", (function () {
        const t = document.getElementById("loader");
        setTimeout((function () {
            t.classList.add("fadeOut")
        }), 300)
    }))

    var x = document.getElementById("mobile-logo");

    if ( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
</script>
</html>
