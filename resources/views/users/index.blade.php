<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pengguna | Ranitha Stuff</title>

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            background: #f7f3ed;
            color: #302526;
        }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            width: 225px;
            padding: 28px 18px;
            background: #54232b;
            color: white;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 11px;
            margin-bottom: 36px;
        }

        .brand-icon {
            display: grid;
            place-items: center;
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: #b99556;
            color: #54232b;
            font-weight: bold;
            font-size: 20px;
        }

        .brand h2 { margin: 0; font-size: 17px; }
        .brand small { color: #d9c5c1; font-size: 11px; }

        .nav-title {
            margin: 24px 10px 10px;
            color: #c6a9a7;
            font-size: 10px;
            letter-spacing: 1.5px;
        }

        .sidebar a {
            display: flex;
            gap: 12px;
            padding: 12px;
            margin-bottom: 5px;
            border-radius: 9px;
            color: #f2e8e5;
            text-decoration: none;
            font-size: 13px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #78404a;
        }

        .nav-icon {
            width: 20px;
            text-align: center;
        }

        .logout {
            position: absolute;
            right: 18px;
            bottom: 22px;
            left: 18px;
        }

        .logout button {
            width: 100%;
            padding: 11px;
            border: 1px solid #80525a;
            border-radius: 9px;
            background: transparent;
            color: white;
            cursor: pointer;
        }

        /* KONTEN UTAMA */
        .main {
            max-width: 1600px;
            margin-left: 225px;
            padding: 30px 34px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
        }

        .eyebrow {
            color: #9b7a48;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        h1 {
            margin: 6px 0;
            font-family: Georgia, serif;
            font-size: 29px;
            font-weight: normal;
        }

        .muted {
            color: #8a7d79;
            font-size: 12px;
        }

        .button {
            display: inline-block;
            padding: 11px 15px;
            border: 0;
            border-radius: 8px;
            background: #6b3039;
            color: white;
            text-decoration: none;
            font-size: 12px;
            cursor: pointer;
            text-align: center;
        }

        .button:hover {
            background: #54232b;
        }

        .notice {
            padding: 13px 16px;
            margin-bottom: 16px;
            border-radius: 9px;
            background: #e8f4e8;
            color: #286338;
            font-size: 13px;
        }

        .notice-error {
            background: #f9e6e3;
            color: #a13f38;
        }

        .table-panel {
            padding: 20px;
            border: 1px solid #ece2d7;
            border-radius: 13px;
            background: #fffdf9;
        }

        .table-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            margin-bottom: 16px;
        }

        .table-heading h3 {
            margin: 0;
            font-size: 15px;
        }

        .total-badge {
            display: inline-block;
            padding: 7px 10px;
            border-radius: 20px;
            background: #f1e6d7;
            color: #6b3039;
            font-size: 11px;
        }

        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            white-space: nowrap;
        }

        th {
            padding: 13px 12px;
            background: #f5eee5;
            color: #6d5552;
            text-align: left;
            font-size: 11px;
            font-weight: 600;
        }

        td {
            padding: 14px 12px;
            border-bottom: 1px solid #f0e8df;
            font-size: 12px;
        }

        tbody tr:hover {
            background: #fcf8f2;
        }

        .user-name {
            color: #54232b;
            font-weight: 600;
        }

        .user-email {
            color: #6d5552;
        }

        .role {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 20px;
            font-size: 11px;
            text-transform: capitalize;
        }

        .role-admin {
            background: #f1e6d7;
            color: #795b2d;
        }

        .role-staff {
            background: #e4edf8;
            color: #345a80;
        }

        .role-user {
            background: #e7f3e7;
            color: #347044;
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .actions form {
            margin: 0;
        }

        .action-edit,
        .action-delete {
            padding: 7px 9px;
            border: 0;
            border-radius: 6px;
            text-decoration: none;
            font-size: 11px;
            cursor: pointer;
        }

        .action-edit {
            background: #f1e6d7;
            color: #6b3039;
        }

        .action-delete {
            background: #f9e6e3;
            color: #a13f38;
        }

        .empty {
            padding: 30px;
            color: #8a7d79;
            text-align: center;
        }

        .pagination {
            padding-top: 18px;
        }

        .pagination nav > div:first-child {
            margin-bottom: 10px;
            color: #8a7d79;
            font-size: 12px;
        }

        .pagination nav > div:last-child {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
        }

        .pagination a,
        .pagination span {
            display: inline-block;
            padding: 7px 11px;
            border: 1px solid #e4d8cc;
            border-radius: 6px;
            color: #54232b;
            text-decoration: none;
            font-size: 12px;
        }

        .pagination [aria-current="page"] span {
            background: #6b3039;
            color: white;
            border-color: #6b3039;
        }

        .footer {
            margin-top: 22px;
            color: #8a7d79;
            text-align: center;
            font-size: 11px;
        }

        @media (max-width: 950px) {
            .sidebar {
                width: 190px;
            }

            .main {
                margin-left: 190px;
                padding: 22px;
            }
        }

        @media (max-width: 600px) {
            .sidebar {
                position: static;
                width: 100%;
                height: auto;
            }

            .sidebar .nav-title {
                margin-top: 15px;
            }

            .logout {
                position: static;
                margin-top: 15px;
            }

            .main {
                margin-left: 0;
                padding: 18px;
            }

            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .table-panel {
                padding: 14px;
            }

            .table-heading {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

    <aside class="sidebar">
        <div class="brand">
            <div class="brand-icon">R</div>
            <div>
                <h2>Ranitha Stuff</h2>
                <small>Skincare &amp; Beauty Store</small>
            </div>
        </div>

        <div class="nav-title">MENU UTAMA</div>

        <a href="{{ route('admin.dashboard') }}">
            <span class="nav-icon">⌂</span> Dashboard
        </a>

        <a href="{{ route('products.index') }}">
            <span class="nav-icon">▦</span> Data Produk
        </a>

        <a href="{{ route('categories.index') }}">
            <span class="nav-icon">▤</span> Kategori
        </a>

        <a href="{{ route('suppliers.index') }}">
            <span class="nav-icon">♙</span> Pemasok
        </a>

        <div class="nav-title">TRANSAKSI</div>

        <a href="{{ route('purchases.index') }}">
            <span class="nav-icon">↓</span> Pembelian
        </a>

        <a href="{{ route('sales.index') }}">
            <span class="nav-icon">↑</span> Penjualan
        </a>

        <div class="nav-title">LAINNYA</div>

        <a href="{{ route('users.index') }}" class="active">
            <span class="nav-icon">♧</span> Pengguna
        </a>

        <a href="{{ route('reports.index') }}">
            <span class="nav-icon">▥</span> Laporan
        </a>

        <form class="logout" method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">↪ &nbsp; Keluar dari akun</button>
        </form>
    </aside>

    <main class="main">

        <div class="topbar">
            <div>
                <div class="eyebrow">Ranitha Stuff</div>
                <h1>Manajemen Pengguna</h1>
                <div class="muted">
                    Kelola akun dan hak akses pengguna toko skincare dan beauty.
                </div>
            </div>

            <a class="button" href="{{ route('users.create') }}">
                + Tambah Pengguna
            </a>
        </div>

        @if(session('success'))
            <div class="notice">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="notice notice-error">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="notice notice-error">
                <strong>Terjadi kesalahan:</strong>
                <ul style="margin: 8px 0 0 18px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="table-panel">
            <div class="table-heading">
                <h3>Daftar Pengguna</h3>

                <span class="total-badge">
                    Total {{ $users->total() }} pengguna
                </span>
            </div>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Pengguna</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>
                                    {{ $users->firstItem() + $loop->index }}
                                </td>

                                <td class="user-name">
                                    {{ $user->name }}
                                </td>

                                <td class="user-email">
                                    {{ $user->email }}
                                </td>

                                <td>
                                    <span class="role role-{{ $user->role }}">
                                        {{ $user->role }}
                                    </span>
                                </td>

                                <td>
                                    <div class="actions">
                                        <a
                                            href="{{ route('users.edit', $user) }}"
                                            class="action-edit"
                                        >
                                            Edit
                                        </a>

                                        @if($user->id !== auth()->id())
                                            <form
                                                method="POST"
                                                action="{{ route('users.destroy', $user) }}"
                                                onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')"
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="action-delete"
                                                >
                                                    Hapus
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="empty">
                                    Belum ada pengguna yang terdaftar.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($users->hasPages())
                <div class="pagination">
                    {{ $users->links() }}
                </div>
            @endif
        </section>

        <div class="footer">
            Ranitha Stuff &copy; {{ date('Y') }}
        </div>

    </main>

</body>
</html>