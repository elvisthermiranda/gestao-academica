<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body class="bg-light">
    <div class="sky-container">
        @if (!isset($noSidebar))
            <div class="sky-menu-vertical">

                <div class="row p-2 d-flex justify-content-center align-items-center">
                    <a href="{{ route("home") }}" class="col d-flex justify-content-center align-items-center">
                        <img src="{{ asset('img/logo-smp-white.png') }}" width="77">
                    </a>
                    <button class="btn sky-btn-closemenu float-right mr-3"><i class="fas fa-times text-light"></i></button>
                </div>

                <a href="#" class="sky-profile">
                    <div class="d-flex flex-row">
                        <div class="mr-1 d-flex justify-content-center align-items-center">
                            <img src="{{ asset('img/profile-pic.jpg') }}" class="img-fluid">
                        </div>
                        <div class="ml-1 d-flex align-items-center">
                            <div>
                                {{ Auth::user()->pessoa->nome }}<br>
                                <small class="text-muted">
                                    {{ Auth::user()->pessoa->tipoPerfil->nome_perfil }}
                                </small>
                            </div>
                        </div>
                    </div>
                </a>
                
                <nav class="sky-navigator">
                    <ul class="sky-navbar-vertical-drop">
                        @role('TecnicoAdministrativo')
                            <li>
                                <a href="#" onclick="toggleMenu('drop1', 'caret1')">
                                    <i class="fas fa-user-graduate"></i> Secretaria <span class="float-right d-inline-block"><i id="caret1" class="fas fa-caret-down"></i></span>
                                </a>
                                <ul class="sky-dropdown" id="drop1">
                                    <li>
                                        <a href="{{ route('curso.index') }}">Curso</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('disciplina.index') }}">Disciplina</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('funcionario.index') }}">Funcionário</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('aluno.index') }}">Aluno</a>
                                    </li>
                                </ul>
                            </li>
                        @endrole
                    </ul>
                </nav>

            </div>

            <div class="sky-main">

                <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                    <div class="container-fluid">
                        <button class="btn sky-btn-hidden"><i class="fas fa-bars"></i></button>
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i> Sair
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </nav>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb sky-breadcrumb pl-4">
                        @yield('breadcrumb')
                    </ol>
                </nav>

                @yield('content')
            </div>
        @else
            @yield('content')
        @endif
    </div>

    @if($errors->any())
        <div class="toast bg-danger position-absolute" style="top:15px;right:15px;" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="false">
            <div class="toast-body text-white">
                <button type="button" class="ml-2 mb-1 close text-white" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                @foreach ($errors->all() as $error)
                    {{ $error }}
                    <br>
                @endforeach
            </div>
        </div>
    @endif

    @if (session('success'))
        <div class="toast bg-success position-absolute" style="top:15px;right:15px;" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
            <div class="toast-body text-white">
                <button type="button" class="ml-2 mb-1 close text-white" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session('success') }}
            </div>
        </div>
    @endif

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script>
        function ResetCampos(){for(var o=document.getElementsByTagName("input"),e=0;e<o.length;e++)"text"==o[e].type&&(o[e].style.backgroundColor="",o[e].style.borderColor="")}function coresMask(o){var e=o.value,r=e.length,t=o.maxLength;0==r?(o.style.borderColor="",o.style.backgroundColor=""):r<t?(o.style.borderColor=corIncompleta,o.style.backgroundColor=corIncompleta):(o.style.borderColor=corCompleta,o.style.backgroundColor=corCompleta)}function mascara(o,e,r,t){var l=e.selectionStart,a=e.value;a=a.replace(/\D/g,"");var s=a.length,c=o.length;window.event?id=r.keyCode:r.which&&(id=r.which),cursorfixo=!1,l<s&&(cursorfixo=!0);var n=!1;if((16==id||19==id||id>=33&&id<=40)&&(n=!0),ii=0,mm=0,!n){if(8!=id)for(e.value="",j=0,i=0;i<c&&("#"==o.substr(i,1)?(e.value+=a.substr(j,1),j++):"#"!=o.substr(i,1)&&(e.value+=o.substr(i,1)),8==id||cursorfixo||l++,j!=s+1);i++);t&&coresMask(e)}cursorfixo&&!n&&l--,e.setSelectionRange(l,l)}var corCompleta="#99ff8f",corIncompleta="#eff70b";
        //Troca de lado a seta do menu dropdown e mostra/não mostra o submenu
		function toggleMenu(idElement, idIcon){
			let menu = document.getElementById(idElement);
			menu.style.display = menu.style.display == 'block' ? 'none': 'block';
            if(idIcon != null){
                document.getElementById(idIcon).classList.toggle('fa-caret-up');
            }
		}

        //Ao clicar no botao faz aparecer o menu
        document.querySelector('.sky-btn-hidden').addEventListener('click', function(){
            document.querySelector('.sky-menu-vertical').style.display = 'block';
        });

        //Ao clicar no botao faz o menu desaparecer
        document.querySelector('.sky-btn-closemenu').addEventListener('click', function(){
            document.querySelector('.sky-menu-vertical').style.display = 'none';
        });
	</script>

    @stack('scripts')
</body>
</html>
