<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .lightup {
                display: block;
            }

            .footer {
                position:absolute;
                bottom:20px;
                right:20px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Full-Stack: Lucas Serafim
                </div>
                <hr/>
                <div class="links">
                    <a href="mailto:lslucas@gmail.com" target='_blank'>Email</a>
                    <a href="https://github.com/lslucas" target='_blank'>GITHUB</a>
                    <a href="https://www.linkedin.com/in/lucasserafim/" target='_blank'>LINKEDIN</a>
                </div>
                <div class="links footer">
                    <a href="https://documenter.getpostman.com/view/178818/RWEcNfJi#8309d7fc-a6aa-4562-af52-f7bf5d917092" target='_blank' class='lightup'>API Docs</a>
                    <div class="postman-run-button"
                        data-postman-action="collection/import"
                        data-postman-var-1="77c69595ebc5446bc323"></div>
                        <script type="text/javascript">
                        (function (p,o,s,t,m,a,n) {
                            !p[s] && (p[s] = function () { (p[t] || (p[t] = [])).push(arguments); });
                            !o.getElementById(s+t) && o.getElementsByTagName("head")[0].appendChild((
                            (n = o.createElement("script")),
                            (n.id = s+t), (n.async = 1), (n.src = m), n
                            ));
                        }(window, document, "_pm", "PostmanRunObject", "https://run.pstmn.io/button.js"));
                        </script>
                    </div>
            </div>
        </div>
    </body>
</html>
