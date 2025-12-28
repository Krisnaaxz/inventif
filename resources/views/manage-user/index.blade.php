@extends('layouts.main')
@section('page_title', $pageTitle)
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-end align-items-center">
                        <x-manage-user.form-user action="{{ route('manage-user.store') }}" />
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 15px">No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th class="text-center" style="width: 200px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($users as $index => $user)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <span
                                                    class="badge
                                                @if ($user->role == 'admin') badge-danger
                                                @elseif($user->role == 'organisasi') badge-warning
                                                @else badge-info @endif">
                                                    {{ ucfirst($user->role) }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <x-manage-user.form-user id="{{ $user->id }}"
                                                        action="{{ route('manage-user.update', ['manage_user' => $user->id]) }}"
                                                        name="{{ $user->name }}" email="{{ $user->email }}"
                                                        role="{{ $user->role }}" />
                                                    <x-confirm-delete id="{{ $user->id }}"
                                                        route="manage-user.destroy" />
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Belum ada user.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
