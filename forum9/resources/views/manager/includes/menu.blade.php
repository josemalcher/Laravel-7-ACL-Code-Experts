<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light collapse">
    <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">

            @foreach(auth()->user()->role->resources()->where('is_menu', true)->get() as $resource)
            <li class="nav-item">
                <a class="nav-link @if(request()->is('manager/users*')) active @endif" href="{{route($resource->resource)}}">
                    <span data-feather="file"></span>
                    {{$resource->name}}
                </a>
            </li>
            @endforeach


<!--            <li class="nav-item">
                <a class="nav-link @if(request()->is('manager/users*')) active @endif" href="{{route('users.index')}}">
                    <span data-feather="file"></span>
                    Usuários
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link @if(request()->is('manager/roles*')) active @endif" href="{{route('roles.index')}}">
                    <span data-feather="home"></span>
                    Papéis <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(request()->is('manager/resources*')) active @endif" href="{{route('resources.index')}}">
                    <span data-feather="file"></span>
                    Recursos
                </a>
            </li>-->
        </ul>
    </div>
</nav>
