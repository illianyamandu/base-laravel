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
    <div class="fixed left-0 top-0 w-64 h-full bg-gray-900 p-4">
        <a class="flex items-center pb-4 border-b border-b-gray-800">
            <img src="https://placehold.co/32x32" alt="" class="w-8 h-8 rounded object-cover">
            <span class="text-sm">Painel Admin</span>
        </a>
        <ul class="mt-4">
            <li class="mb-1 group active">
                <a href="#" class="flex items-center py-2 px-4 text-gray-300 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                    <i class="ri-home-2-line mr-3 text-lg"></i>
                    <span class="text-sm">Painel</span>
                </a>
            </li>

            <li class="mb-1 group">
                <a href="#" class="flex items-center py-2 px-4 text-gray-300 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                    <i class="ri-message-line mr-3 text-lg"></i>
                    <span class="text-sm">Mensagens</span>
                </a>
            </li>

            <li class="mb-1 group">
                <a href="#" class="flex items-center py-2 px-4 text-gray-300 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 sidebar-dropdown-toggle">
                    <i class="ri-service-fill mr-3 text-lg"></i>
                    <span class="text-sm">Serviços</span>
                    <i class="ri-arrow-right-s-line ml-auto group-[.selected]:rotate-90"></i>
                </a>

                <ul class="pl-7 mt-2 hidden group-[.selected]:block">
                    <li class="mb-4">
                        <a href="#" class="text-gray-300 hover:text-gray-100 text-sm flex items-center before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Grupos</a>
                    </li>

                    <li class="mb-4">
                        <a href="#" class="text-gray-300 hover:text-gray-100 text-sm flex items-center before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Usuários</a>
                    </li>

                    <li class="mb-4">
                        <a href="#" class="text-gray-300 hover:text-gray-100 text-sm flex items-center before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Permissões</a>
                    </li>
                </ul>

            </li>

            <li class="mb-1 group">
                <a href="#" class="flex items-center py-2 px-4 text-gray-300 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 sidebar-dropdown-toggle">
                    <i class="ri-tools-line mr-3 text-lg"></i>
                    <span class="text-sm">Configurações</span>
                    <i class="ri-arrow-right-s-line ml-auto group-[.selected]:rotate-90"></i>
                </a>

                <ul class="pl-7 mt-2 hidden group-[.selected]:block">
                    <li class="mb-4">
                        <a href="#" class="text-gray-300 hover:text-gray-100 text-sm flex items-center before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Sistema</a>
                    </li>
                </ul>

            </li>
        </ul>
    </div>

    <script src="{{ asset("assets/js/admin.js") }}"></script>
</body>
</html>