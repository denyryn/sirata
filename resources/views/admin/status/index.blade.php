@extends('layout.layout')

@section('title', 'Dashboard')

@section('content')
    <div>
        <div class="flex justify-end">
            <!-- Button untuk trigger modals, modals harus diinclude (di bawah) -->
            <button data-modal-target="add-status-modal" data-modal-toggle="add-status-modal"
                class="m-2 text-white bg-blue-600 btn no-animation hover:bg-blue-700" type="button">
                Tambah Status
            </button>
        </div>

        {{-- Menampilkan Data Program Studi --}}
        <table class="table text-black table-zebra">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if ($data_status->isEmpty())
                    <tr>
                        <td colspan="2">No data available.</td>
                    </tr>
                @else
                    @foreach ($data_status as $status)
                        <tr>
                            <td>{{ $status->id_status }}</td>
                            <td>{{ $status->nama_status }}</td>
                            <form class="w-full" method="POST" action="{{ route('status.delete', $status->id_status) }}">
                                @csrf
                                @method('DELETE')

                                <td class="grid grid-cols-2">

                                    <a data-modal-target="edit-status-modal{{ $status->id_status }}"
                                        data-modal-toggle="edit-status-modal{{ $status->id_status }}"
                                        class="m-2 text-white bg-blue-600 btn no-animation hover:bg-blue-700"
                                        href="#">
                                        Edit
                                    </a>

                                    <button type="submit"
                                        class="m-2 text-white bg-red-600 btn no-animation hover:bg-red-700"
                                        onclick="return confirm('Confirm delete?')">Delete</button>
                                </td>
                            </form>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    {{-- Include modals supaya form popup keluar --}}
    @include('admin.status.modals.create')

    {{-- Iterasi supaya modals edit dari semua data dapat keluar --}}
    @foreach ($data_status as $status)
        @include('admin.status.modals.edit')
    @endforeach

@endsection
