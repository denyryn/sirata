@extends('layout.layout')

@section('title', 'Dashboard')

@section('content')
    <div>
        <nav class="flex items-center justify-end w-full p-2 font-normal bg-blue-500 h-fit rounded-xl">
            <div class="">
                <form action="{{ route('admin.manage_users.dosen') }}" method="GET"
                    class="flex items-center max-w-sm mx-auto">
                    @csrf
                    @method('GET')

                    <label for="user_search" class="sr-only">Search</label>
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                            <svg class="size-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path
                                        d="M16.6725 16.6412L21 21M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                    </path>
                                </g>
                            </svg>
                        </div>
                        <input type="text" id="user_search" name="user_search"
                            class="bg-gray-50 border-none text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  "
                            placeholder="Cari Dosen" required />
                    </div>
                    <button type="submit" hidden></button>
                </form>
            </div>
        </nav>

        <div class="flex justify-end">
            <!-- Button untuk trigger modals, modals harus diinclude (di bawah) -->
            <button data-modal-target="add-dosen-modal" data-modal-toggle="add-dosen-modal"
                class="m-2 text-white bg-blue-600 btn no-animation hover:bg-blue-700" type="button">
                Tambah Dosen
            </button>
        </div>

        {{-- Pagination --}}
        <div class="my-5">
            {{ $data_dosens->links() }}
        </div>

        {{-- Tabel --}}
        <div class="overflow-auto">
            <table border="1" class="table">
                <thead>
                    <th>ID.</th>
                    <th>NIP</th>
                    <th>NIDN</th>
                    <th>Nama</th>
                    <th>Golongan</th>
                    <th>Aksi</th>
                </thead>
                <tbody class="text-gray-900">
                    @foreach ($data_dosens as $dosen)
                        <tr>
                            <td>
                                {{ $dosen->id_dosen ? $dosen->id_dosen : '-' }}
                            </td>
                            <td>
                                {{ $dosen->nip ? $dosen->nip : '-' }}
                            </td>
                            <td>
                                {{ $dosen->nidn ? $dosen->nidn : '-' }}
                            </td>
                            <td>
                                {{ $dosen->nama_dosen ? strtoupper($dosen->nama_dosen) : '-' }}
                            </td>
                            <td>
                                {{ $dosen->golongan ? $dosen->golongan : '-' }}
                            </td>
                            <td>
                                <a data-modal-target="edit-dosen-modal{{ $dosen->id_dosen }}"
                                    data-modal-toggle="edit-dosen-modal{{ $dosen->id_dosen }}"
                                    class="m-2 text-white bg-blue-600 btn no-animation hover:bg-blue-700" href="#">
                                    Edit
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="my-5">
            {{ $data_dosens->links() }}
        </div>

        {{-- Iterasi supaya modals edit dari semua data dapat keluar --}}
        @foreach ($data_dosens as $dosen)
            @include('admin.users.dosen.modals.edit')
            @include('admin.users.dosen.modals.add')
        @endforeach

    </div>
@endsection

