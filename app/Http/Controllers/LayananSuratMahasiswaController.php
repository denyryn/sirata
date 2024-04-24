<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Perihal;
use App\Models\Surat;
use App\Models\Status;
use App\Models\User;
use App\Models\Pemohon;
use App\Models\Riwayat;
use App\Models\Mahasiswa;

use Carbon\Carbon;

class LayananSuratMahasiswaController extends Controller
{
    public function index()
    {
        $data_perihals = perihal::with('Kategori_Surat')->paginate(10);

        $data_perihal = [];

        foreach ($data_perihals as $perihal) {
            $nama_kategori = strtolower(str_replace(' ', '_', $perihal->kategori_Surat->nama_kategori ?? ''));

            if (view()->exists('surat.template.' . $nama_kategori)) {
                // Include data for this $perihal since the view exists
                $data_perihal[] = [
                    'perihal' => $perihal,
                    'nama_kategori' => $nama_kategori,
                ];
            }
        }
        return view('surat.index', compact('data_perihal'));
    }

    public function create($id_perihal)
    {
        $data_perihal = perihal::with('Kategori_Surat')->find($id_perihal);

        if (!$data_perihal) {
            // Handle case where perihal with $id_perihal is not found
            abort(404, __('Perihal not found.')); // Or redirect to appropriate error page
        }

        $no = 1;
        $tanggal_sekarang = Carbon::now()->translatedFormat('F Y');

        $nama_kategori = strtolower(str_replace(' ', '_', $data_perihal->kategori_Surat->nama_kategori ?? ''));
        $template = 'surat.template.' . $nama_kategori;

        if (!view()->exists($template)) {
            abort(404, __('Template not found.'));
        }

        // Retrieve the user ID from the session
        $id_user = Session::get('id_user');

        $user_sekarang = User::find($id_user);

        $mahasiswa_sekarang = Mahasiswa::where('id_user', $id_user)->first();

        $mahasiswas = Mahasiswa::all();

        // dd($user_sekarang);
        // dd($mahasiswas);
        // dd($mahasiswa_sekarang);

        $rendered_template = view($template, compact('no', 'data_perihal', 'tanggal_sekarang', 'mahasiswa_sekarang'))->render();
        return view('surat.form', compact('data_perihal', 'rendered_template', 'mahasiswas', 'mahasiswa_sekarang', 'user_sekarang'));
    }

    public function store(Request $request)
    {
        $status_awal = Status::where('nama_status', 'Pending')->first('id_status');
        $count = $request->input('count');

        $data_surat = new surat;
        // $data_surat->id_user = $request->id_user;
        $data_surat->id_kategori_surat = $request->id_kategori_surat;
        $data_surat->nama_perihal = $request->nama_perihal;
        $data_surat->nama_tujuan = $request->nama_tujuan;
        $data_surat->alamat_tujuan = $request->alamat_tujuan;
        $data_surat->upper_body = $request->upper_body;
        $data_surat->lower_body = $request->lower_body;
        $data_surat->save();

        // Handle multiple id_user values
        for ($i = 1; $i <= $count; $i++) {
            if ($request->has("id_user$i")) {
                $id_user = $request->input("id_user$i");

                $data_pemohon = new pemohon;
                $data_pemohon->id_user = $id_user;
                $data_pemohon->id_surat = $data_surat->id_surat;
                $data_pemohon->save();
            }
        }

        $data_riwayat = new riwayat;
        $data_riwayat->id_status = $status_awal->id_status;
        $data_riwayat->id_surat = $data_surat->id_surat;
        $data_riwayat->save();

        return redirect()->route("mahasiswa.index");
    }
}
