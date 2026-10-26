 <nav x-data="{ open: false }" class="it-nav">
    @php
        $user = Auth::user();
        $isOwner = $user && $user->isOwner();
        $isAdmin = $user && $user->isAdmin();
        $isUser = $user && !$isOwner && !$isAdmin;
    @endphp

    <style>
        .it-nav {
            --maroon: #3D1025;
            --burgundy: #762D46;
            --text: #F4E9ED;
            --muted: #D7B9C5;
            font-family: 'Figtree', sans-serif;
        }

        .it-sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            z-index: 50;
            display: flex;
            flex-direction: column;
            width: 258px;
            padding: 24px 17px;
            overflow-y: auto;
            background: var(--maroon);
            color: white;
            border-right: 1px solid #633047;
            transition: transform .25s ease;
        }

        .it-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 5px 9px 25px;
            border-bottom: 1px solid #633047;
            color: white;
            text-decoration: none;
        }

        .it-logo {
            display: grid;
            place-items: center;
            width: 43px;
            height: 43px;
            border-radius: 13px;
            background: linear-gradient(135deg, #A64B6A, #762D46);
            font-size: 23px;
            font-weight: 800;
            box-shadow: 0 5px 15px #1b061180;
        }

        .it-brand-name {
            font-size: 19px;
            font-weight: 800;
            letter-spacing: -.5px;
        }

        .it-brand-sub {
            margin-top: 3px;
            color: var(--muted);
            font-size: 9px;
            letter-spacing: 1.4px;
        }

        .it-section {
            margin: 25px 10px 11px;
            color: #C69BAA;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.6px;
        }

        .it-menu {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .it-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 13px;
            color: var(--muted);
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            border: 1px solid transparent;
            border-radius: 10px;
            transition: background .2s, color .2s;
        }

        .it-link:hover {
            color: white;
            background: #581E35;
        }

        .it-link.active {
            color: white;
            background: var(--burgundy);
            border-color: #91445F;
            box-shadow: 0 4px 12px #21081635;
        }

        .it-icon {
            display: grid;
            place-items: center;
            width: 23px;
            font-size: 17px;
        }

        .it-bottom {
            margin-top: auto;
            padding-top: 20px;
        }

        .it-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 12px;
            padding: 12px 9px;
            border: 1px solid #633047;
            background: #50172F;
            border-radius: 12px;
        }

        .it-avatar {
            display: grid;
            place-items: center;
            flex-shrink: 0;
            width: 39px;
            height: 39px;
            color: white;
            font-weight: 800;
            background: #8B3654;
            border-radius: 11px;
        }

        .it-profile-info {
            flex: 1;
            min-width: 0;
        }

        .it-name {
            overflow: hidden;
            color: white;
            font-size: 12px;
            font-weight: 700;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .it-role {
            margin-top: 4px;
            color: #E8B7C7;
            font-size: 9px;
            font-weight: 700;
            letter-spacing: .8px;
        }

        .it-logout {
            width: 100%;
            margin-top: 9px;
            padding: 11px 12px;
            color: #F0B7C5;
            background: transparent;
            border: 0;
            border-radius: 9px;
            text-align: left;
            font-size: 12px;
            cursor: pointer;
        }

        .it-logout:hover {
            background: #581E35;
        }

        .it-toggle {
            display: none;
        }

        @media (min-width: 769px) {
            body:has(.it-sidebar) main {
                margin-left: 258px;
            }

            body:has(.it-sidebar) > div > header {
                margin-left: 258px;
            }
        }

        @media (max-width: 768px) {
            .it-sidebar {
                transform: translateX(-100%);
            }

            .it-sidebar.it-open {
                transform: translateX(0);
            }

            .it-toggle {
                position: fixed;
                top: 12px;
                left: 12px;
                z-index: 70;
                display: block;
                padding: 10px 13px;
                color: white;
                background: var(--maroon);
                border: 1px solid #8B3654;
                border-radius: 9px;
            }

            .it-overlay {
                position: fixed;
                inset: 0;
                z-index: 40;
                background: #0008;
            }

            body:has(.it-sidebar) main {
                margin-left: 0;
                padding-top: 55px;
            }

            body:has(.it-sidebar) > div > header {
                margin-left: 0;
                padding-top: 45px;
            }
        }
    </style>

    <button type="button" class="it-toggle" @click="open = !open">
        ☰ Menu
    </button>

    <div
        x-cloak
        x-show="open"
        class="it-overlay"
        @click="open = false"
    ></div>

    <aside class="it-sidebar" :class="{ 'it-open': open }">
        <a href="{{ route('dashboard') }}" class="it-brand">
            <div class="it-logo">I</div>
            <div>
                <div class="it-brand-name">InvenTrack</div>
                <div class="it-brand-sub">INVENTORY MANAGEMENT</div>
            </div>
        </a>

        <div class="it-section">Main Menu</div>

        <nav class="it-menu">
            <a href="{{ route('dashboard') }}"
               class="it-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
               @click="open = false">
                <span class="it-icon">▦</span> Overview
            </a>

            @if ($isOwner || $isAdmin)
                <div class="it-section">Inventory</div>

                <a href="{{ route('categories.index') }}"
                   class="it-link {{ request()->routeIs('categories.*') ? 'active' : '' }}"
                   @click="open = false">
                    <span class="it-icon">▤</span> Kategori
                </a>
            @endif

            @if ($isOwner)
                <a href="{{ route('products.index') }}"
                   class="it-link {{ request()->routeIs('products.*') ? 'active' : '' }}"
                   @click="open = false">
                    <span class="it-icon">▣</span> Manajemen Produk
                </a>

                <a href="{{ route('suppliers.index') }}"
                   class="it-link {{ request()->routeIs('suppliers.*') ? 'active' : '' }}"
                   @click="open = false">
                    <span class="it-icon">♙</span> Supplier
                </a>
            @elseif ($isUser)
                <a href="{{ route('products.index') }}"
                   class="it-link {{ request()->routeIs('products.*') ? 'active' : '' }}"
                   @click="open = false">
                    <span class="it-icon">▣</span> Katalog Produk
                </a>
            @endif

            @if ($isOwner || $isAdmin)
                <div class="it-section">Operations</div>

                <a href="{{ route('purchases.index') }}"
                   class="it-link {{ request()->routeIs('purchases.*') ? 'active' : '' }}"
                   @click="open = false">
                    <span class="it-icon">↙</span> Stok Masuk
                </a>
            @endif

            <a href="{{ route('sales.index') }}"
               class="it-link {{ request()->routeIs('sales.*') ? 'active' : '' }}"
               @click="open = false">
                <span class="it-icon">↗</span>
                {{ $isUser ? 'Penjualan Saya' : 'Penjualan' }}
            </a>
        </nav>

        <div class="it-bottom">
            <div class="it-section">Account</div>

            @if (Route::has('profile.edit'))
                <a href="{{ route('profile.edit') }}"
                   class="it-link {{ request()->routeIs('profile.*') ? 'active' : '' }}"
                   @click="open = false">
                    <span class="it-icon">⚙</span> Profil Saya
                </a>
            @endif

            <div class="it-profile">
                <div class="it-avatar">
                    {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                </div>
                <div class="it-profile-info">
                    <div class="it-name">{{ $user->name ?? 'Pengguna' }}</div>
                    <div class="it-role">
                        {{ $isOwner ? 'OWNER' : ($isAdmin ? 'ADMIN / STAFF' : 'USER') }}
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="it-logout">
                    ↪ &nbsp; Keluar dari akun
                </button>
            </form>
        </div>
    </aside>
</nav>
