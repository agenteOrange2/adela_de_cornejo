@php
    // Asegúrate de que obtienes correctamente el ID del plantel desde el parámetro de la ruta

    $currentPlantelId = request()->route('plantel_id'); // Verifica que 'plantel_id' sea el nombre correcto del parámetro

    // Ahora define el arreglo de links
    $links = [
        [
            'name' => 'Dashboard',
            'url' => route('admin.dashboard'),
            'isActive' => request()->routeIs('admin.dashboard'),
            'icon' => 'fa-solid fa-chart-line',
            'can' => ['Dashboard'],
        ],
        [
            'name' => 'Planteles', // Título de la sección
            'url' => '#',
            'isActive' => false, // Nunca está activo ya que es solo un título
            'isTitle' => true, // Añadir una bandera para identificar que esto es un título
            'icon' => 'fa-solid fa-landmark',
            'can' => ['Planteles'],
        ],
        [
            'name' => 'Plantel IV Siglos',
            'url' => '#',
            'icon' => 'fa-solid fa-building',
            'isActive' => $currentPlantelId == 1,
            'can' => ['Planteles'],
            'sublinks' => [
                [
                    'name' => 'Información',
                    'url' => route('admin.planteles.show', ['plantel' => 1]),
                    'icon' => 'fa-solid fa-info-circle',
                    'isActive' => request()->routeIs('admin.planteles.show', ['plantel' => 1]),
                ],
                // Más subsublinks si es necesario
            ],
        ],
        [
            'name' => 'Plantel Triunfo',
            'url' => '#',
            'icon' => 'fa-solid fa-building',
            'isActive' => $currentPlantelId == 2,
            'can' => ['Planteles'],
            'sublinks' => [
                [
                    'name' => 'Información',
                    'url' => route('admin.planteles.show', ['plantel' => 2]),
                    'icon' => 'fa-solid fa-info-circle',
                    'isActive' => request()->routeIs('admin.planteles.show', ['plantel' => 2]),
                ],
                // Más subsublinks si es necesario
            ],
        ],
        [
            'name' => 'Oferta Académica', // Título de la sección
            'url' => '#',
            'isActive' => false, // Nunca está activo ya que es solo un título
            'isTitle' => true, // Añadir una bandera para identificar que esto es un título
            'icon' => 'fa-solid fa-landmark',
            'can' => ['Oferta Académica'],
        ],
        [
            'name' => 'Ciclo Escolar',
            'url' => '#',
            'icon' => 'fa-solid fa-graduation-cap',
            'can' => ['Oferta Académica'],
            'sublinks' => [
                [
                    'name' => 'Ciclo Escolar',
                    'url' => route('admin.ciclo-escolar.index'),
                    'icon' => 'fa-solid fa-calendar-days',
                    'can' => ['Oferta Académica'],
                    'isActive' => request()->routeIs('admin.ciclo-escolar.index'),
                ],
                [
                    'name' => 'Calendario Escolar',
                    'url' => route('admin.calendarios.index'),
                    'icon' => 'fa-solid fa-calendar-days',
                    'can' => ['Oferta Académica'],
                    'isActive' => request()->routeIs('admin.calendarios.*'),
                ],
            ],
        ],

        [
            'name' => 'Servicios', // Título de la sección
            'url' => '#',
            'isActive' => false, // Nunca está activo ya que es solo un título
            'isTitle' => true, // Añadir una bandera para identificar que esto es un título
            'icon' => 'fa-solid fa-landmark',
            'can' => ['Servicios'],
        ],

        [
            'name' => 'Servicios',
            'url' => '#',
            'icon' => 'fa-solid fa-clipboard-check',
            'can' => ['Servicios'],
            'sublinks' => [
                [
                    'name' => 'Menú Escolar',
                    'url' => route('admin.menu-cafeteria.index'),
                    'icon' => 'fa-solid fa-apple-whole',
                    'can' => ['Servicios'],
                    'isActive' => request()->routeIs('admin.menu-cafeteria.index'),
                ],
            ],
        ],
        [
            'name' => 'Eventos y Avisos', // Título de la sección
            'url' => '#',
            'isActive' => false, // Nunca está activo ya que es solo un título
            'isTitle' => true, // Añadir una bandera para identificar que esto es un título
            'icon' => 'fa-solid fa-landmark',
            'can' => ['Eventos y Avisos'],
        ],
        [
            'name' => 'Eventos',
            'url' => '#',
            'icon' => 'fa-solid fa-calendar-days',
            'can' => ['Eventos y Avisos'],
            'isActive' => request()->routeIs('admin.eventos.*'),
            'sublinks' => [
                [
                    'name' => 'Categorías',
                    'url' => route('admin.categories-eventos.index'),
                    'icon' => 'fa-solid fa-list',
                    'can' => ['Eventos y Avisos'],
                    'isActive' => request()->routeIs('admin.eventcategories.*'),
                ],
                [
                    'name' => 'Eventos',
                    'url' => route('admin.eventos.index'),
                    'icon' => 'fa-regular fa-calendar-check',
                    'can' => ['Eventos y Avisos'],
                    'isActive' => request()->routeIs('admin.events.*'),
                ],
                // Más subsublinks si es necesario
            ],
        ],
        [
            'name' => 'Avisos',
            'url' => '#',
            'icon' => 'fa-regular fa-newspaper',
            'can' => ['Eventos y Avisos'],
            'isActive' => request()->routeIs('admin.avisos.*'),
            'sublinks' => [
                [
                    'name' => 'Categorías',
                    'url' => route('admin.categories-avisos.index'),
                    'icon' => 'fa-solid fa-list',
                    'can' => ['Eventos y Avisos'],
                    'isActive' => request()->routeIs('admin.postcategories.*'),
                ],
                [
                    'name' => 'Avisos',
                    'url' => route('admin.avisos.index'),
                    'icon' => 'fa-solid fa-file-signature',
                    'can' => ['Eventos y Avisos'],
                    'isActive' => request()->routeIs('admin.avisos.*'),
                ],
                // Más subsublinks si es necesario
            ],
        ],
        [
            'name' => 'Sliders', // Título de la sección
            'url' => '#',
            'isActive' => false, // Nunca está activo ya que es solo un título
            'isTitle' => true, // Añadir una bandera para identificar que esto es un título
            'can' => ['Sliders'],
        ],

        [
            'name' => 'Sliders',
            'url' => route('admin.sliders.index'),
            'isActive' => request()->routeIs('admin.sliders.index'),
            'icon' => 'fa-regular fa-images',
            'can' => ['Sliders'],
        ],

        [
            'name' => 'Ajustes de la cuenta', // Título de la sección
            'url' => '#',
            'isActive' => false, // Nunca está activo ya que es solo un título
            'isTitle' => true, // Añadir una bandera para identificar que esto es un título
            'icon' => 'fa-solid fa-landmark',
            'can' => ['Usuarios'],
        ],

        [
            'name' => 'Usuarios',
            'url' => '#',
            'icon' => 'fa-solid fa-user-gear',
            'can' => ['Usuarios'],
            'sublinks' => [
                [
                    'name' => 'Roles',
                    'url' => route('admin.roles.index'),
                    'icon' => 'fa-solid fa-unlock-keyhole',
                    'can' => ['Roles'],
                    'isActive' => request()->routeIs('admin.roles.*'),
                ],
                [
                    'name' => 'Permisos',
                    'url' => route('admin.permissions.index'),
                    'icon' => 'fa-solid fa-user-shield',
                    'can' => ['Permisos'],
                    'isActive' => request()->routeIs('admin.permissions.*'),
                ],
                [
                    'name' => 'usuarios',
                    'url' => route('admin.users.index'),
                    'icon' => 'fa-solid fa-user-shield',
                    'can' => ['Usuarios'],
                    'isActive' => request()->routeIs('admin.users.*'),
                ],
                // Más subsublinks si es necesario
            ],
        ],

        // ... tus otros enlaces ...
    ];
