<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])    

            <!-- Jquery -->
            <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

</head>
<body class="text-gray-800 font-sans">
    <!-- Start: Sidebar -->
    <div class="fixed left-0 top-0 w-64 h-full bg-gray-900 p-4 z-50 sidebar-menu transition-transform">
        <a class="flex items-center pb-4 border-b border-b-gray-800">
            <img src="https://placehold.co/32x32" alt="" class="w-8 h-8 rounded object-cover">
            <span class="text-sm">Painel Admin</span>
        </a>
        
        <x-sidebar.ul>
            <x-sidebar.li name="Painel" icon="ri-home-2-line mr-3 text-lg" class="active"/>
            <x-sidebar.li name="Mensagem" icon="ri-message-line mr-3 text-lg"/>
            <x-sidebar.li name="Permissões" icon="ri-lock-2-line mr-3 text-lg" submenu="true">

                <x-submenu.ul>
                    <x-submenu.li name="Grupos"/>
                    <x-submenu.li name="Permissões"/>
                    <x-submenu.li name="Usuário"/>
                </x-submenu.ul>
                
            </x-sidebar.li>
            <x-sidebar.li name="Configurações" icon="ri-settings-2-line mr-3 text-lg" submenu="true">

                <x-submenu.ul>
                    <x-submenu.li name="Sistema"/>
                </x-submenu.ul>
                
            </x-sidebar.li>
        </x-sidebar.ul>
    </div>
    <div class="fixed top-0 left-0 w-full h-full bg-black/50 z-40 md:hidden sidebar-overlay"></div>
    <!-- End: Sidebar -->

    <!-- Start: Main Section -->
    <main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-gray-50 min-h-screen transition-all main">
        <div class="py-2 px-6 bg-white flex items-center shadow-md shadow-black/5 sticky top-0 left-0 z-30">
            <button type="button" class="text-lg text-gray-600 sidebar-toggle">
                <i class="ri-menu-line"></i>
            </button>

            <ul class="flex items-center text-sm ml-4">
                <li class="mr-2">
                    <a href="#" class="text-gray-400 hover:text-gray-600 font-medium">Admin</a>
                </li>
                <li class="text-gray-600 mr-2 font-medium">/</li>
                <li class="text-gray-600 mr-2 font-medium">Painel</li>
            </ul>

            <ul class="ml-auto flex items-center">
                <li class="mr-1 dropdown">
                    <x-buttons.icon-button icon="ri-search-line"/>

                    <div class="dropdown-menu z-30 hidden max-w-xs w-full bg-white rounded-md border border-gray-100">
                        <form action="" class="p-4 border-b border-b-gray-100">
                            <div class="relative w-full">
                                <input type="text" class="py-2 pr-4 pl-10 bg-gray-50 w-full border border-gray-100 focus:ring-0 focus:border-gray-400 rounded-md text-sm" placeholder="Pesquisar...">
                                <i class="ri-search-line absolute top-1/2 left-4 -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </form>
                        <div class="mt-3 mb-2">
                            <div class="text-[13px] font-medium text-gray-400 ml-4 mb-2">Recentes</div>
                            
                            <x-historical-data.ul>
                                <x-historical-data.li smallMsg="R$ 100,00" message="Criando lading page"/>
                                <x-historical-data.li smallMsg="R$ 100,00" message="Criando lading page"/>
                                <x-historical-data.li smallMsg="R$ 100,00" message="Criando lading page"/>
                                <x-historical-data.li smallMsg="R$ 100,00" message="Criando lading page"/>
                                <x-historical-data.li smallMsg="R$ 100,00" message="Criando lading page"/>
                            </x-historical-data.ul>

                        </div>
                    </div>

                </li>

                <li class="mr-1 dropdown">
                    <x-buttons.icon-button icon="ri-notification-line"/>

                    <div class="dropdown-menu z-30 hidden max-w-xs w-full bg-white rounded-md border border-gray-100">
                        <div class="flex items-center px-4 pt-4 border-b border-b-gray-100 notification-tab">
                            <x-historical-data.button-tab name="Notificações" tab="notification" tabPage="notifications" class="active"/> {{-- Add active class for this button --}}
                            <x-historical-data.button-tab name="Notificações" tab="notification" tabPage="messages"/>
                        </div>

                        <div class="my-2">

                            <x-historical-data.ul tabFor='notification' page="notifications">
                                <x-historical-data.li smallMsg="Usuário" message="Nova ação"/>
                                <x-historical-data.li smallMsg="Usuário" message="Nova ação"/>
                                <x-historical-data.li smallMsg="Usuário" message="Nova ação"/>
                                <x-historical-data.li smallMsg="Usuário" message="Nova ação"/>
                                <x-historical-data.li smallMsg="Usuário" message="Nova ação"/>
                            </x-historical-data.ul>

                            <x-historical-data.ul tabFor='notification' page="messages" class="hidden">
                                <x-historical-data.li smallMsg="Olá, Mundo" message="Illian"/>
                                <x-historical-data.li smallMsg="Olá, Mundo" message="Illian"/>
                                <x-historical-data.li smallMsg="Olá, Mundo" message="Illian"/>
                                <x-historical-data.li smallMsg="Olá, Mundo" message="Illian"/>
                                <x-historical-data.li smallMsg="Olá, Mundo" message="Illian"/>
                            </x-historical-data.ul>
                            
                        </div>
                    </div>
                </li>

                <li class="ml-3 dropdown">
                    <button type="button" class="dropdown-toggle flex items-center">
                        <img src="https://placehold.co/32x32" alt="" class="w-8 h-8 rounded block object-cover align-middle">
                    </button>
                    <ul class="dropdown-menu z-30 hidden py-1.5 rounded-md bg-white border border-gray-100 w-full max-w-[140px]">
                        <li>
                            <a href="#" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-900 hover:bg-gray-50">Perfil</a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-900 hover:bg-gray-50">Configurações</a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-900 hover:bg-gray-50">Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        
       @yield('content')
    </main>
    <!-- End: Main Section -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="{{ asset('assets/js/admin.js') }}"></script>
</body>
</html>