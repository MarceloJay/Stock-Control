<!DOCTYPE html>
<script>
    function removeTokenFromURL() {
        var url = window.location.href;
        var updatedURL = url.split('?')[0]; 
        history.replaceState({}, document.title, updatedURL);
    }

    if (window.location.href.includes('token=')) {
        removeTokenFromURL();
    }
</script>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">    

<head>
    <title>StockControl</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>

        @import url('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

        *,
        *::before,
        *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100vh;
        }

        body {
            font: 500 .9rem/1 'Avenir Next', sans-serif;
            color: #333;
            background: #fff;
            margin-left: 0px;
        }

        .wrapper {
            display: flex;
            min-height: 100%;
        }

        .sidebar {
            top: 0%;
            position: absolute;
            width: 240px;
            padding: 20px;
            transform: translateX(0);
            transition: transform .3s;
            background: #2f323e;
            height: 100vh;
        }

        .content {
            flex: 1;
            padding: 50px;
            background: #fff;
            box-shadow: 0 0 5px #000;
            transform: translateX(0);
            transition: transform .3s;
        }

        .sidebar.isOpen {
            transform: translateX(-220px);
        }

        .button {
            display: block;
            cursor: pointer;
            top: 20px;
            /* margin-left: -200px; */
        }

        .button svg {
            width: 20px;
        }

        .button line {
            stroke: black;
            stroke-width: 10;
        }

        h1 {
            margin-top: 25px;
            font-size: 40px;
            font-weight: 400;
        }

        .nav {
            list-style: none;
            margin-top: 40px;
        }

        .nav li a {
            position: relative;
            display: block;
            margin-bottom: 5px;
            padding: 16px 0 16px 50px;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
        }

        .nav li a:hover,
        .nav li a.active {
            background: rgba(0,0,0,.3);
        }

        .nav li a::before {
            font: 14px fontawesome;
            position: absolute;
            top: 15px;
            left: 20px;
        }

        .logo {
            width: 180px; 
            height: 100px;
            border-radius: 10%;
            margin: 20px 0px 0px 0px;
        }

        .nav li:nth-child(1) a::before { content: '\f015'; } 
        .nav li:nth-child(2) a::before { content: '\f07a'; } 
        .nav li:nth-child(3) a::before { content: '\f07c'; } 
        .nav li:nth-child(4) a::before { content: '\f07c'; } 
        .nav li:nth-child(5) a::before { content: '\f007'; } 
        .nav li:nth-child(6) a::before { content: '\f080'; } 
        .nav li:nth-child(7) a::before { content: '\f013'; } 
        .nav li:nth-child(8) a::before { content: '\f011'; }
    </style>
</head>
<body>
    @yield('content')
    <div class="wrapper">
    <div class="sidebar isOpen">
        <img src="{{ asset('images/mystocklogo.png') }}" alt="Logo" class="logo">
        <a class="button" style="margin: 0px 15px 0px 230px;  position: absolute;">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
                <line x1="0" y1="20" x2="100" y2="20" />
                <line x1="0" y1="50" x2="100" y2="50" />
                <line x1="0" y1="80" x2="100" y2="80" />
            </svg>
        </a>
            
        <ul class="nav">
            <li><a href="{{ route('dashboard.index') }}">Página Inicial</a></li>
            <li><a href="{{ route('produtos.index') }}">Produtos</a></li>
            <li><a href="{{ route('produtos.create') }}">Adicionar Pedidos</a></li>
            <li><a href="#">Retirar Produtos</a></li>
            <li><a href="#">Clientes</a></li>
            <li><a href="#">Relatórios</a></li>
            <li><a href="#">Settings</a></li>
            <li><a href="#" id="logout">Logout</a></li>
        </ul> 
    </div>
    
    </div>

    <script>
        document.querySelector('.sidebar').classList.toggle('isOpen');

        document.querySelector('.button').addEventListener('click', () => {
            document.querySelector('.sidebar').classList.toggle('isOpen');
        });


        const logoutLink = document.getElementById('logout');
        const csrfToken = '{{ csrf_token() }}';
        logoutLink.addEventListener('click', () => {
            fetch('/api/auth/logout', {
                method: 'POST',
                headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken }
            })
                .then(response => response.json())
                .then(data => {
                // Exiba a mensagem da resposta JSON (opcional)
                console.log(data.message);
                
                // Redirecione para a página de login
                window.location.href = '/login';
                })
                .catch(error => {
                console.error('Erro:', error);
            });
        });

    </script>
</body>
</html>



