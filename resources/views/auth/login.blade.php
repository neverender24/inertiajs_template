<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <title>Sign In</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <script defer="defer" src="/js/app.js"></script>
</head>

<body class="app">
    <div id="loader">
        <div class="spinner"></div>
    </div>
    <script>
        window.addEventListener("load", (function () {
            const t = document.getElementById("loader");
            setTimeout((function () {
                t.classList.add("fadeOut")
            }), 300)
        }))

    </script>
    <div class="peers ai-s fxw-nw h-100vh">
        <div class="d-n@sm- peer peer-greed h-100 pos-r bgr-n bgpX-c bgpY-c bgsz-cv"
            style='background-image:url("images/bg.jpg")'>
            <div class="pos-a centerXY">
                <div class="bgc-white bdrs-50p pos-r" style="width:120px;height:120px"><img class="pos-a centerXY"
                        src="images/logo.png" alt=""></div>
            </div>
        </div>
        <div class="col-12 col-md-4 peer pX-40 pY-80 h-100 bgc-white scrollable pos-r" style="min-width:320px">
            <h4 class="fw-300 c-grey-900 mB-40">Login</h4>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3"><label class="text-normal text-dark form-label">Username</label> 
                    <input type="email" name="email" class="form-control" placeholder="John Doe"></div>
                <div class="mb-3"><label class="text-normal text-dark form-label">Password</label> 
                    <input
                        type="password" class="form-control" name="password" placeholder="Password"></div>
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

</html>
