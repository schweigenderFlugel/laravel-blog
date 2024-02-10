<head>
    <style>

        @page {
            margin-top: 120px; 
            margin-bottom: 40px;
        }

        header {
            position: fixed;
            top: -60px;
            margin-left: 35px;
        }

        footer {
            position: fixed;
            bottom: 20px;
            left: 35px;
            align-content: center;
        }

        #title {
            margin-top: 50px;
            margin-bottom: 40px;
            text-align: center;
        }

        #autor {
            margin-right: 45px;
            margin-bottom: -15px;
            text-align: right;
        }

        #email {
            margin-right: 45px;
            margin-bottom: 40px;
            text-align: right;
        }

        #introduction {
            margin-left: 135px;
            margin-right: 135px;
            margin-bottom: 40px;
            text-align: justify;
            font-size: 16px;
        }

        #body {
            margin-left: 55px;
            margin-right: 55px;
            margin-bottom: 60px;
            text-align: justify;
            font-size: 16px;
            line-height: 200%;
        }

        .fecha {
            margin-left: 55px;
            margin-right: 55px;
            margin-bottom: -5px;
            text-align: right;
            font-size: 16px;
        }

    </style>
</head>

<body>
    <header>
        <img src="{{ asset('img/logo.png') }}" alt="">
    </header>

    <footer>
        <a href="https://edutin.com" target="_blank">Desarrollado por &copy; Edutin Academy</a>
    </footer>
    
        <h3 id="title">{{ $article->title }}</h3>
        <p id="autor"><em>{{ $article->user->full_name }}</em></p>
        <p id="email">{{ $article->user->email }}</p>
        <p id="introduction"><em>{{ $article->introduction }}</em></p>
        <p id="body">{{ $article->body }}</p>
        <p class="fecha"><em style="font-weight: bold;">Fecha de publicación: </em>{{ $article->created_at }}</p>
        <p class="fecha"><em style="font-weight: bold;">Fecha de actualización: </em>{{ $article->updated_at }}</p>
    
</body>

</html>