@endphp


<!-- Sidebar -->
<aside id="logo-sidebar"
    class="fixed mt-14 top-0 left-0 z-40 w-64 h-screen pt-5 transition-transform transform bg-school-blue border-r border-gray-200 dark:border-gray-700 lg:translate-x-0"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:-translate-x-full lg:w-64 lg:translate-x-0'"
    aria-label="Sidebar">
    <div class="custom-scrollbar h-full px-1 pb-4 overflow-y-auto">
        @foreach ($links as $key => $link)
            @canany($link['can'] ?? [null])
                <div class="">
                    @if (isset($link['isTitle']) && $link['isTitle'])
                        <div class="p-2 text-sm  font-bold text-gray-300 border-b border-gray-400 pb-2 mb-2">
                            <span class="ml-3 text-sm text-gray-200 dark:text-white">{{ $link['name'] }}</span>
                        </div>
                    @elseif (isset($link['sublinks']))
                        <a href="{{ $link['url'] }}"
                            class="menu-link flex items-center p-2 text-sm  rounded-lg text-gray-200 dark:text-white hover:bg-blue-700 dark:hover:bg-blue-700 mb-3 {{ data_get($link, 'isActive') ? 'bg-blue-700' : '' }}"
                            id="menu-link-{{ $key }}" data-submenu-id="{{ $key }}">
                            <i class="{{ $link['icon'] }}"></i>
                            <span class="ml-3">{{ $link['name'] }}</span>
                            <span class="ml-auto dropdown-indicator">
                                <svg class="w-3 h-3" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </span>
                        </a>
                        <div class="ml-4 overflow-hidden transition-all duration-500 max-h-0"
                            id="submenu-{{ $key }}">
                            @foreach ($link['sublinks'] as $sublink)
                                <a href="{{ $sublink['url'] }}"
                                    class="mb-2 block p-2 text-sm font-normal rounded-lg text-gray-200 dark:text-white dark:hover:bg-blue-700 {{ data_get($sublink, 'isActive') ? 'bg-blue-700' : '' }}">
                                    <i class="{{ $sublink['icon'] }}"></i> {{ $sublink['name'] }}
                                </a>
                            @endforeach
                        </div>
                    @else
                        <a href="{{ $link['url'] }}"
                            class="flex items-center p-2 text-sm font-normal  rounded-lg text-gray-200 dark:text-white hover:bg-blue-700 dark:hover:bg-blue-700 {{ data_get($link, 'isActive') ? 'bg-blue-700' : '' }}">
                            <i class="{{ $link['icon'] }}"></i>
                            <span class="ml-3">{{ $link['name'] }}</span>
                        </a>
                    @endif
                </div>
            @endcan
        @endforeach
    </div>
</aside>
