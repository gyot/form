<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\FormDatas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\BioData;
use App\Models\AgendaKegiatan;
use File;
use URL;

class FormDataController extends Component
{
    /**
     * Menyimpan data form.
     */
    public function index($id_kegiatan,$status,$slug_kegiatan) {
        $data_kegiatan = AgendaKegiatan::where('id',$id_kegiatan)->get();
        // dd($data_kegiatan);
        $nama_kegiatan=$data_kegiatan[0]->nama_kegiatan;
        $rekening='0';
        $pulsa='0';

        // $path=public_path('storage/'.$data_kegiatan[0]->flyer);  
        // if(file_exists($path)==false) {
        //     $path = public_path('storage/flyers/').'logo_kemdikbud.png';
        // } else {
        //     $path=public_path('storage/'.$data_kegiatan[0]->flyer);
        // }

        $flyerPath = public_path('storage/').$data_kegiatan[0]->flyer;
        $defaultPath = public_path('storage/').'flyers/logo_kemdikbud.png';
        
        if (!file_exists($flyerPath)) {
            $path = $defaultPath;
        } else {
            $path = $flyerPath;
        }
        $imageData = base64_encode(File::get($path));

        // Tentukan tipe file
        $mimeType = mime_content_type($path);
        
        // Mengirimkan data ke view
        return view('welcome',compact(['imageData', 'mimeType','nama_kegiatan','id_kegiatan','rekening','pulsa','status']));     

    }

        public function store(Request $request)
    {
        // Validasi data input
        // dd($request->tanda_tangan);
        $validatedData = Validator::make($request->all(), [
            // ->validate([
            'nama' => 'nullable|min:2|required|string|max:255',
            // 'nip' => 'nullable|min:2|max:18|required|string|unique:form_data,nip',
            'nip' => 'nullable|min:2|required|max:18|string',
            // 'email' => 'nullable|min:2|required|email|unique:form_data,email',
            'email' => 'nullable|min:2|required|email',
            'jenis_kelamin' => 'nullable|min:2|required|string|max:100',
            'tempat_lahir' => 'nullable|min:2|required|string|max:100',
            'tanggal_lahir' => 'nullable|min:2|required|date',
            'nama_instansi' => 'nullable|min:2|required|string|max:255',
            'jabatan' => 'nullable|min:2|required|string|max:255',
            'pangkat_golongan' => 'nullable|min:2|required|string|max:100',
            'pendidikan_terakhir' => 'nullable|min:2|required|string|max:100',
            'no_hp' => 'nullable|min:2|required|string|max:20',
            'provider' => 'string|max:50',
            'agama' => 'nullable|min:2|required|string|max:50',
            'kabupaten_kota' => 'nullable|min:2|required|string|max:100',
            // 'nomor_rekening' => 'required|numeric|unique:form_data,nomor_rekening',
            'nomor_rekening' => 'nullable|numeric',
            'nama_bank' => 'nullable|string|max:100',
            'tanda_tangan' => [
                'required',             // Tanda tangan wajib diisi
                function ($attribute, $value, $fail) {
                    if ($value === 'data:image/png;base64,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') { // Ganti dengan nilai yang tidak diinginkan
                        $fail('Tanda tangan tidak boleh kosong');
                    }
                },
            ],
        ]);
         // Jika validasi gagal, kembalikan ke halaman sebelumnya dengan error
         if ($validatedData->fails()) {
            return redirect()->back()
                             ->withErrors($validatedData)
                             ->withInput();
        }
        // Menghandle pilihan 'Lainnya' untuk beberapa field
        $pangkatGolongan = $request->input('pangkat_golongan') === 'Lainnya' ? $request->input('pangkat_golongan_lain') : $request->input('pangkat_golongan');
        $pendidikanTerakhir = $request->input('pendidikan_terakhir') === 'Lainnya' ? $request->input('pendidikan_terakhir_lain') : $request->input('pendidikan_terakhir');
        $agama = $request->input('agama') === 'Lainnya' ? $request->input('agama_lain') : $request->input('agama');
        $kabupatenKota = $request->input('kabupaten_kota') === 'Lainnya' ? $request->input('kabupaten_kota_lain') : $request->input('kabupaten_kota');
        // dd($request->input('tanda_tangan'));
        // Mengolah dan menyimpan tanda tangan sebagai gambar
        $signatureBase64 = $request->input('tanda_tangan');
        $signatureBase64 = preg_replace('/^data:image\/\w+;base64,/', '', $signatureBase64);
        $signatureBase64 = str_replace(' ', '+', $signatureBase64);
        $signatureData = base64_decode($signatureBase64);

        // Membuat nama file unik
        $signatureFilename = 'signatures/signature_' . time() . '_' . uniqid() . '.png';

        // Menyimpan file tanda tangan di storage/app/public/signatures
        Storage::disk('public')->put($signatureFilename, $signatureData);

        try {
            // Menyimpan data form ke database
            $data_user=FormDatas::create([
                'nama' => $request->input('nama'),
                'nip' => $request->input('nip'),
                'email' => $request->input('email'),
                'jenis_kelamin' => $request->input('jenis_kelamin'),
                'tempat_lahir' => $request->input('tempat_lahir'),
                'tanggal_lahir' => $request->input('tanggal_lahir'),
                'nama_instansi' => $request->input('nama_instansi'),
                'jabatan' => $request->input('jabatan'),
                'pangkat_golongan' => $pangkatGolongan,
                'pendidikan_terakhir' => $pendidikanTerakhir,
                'no_hp' => $request->input('no_hp'),
                'provider' => $request->input('provider'),
                'agama' => $agama,
                'kabupaten_kota' => $kabupatenKota,
                'nomor_rekening' => $request->input('nomor_rekening'),
                'nama_bank' => $request->input('nama_bank'),
                'tanda_tangan_path' => $signatureFilename,
            ]);

            $biodata=BioData::create([
                'id_user'=>$data_user->id,
                'id_kegiatan'=>$request->input('id_kegiatan')
            ]);



            return redirect()->back()->with('success', 'Data berhasil disimpan!');
        } catch (QueryException $e) {
            // Tangkap error duplikat data atau lainnya yang terkait dengan query
            if ($e->getCode() == 23000) { // 23000 adalah kode error untuk constraint violation
                return redirect()->back()->withErrors(['nip' => 'NIP sudah ada dalam database'])->withInput();
            }
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan pada penyimpanan data'])->withInput();
        }
    }
}
