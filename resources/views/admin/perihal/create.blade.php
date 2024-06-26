@extends('layout.layout')

@section('title', 'Dashboard')

@section('content')

    <div class="grid grid-cols-12">
        <form action="{{ route('perihal.store') }}" method="POST" class="grid w-1/2 min-w-full col-start-1 col-end-6 grid-">
            @csrf
            @method('POST')

            <div class="mb-5">
                <label for="nama_perihal" class="block mb-2 text-sm font-medium text-gray-900 ">
                    Nama Perihal
                </label>
                <input type="text"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    id="perihal" name="nama_perihal" placeholder="Masukkan Nama Perihal" required
                    oninput="updateContent()" />
            </div>
            <div class="mb-5">
                <label for="id_kategori_surat" class="block mb-2 text-sm font-medium text-gray-900 ">
                    Kategori
                </label>
                <select
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    name="id_kategori_surat" id="id_kategori_surat" required onchange="showContent()">
                    <option value="">Pilih Kategori</option>
                    @foreach ($opsi_kategori as $id => $nama)
                        <option value="{{ $id }}">{{ $nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-5">
                <label for="nama_tujuan" class="block mb-2 text-sm font-medium text-gray-900">
                    Nama Tujuan
                </label>
                <textarea
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    id="nama_tujuan" name="nama_tujuan" cols="30" rows="4" placeholder="Masukkan Nama Tujuan"
                    oninput="updateContent()"></textarea>
            </div>
            <div class="mb-5">
                <label for="alamat_tujuan" class="block mb-2 text-sm font-medium text-gray-900">
                    Alamat Tujuan
                </label>
                <textarea
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    id="alamat_tujuan" name="alamat_tujuan" cols="30" rows="4" placeholder="Masukkan Alamat Tujuan"
                    oninput="updateContent()"></textarea>
            </div>
            <div class="mb-5">
                <label for="upper_body" class="block mb-2 text-sm font-medium text-gray-900">
                    Upper Body
                </label>
                <textarea
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    id="upper_body" name="upper_body" cols="30" rows="4" placeholder="Masukkan Upper Body"
                    oninput="updateContent()"></textarea>
            </div>
            <div class="mb-5">
                <label for="lower_body" class="block mb-2 text-sm font-medium text-gray-900">
                    Lower Body
                </label>
                <textarea
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    id="lower_body" name="lower_body" cols="30" rows="4" placeholder="Masukkan Lower Body"
                    oninput="updateContent()"></textarea>
            </div>

            <button type=" submit"
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
            <iframe id="templateFrame" onload="lazy"
                class="w-full h-[92%] border-black rounded-[0.5rem] overflow-scroll border-0 transform scale-100 align-middle mt-1"
                srcdoc="{{ $rendered_template }}" frameborder="0"></iframe>
        </div>
    </div>

    <script>
        function updateContent() {
            // Get the iframe element
            const templateFrame = document.getElementById("templateFrame");

            // Access the content document of the iframe
            const templateDocument = templateFrame.contentDocument || templateFrame.contentWindow.document;

            // Get the body element inside the iframe
            const perihalElement = templateDocument.getElementById("perihalContent");
            const namaTujuanElement = templateDocument.getElementById("namaTujuanContent");
            const alamatTujuanElement = templateDocument.getElementById("alamatTujuanContent");
            const upperBodyElement = templateDocument.getElementById("upperBodyContent");
            const lowerBodyElement = templateDocument.getElementById("lowerBodyContent");

            // Get the body data from the input in the parent document
            const perihalData = document.getElementById("perihal").value;
            const namaTujuanData = document.getElementById("nama_tujuan").value;
            const alamatTujuanData = document.getElementById("alamat_tujuan").value;
            const upperBodyData = document.getElementById("upper_body").value;
            const lowerBodyData = document.getElementById("lower_body").value;

            perihalElement.innerHTML = perihalData;
            namaTujuanElement.innerHTML = namaTujuanData;
            alamatTujuanElement.innerHTML = alamatTujuanData;
            upperBodyElement.innerHTML = upperBodyData;
            lowerBodyElement.innerHTML = lowerBodyData;
        }
    </script>

    <script>
        // Get a reference to the iframe element
        const templateFrame = document.getElementById('templateFrame');
        let zoomLevel = 1;

        // Function to zoom the iframe content
        function zoomIn() {
            // Check if secure context allows access
            const templateDoc = templateFrame.contentDocument || templateFrame.contentWindow.document;
            if (!templateDoc) return; // Abort if document access is not allowed

            // Apply zoom using CSS transform on secure context
            templateDoc.documentElement.style.transform = `scale(${zoomLevel + 0.1})`;
            zoomLevel += 0.1;
        }

        function zoomOut() {
            // Check if secure context allows access
            const templateDoc = templateFrame.contentDocument || templateFrame.contentWindow.document;
            if (!templateDoc) return; // Abort if document access is not allowed

            // Ensure zoom doesn't go negative
            zoomLevel = Math.max(zoomLevel - 0.1, 0.1);
            templateDoc.documentElement.style.transform = `scale(${zoomLevel})`;
        }
    </script>

@endsection

