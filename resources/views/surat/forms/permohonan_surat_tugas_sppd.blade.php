@extends('layout.layout')

@section('title', 'Layanan')
@section('header', 'Sirata / Layanan Surat')

@section('content')
    <div class="grid grid-cols-12">
        <form id="surat_form" action="{{ route(Session::get('akses') . '.surat.form.store') }}" method="POST"
            enctype="multipart/form-data" class="grid w-1/2 min-w-full col-start-1 col-end-6 grid-">
            @csrf
            @method('POST')

            <input type="number" id="id_kategori_surat" name="id_kategori_surat" hidden
                value="{{ $data_perihal->id_kategori_surat }}" />

            <div class="mb-5">
                <label for="id_user1" class="block mb-2 text-sm font-medium text-gray-900 ">
                    Pengaju
                </label>
                <div class="flex flex-row items-end w-full">
                    <div id="pengajuContainer" class="flex flex-col w-full">
                        <div name="pemohon1"
                            class="mb-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 p-2.5">
                            @if (Session::get('akses') == 'dosen')
                                <select
                                    class="id_user bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mt-1"
                                    name="id_user1" id="id_user1" required>
                                    <option value="">Pilih Pengaju Utama</option>
                                    @foreach ($dosens as $dosen)
                                        <option value="{{ $dosen->id_user }}"
                                            {{ $dosen->id_user == $user_sekarang->id_user ? 'selected' : 'hidden' }}>
                                            {{ $dosen->nama_dosen }}
                                        </option>
                                    @endforeach
                                </select>
                            @else
                                <select
                                    class="id_user bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mt-1"
                                    name="id_user1" id="id_user1" required>
                                    <option value="">Pilih Pengaju Utama</option>
                                    @foreach ($dosens as $dosen)
                                        <option value="{{ $dosen->id_user }}">
                                            {{ $dosen->nama_dosen }}
                                        </option>
                                    @endforeach
                                </select>
                            @endif
                        </div>

                    </div>
                    <button class="mb-2 ml-1 text-xl text-white btn bg-blue-light hover:bg-blue-plain" type="button"
                        id="removePengajuBtn"> - </button>
                    <button class="mb-2 ml-1 text-xl text-white btn bg-blue-light hover:bg-blue-plain" type="button"
                        id="addPengajuBtn"> + </button>
                </div>
            </div>

            <div class="mb-5">
                <label for="id_jabatan" class="block mb-2 text-sm font-medium text-gray-900 ">
                    Ditujukan Kepada
                </label>
                <select
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mt-1"
                    name="id_jabatan" id="id_jabatan" required>
                    <option value="">Pilih Jabatan yang dituju</option>
                    @foreach ($jabatans as $jabatan)
                        <option value="{{ $jabatan->id_jabatan }}">
                            {{ $jabatan->nama_jabatan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-5">
                <label for="nama_perihal" class="block mb-2 text-sm font-medium text-gray-900 ">
                    Nama Perihal
                </label>
                <input type="text"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    id="perihal" name="nama_perihal" placeholder="Masukkan Nama Perihal" required
                    oninput="updateContent()" value="{{ $data_perihal->nama_perihal }}" />
            </div>

            <div class="mb-5">
                <label for="nama_tujuan" class="block mb-2 text-sm font-medium text-gray-900">
                    Nama Tujuan
                </label>
                <textarea
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    id="nama_tujuan" name="nama_tujuan" cols="30" rows="2" placeholder="Masukkan Nama Tujuan"
                    oninput="updateContent()" required>{{ $data_perihal->nama_tujuan }}</textarea>
            </div>

            <div class="mb-5">
                <label for="alamat_tujuan" class="block mb-2 text-sm font-medium text-gray-900">
                    Alamat Tujuan
                </label>
                <textarea
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    id="alamat_tujuan" name="alamat_tujuan" cols="30" rows="2" placeholder="Masukkan Alamat Tujuan"
                    oninput="updateContent()" required>{{ $data_perihal->alamat_tujuan }}</textarea>
            </div>
            <div class="mb-5">
                <label for="hormat" class="block mb-2 text-sm font-medium text-gray-900">
                    Hormat
                </label>
                <textarea
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    id="hormat" name="hormat" cols="30" rows="3" placeholder="Masukkan Upper Body 1"
                    oninput="updateContent()" required>
                </textarea>
            </div>

            <div class="flex flex-row items-center justify-start w-full">
                <div class="w-1/3 mb-5">
                    <label for="tanggal_mulai" class="block mb-2 text-sm font-medium text-gray-900">
                        Tanggal Mulai
                    </label>
                    <input type="date"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        id="tanggal_mulai" name="tanggal_mulai" oninput="updateContent()" required>
                </div>
                <span class="text-black"> &nbsp; s.d &nbsp; </span>
                <div class="w-1/3 mb-5">
                    <label for="tanggal_selesai" class="block mb-2 text-sm font-medium text-gray-900">
                        Tanggal Selesai
                    </label>
                    <input type="date"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        id="tanggal_selesai" name="tanggal_selesai" oninput="updateContent()" required>
                </div>
            </div>

            <div class="mb-5">
                <label for="tempat" class="block mb-2 text-sm font-medium text-gray-900">
                    Tempat
                </label>
                <input type="text"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    id="tempat" name="tempat" oninput="updateContent()" required>
            </div>

            <div class="mb-5">
                <label for="maksud" class="block mb-2 text-sm font-medium text-gray-900">
                    Maksud
                </label>
                <textarea
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    id="maksud" name="maksud" cols="30" rows="3" placeholder="Masukkan Upper Body 2"
                    oninput="updateContent()" required>
                </textarea>
            </div>

            <div class="mb-5">
                <label for="lower_body" class="block mb-2 text-sm font-medium text-gray-900">
                    Lower Body
                </label>
                <textarea
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    id="lower_body" name="lower_body" cols="30" rows="2" placeholder="Masukkan Lower Body"
                    oninput="updateContent()">{{ old('lower_body', $data_perihal->lower_body) }}</textarea>
            </div>

            <div class="mb-5">
                <label for="lampiran" class="block mb-2 text-sm font-medium text-gray-900">
                    lampiran
                </label>
                <input
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    type="file" accept="application/pdf" name="lampiran" id="lampiran">
            </div>

            <div>
                <textarea hidden id="upper_body" name="upper_body"></textarea>
            </div>

            <button type="submit" onmouseover="updateContent()"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
        </form>
        <div class="col-start-7 col-end-13 p-2 rounded-[1rem] shadow-xl bg-blue-lighter">
            <button class="p-1 bg-white rounded-[0.5rem] " onclick="zoomIn()">
                <svg class="text-gray-700 size-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M4 11C4 7.13401 7.13401 4 11 4C14.866 4 18 7.13401 18 11C18 14.866 14.866 18 11 18C7.13401 18 4 14.866 4 11ZM11 2C6.02944 2 2 6.02944 2 11C2 15.9706 6.02944 20 11 20C13.125 20 15.078 19.2635 16.6177 18.0319L20.2929 21.7071C20.6834 22.0976 21.3166 22.0976 21.7071 21.7071C22.0976 21.3166 22.0976 20.6834 21.7071 20.2929L18.0319 16.6177C19.2635 15.078 20 13.125 20 11C20 6.02944 15.9706 2 11 2Z"
                            fill="currentColor"></path>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M10 14C10 14.5523 10.4477 15 11 15C11.5523 15 12 14.5523 12 14V12H14C14.5523 12 15 11.5523 15 11C15 10.4477 14.5523 10 14 10H12V8C12 7.44772 11.5523 7 11 7C10.4477 7 10 7.44772 10 8V10H8C7.44772 10 7 10.4477 7 11C7 11.5523 7.44772 12 8 12H10V14Z"
                            fill="currentColor"></path>
                    </g>
                </svg>
            </button>
            <button class="p-1 bg-white rounded-[0.5rem] " onclick="zoomOut()">
                <svg class="text-gray-700 size-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M4 11C4 7.13401 7.13401 4 11 4C14.866 4 18 7.13401 18 11C18 14.866 14.866 18 11 18C7.13401 18 4 14.866 4 11ZM11 2C6.02944 2 2 6.02944 2 11C2 15.9706 6.02944 20 11 20C13.125 20 15.078 19.2635 16.6177 18.0319L20.2929 21.7071C20.6834 22.0976 21.3166 22.0976 21.7071 21.7071C22.0976 21.3166 22.0976 20.6834 21.7071 20.2929L18.0319 16.6177C19.2635 15.078 20 13.125 20 11C20 6.02944 15.9706 2 11 2Z"
                            fill="currentColor"></path>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M7 11C7 10.4477 7.44772 10 8 10H14C14.5523 10 15 10.4477 15 11C15 11.5523 14.5523 12 14 12H8C7.44772 12 7 11.5523 7 11Z"
                            fill="currentColor"></path>
                    </g>
                </svg>
            </button>
            <iframe id="templateFrame"
                class="w-full h-[92%] border-black rounded-[0.5rem] overflow-scroll border-0 transform scale-100 align-middle mt-1"
                srcdoc="{{ $rendered_template }}" frameborder="0"></iframe>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.id_user').select2({
                placeholder: 'Pilih Pengaju',
                allowClear: true,
            });
        });
    </script>

    <script>
        @if ($peruntukkan == 'dosen')
            const dosens = @json(isset($dosens) ? $dosens : []);
        @else
            const mahasiswas = @json(isset($mahasiswas) ? $mahasiswas : []);
        @endif
    </script>
    <script src="{{ asset('js/suratForm/handleMultiplePengaju.js') }}"></script>
    <script src="{{ asset('js/suratForm/handleTextareas.js') }}"></script>
    <script src="{{ asset('js/suratForm/indonesiaDays.js') }}"></script>
    <script src="{{ asset('js/suratForm/indonesiaMonths.js') }}"></script>
    <script src="{{ asset('js/suratForm/previewZoom.js') }}"></script>
    <script src="{{ asset('js/suratForm/updateContent.js') }}"></script>

@endsection
