<div class="align-items-center row shadow" style="height: 64px;">
    <div id="toggle" class="active position toggle-menu">
        <div class="pointer text-end" onclick="toggleNavigation()">
            <i class="fas fa-bars"></i>
        </div>
    </div>
    <div class="align-items-center col justify-content-end px-0 row" style="z-index: -1;">
        <div class="align-items-center cerita-kopi-color icon-user justify-content-center px-0 row"><i class="fas fa-user text-white"></i></i></div>
    </div>
    <div class="col-auto col-form-label dropdown fw-bold text-secondary">
        <button class="bg-white border-0 shadow-none" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
            {{auth()->user()->name}}
        </button>
        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
            {{-- <li><hr class="dropdown-divider"></li> --}}
            <li><a class="dropdown-item" href="/logout">Logout</a></li>
        </ul>
    </div>
</div>