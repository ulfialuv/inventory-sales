<x-app-layout>
    <style>
        .users-page {
            background: #f7f3ed;
            min-height: 100vh;
            padding: 35px 20px;
            color: #302526;
        }

        .users-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .users-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 28px;
            flex-wrap: wrap;
        }

        .users-brand {
            color: #b99556;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .users-title {
            color: #54232b;
            font-size: 30px;
            font-weight: 800;
            margin: 0;
        }

        .users-subtitle {
            color: #78696a;
            font-size: 14px;
            margin-top: 8px;
        }

        .users-btn {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            padding: 12px 20px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: .2s;
        }

        .users-btn-add {
            background: #6b3039;
            color: white;
            border: 1px solid #6b3039;
        }

        .users-btn-add:hover {
            background: #54232b;
            color: white;
        }

        .users-summary {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .users-card {
            background: #fffdf9;
            border: 1px solid #ece2d7;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 4px 15px rgba(84, 35, 43, .04);
        }

        .users-card-label {
            color: #78696a;
            font-size: 13px;
            margin-bottom: 12px;
        }

        .users-card-number {
            color: #54232b;
            font-size: 32px;
            font-weight: 800;
            line-height: 1.2;
        }

        .users-card-note {
            color: #a0958c;
            font-size: 12px;
            margin-top: 10px;
        }

        .users-table-card {
            background: #fffdf9;
            border: 1px solid #ece2d7;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(84, 35, 43, .04);
        }

        .users-table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            padding: 22px 25px;
            border-bottom: 1px solid #ece2d7;
            flex-wrap: wrap;
        }

        .users-table-heading {
            color: #54232b;
            font-size: 18px;
            font-weight: 800;
            margin: 0;
        }

        .users-table-description {
            color: #78696a;
            font-size: 13px;
            margin-top: 6px;
        }

        .users-badge {
            display: inline-block;
            padding: 7px 12px;
            border-radius: 30px;
            background: #f7f0e5;
            color: #8c6a35;
            font-size: 11px;
            font-weight: 700;
        }

        .users-table-wrap {
            width: 100%;
            overflow-x: auto;
        }

        .users-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .users-table thead {
            background: #faf7f2;
        }

        .users-table th {
            color: #78696a;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .7px;
            font-weight: 800;
            padding: 16px 20px;
            white-space: nowrap;
        }

        .users-table td {
            padding: 17px 20px;
            border-top: 1px solid #f0e8df;
            font-size: 13px;
            vertical-align: middle;
        }

        .users-table tbody tr:hover {
            background: #fdfbf8;
        }

        .users-number {
            color: #78696a;
        }

        .users-person {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 175px;
        }

        .users-avatar {
            width: 40px;
            height: 40px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #f2e7df;
            color: #54232b;
            font-weight: 800;
            font-size: 16px;
        }

        .users-person-name {
            color: #302526;
            font-weight: 700;
        }

        .users-email {
            color: #78696a;
        }

        .users-role {
            display: inline-block;
            padding: 7px 12px;
            border-radius: 30px;
            font-size: 11px;
            font-weight: 800;
            white-space: nowrap;
        }

        .role-admin {
            color: #7040a0;
            background: #f3eafa;
        }

        .role-staff {
            color: #245ca8;
            background: #eaf2ff;
        }

        .role-user {
            color: #237647;
            background: #e9f8ef;
        }

        .users-actions {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
        }

        .users-btn-edit,
        .users-btn-delete {
            display: inline-block;
            border-radius: 8px;
            padding: 8px 12px;
            font-size: 11px;
            font-weight: 800;
            text-decoration: none;
            cursor: pointer;
            background: white;
            white-space: nowrap;
        }

        .users-btn-edit {
            border: 1px solid #e6d5bd;
            color: #8c6a35;
        }

        .users-btn-edit:hover {
            background: #f7f0e5;
        }

        .users-btn-delete {
            border: 1px solid #f0caca;
            color: #c03939;
        }

        .users-btn-delete:hover {
            background: #fff0f0;
        }

        .users-empty {
            padding: 45px 20px !important;
            text-align: center;
            color: #78696a;
        }

        .users-pagination {
            padding: 20px 25px;
            border-top: 1px solid #ece2d7;
        }

        .users-back {
            display: inline-block;
            margin-top: 23px;
            color: #6b3039;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
        }

        .users-back:hover {
            color: #b99556;
        }

        .users-alert {
            padding: 14px 18px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .users-alert-success {
            background: #eaf8ef;
            border: 1px solid #c5e8d0;
            color: #237647;
        }

        .users-alert-error {
            background: #fff0f0;
            border: 1px solid #f0caca;
            color: #b42323;
        }

        @media (max-width: 700px) {
            .users-page {
                padding: 25px 12px;
            }

            .users-title {
                font-size: 25px;
            }

            .users-summary {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .users-card {
                padding: 20px;
            }

            .users-table-header {
                padding: 18px;
            }

            .users-table th,
            .users-table td {
                padding: 14px;
            }
        }
    </style>

    <div class="users-page">
        <div class="users-container">

            <div class="users-header">
                <div>
                    <div class="users-brand">Inventory Sales</div>
                    <h1 class="users-title">Manajemen Pengguna</h1>
                    <p class="users-subtitle">
                        Kelola akun dan hak akses pengguna sistem.
                    </p>
                </div>

                <a href="{{ route('users.create') }}" class="users-btn users-btn-add">
                    <span style="font-size:20px;line-height:1">+</span>
                    Tambah Pengguna
                </a>
            </div>

            @if (session('success'))
                <div class="users-alert users-alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="users-alert users-alert-error">
                    {{ session('error') }}
                </div>
            @endif

            <div class="users-summary">
                <div class="users-card">
                    <div class="users-card-label">Total Pengguna</div>
                    <div class="users-card-number">{{ $users->total() }}</div>
                    <div class="users-card-note">Semua akun terdaftar</div>
                </div>

                <div class="users-card">
                    <div class="users-card-label">Admin</div>
                    <div class="users-card-number">
                        {{ \App\Models\User::where('role', 'admin')->count() }}
                    </div>
                    <div class="users-card-note">Pengelola sistem</div>
                </div>

                <div class="users-card">
                    <div class="users-card-label">Staff dan Pembeli</div>
                    <div class="users-card-number">
                        {{ \App\Models\User::whereIn('role', ['staff', 'user'])->count() }}
                    </div>
                    <div class="users-card-note">Pengguna selain admin</div>
                </div>
            </div>

            <div class="users-table-card">
                <div class="users-table-header">
                    <div>
                        <h2 class="users-table-heading">Daftar Pengguna</h2>
                        <p class="users-table-description">
                            Total pengguna pada halaman ini: {{ $users->count() }}
                        </p>
                    </div>

                    <span class="users-badge">DATA AKUN</span>
                </div>

                <div class="users-table-wrap">
                    <table class="users-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th style="text-align:center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td class="users-number">
                                        {{ $users->firstItem() + $loop->index }}
                                    </td>

                                    <td>
                                        <div class="users-person">
                                            <div class="users-avatar">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                            <span class="users-person-name">
                                                {{ $user->name }}
                                            </span>
                                        </div>
                                    </td>

                                    <td class="users-email">{{ $user->email }}</td>

                                    <td>
                                        @if ($user->role === 'admin')
                                            <span class="users-role role-admin">Admin</span>
                                        @elseif ($user->role === 'staff')
                                            <span class="users-role role-staff">Staff</span>
                                        @else
                                            <span class="users-role role-user">Pembeli</span>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="users-actions">
                                            <a href="{{ route('users.edit', $user) }}"
                                               class="users-btn-edit">
                                                Edit
                                            </a>

                                            @if ($user->id !== auth()->id())
                                                <form action="{{ route('users.destroy', $user) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="users-btn-delete">
                                                        Hapus
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="users-empty">
                                        <strong>Belum ada pengguna</strong>
                                        <p style="margin-top:8px">
                                            Klik Tambah Pengguna untuk membuat akun baru.
                                        </p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($users->hasPages())
                    <div class="users-pagination">
                        {{ $users->links() }}
                    </div>
                @endif
            </div>

            <a href="{{ route('admin.dashboard') }}" class="users-back">
                &larr; Kembali ke Dashboard
            </a>

        </div>
    </div>
</x-app-layout>