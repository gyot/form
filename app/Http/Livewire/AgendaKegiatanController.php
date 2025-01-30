<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\AgendaKegiatan;
use Illuminate\Http\Request;

class AgendaKegiatanController extends Component
{
    public function index()
    {
        $agendaKegiatan = AgendaKegiatan::orderBy('tanggal_mulai', 'desc')
        ->get();
        $page='Data Kegiatan Tahun '.date('Y');
        \View::share('page', $page);
        return view('livewire.home.kegiatan', compact('agendaKegiatan'));
    }

    function dataApiKegaitan(Request $request) {
        $perPage = $request->get('perPage', 5); // Jumlah data per halaman, default 10
        $page = $request->get('page', 1);       // Halaman saat ini, default 1

        // Ambil data menggunakan paginate()
        $data = AgendaKegiatan::orderBy('tanggal_mulai', 'desc')
        ->paginate($perPage);

        // Respons JSON
        return response()->json([
            'data' => $data->items(), // Data untuk halaman ini
            'current_page' => $data->currentPage(),
            'last_page' => $data->lastPage(),
            'total' => $data->total(), // Total semua data
        ]);

        // $agendaKegiatan = AgendaKegiatan::paginate($perPage)->orderByRaw('tanggal_mulai - tanggal_selesai DESC')
        // ->get();
        // return response()->json($agendaKegiatan);
    }

    public function create()
    {
        return view('agenda.create');
    }

    public function store(Request $request)
    {
        $pa_pulsa=$request->pa_pulsa == 1 ? 1 : 0;
        $pa_rekening=$request->pa_rekening == 2 ? 2 : 0;
        $na_pulsa=$request->na_pulsa == 1 ? 1 : 0;
        $na_rekening=$request->na_rekening == 2 ? 2 : 0;
        $pe_pulsa=$request->pe_pulsa == 1 ? 1 : 0;
        $pe_rekening=$request->pe_rekening == 2 ? 2 : 0;
        $kodeKegiatan=$this->generateRandomString();
        $flyer=$request->flyer == null ? 'tidak ada':$request->flyer;
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'tpk' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'pola_kegiatan' => 'required|string|max:255',
            'flyer' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:2048',
            'materi' => 'nullable|url',
            'dokumentasi' => 'nullable|url',
            'panduan' => 'nullable|url',
            'jenis_kegiatan' => 'required|string|max:255',
            'pa_pulsa' => 'nullable|integer',
            'pa_rekening' => 'nullable|integer',
            'na_pulsa' => 'nullable|integer',
            'na_rekening' => 'nullable|integer',
            'pe_pulsa' => 'nullable|integer',
            'pe_rekening' => 'nullable|integer',
            'h_narasumber' => 'nullable|integer',
            'id_user' => 'required|exists:users,id',
        ]);
        $h_peserta=(int)$request->pe_pulsa+(int)$request->pe_rekening;
        $h_panitia=(int)$request->pa_pulsa+(int)$request->pa_rekening;
        $h_narasumber=(int)$request->na_pulsa+(int)$request->na_rekening;
        $data = array(
            'nama_kegiatan' => $request->nama_kegiatan,
            'tpk' => $request->tpk,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'pola_kegiatan' => $request->pola_kegiatan,
            'flyer' => $flyer,
            'materi' => $request->materi,
            'dokumentasi' => $request->dokumentasi,
            'panduan' => $request->panduan,
            'jenis_kegiatan' => $request->jenis_kegiatan,
            'h_peserta' => $h_peserta,
            'h_panitia' => $h_panitia,
            'h_narasumber' => $h_narasumber,
            'id_user' => $request->id_user,
            'kode_kegiatan' => $kodeKegiatan
        );

        // dd($data);

        // // Handle file upload for flyer
        if ($request->hasFile('flyer')) {
            $data['flyer'] = $request->file('flyer')->store('flyers', 'public');
        }

        $simpan=AgendaKegiatan::create($data);
        if ($simpan) {
            # code...
            return json_encode('Kegiatan berhasil ditambahkan.');
        }else {
            # code...
            return json_encode($simpan);
        }
        // return redirect()->route('agenda.index')->with('success', 'Agenda Kegiatan berhasil ditambahkan.');
    }

    private function generateRandomString($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
    
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
    
        return $randomString;
    }

    public function show($id)
    {
        $agendaKegiatan = AgendaKegiatan::findOrFail($id);
        return view('agenda.show', compact('agendaKegiatan'));
    }

    public function edit($id)
    {
        $agendaKegiatan = AgendaKegiatan::findOrFail($id);
        return view('agenda.edit', compact('agendaKegiatan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'tpk' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'pola_kegiatan' => 'required|string',
            'flyer' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'materi' => 'nullable|url',
            'dokumentasi' => 'nullable|url',
            'panduan' => 'nullable|url',
            'jenis_kegiatan' => 'required|string',
            'kode_kegiatan' => 'required|string|unique:agenda_kegiatans,kode_kegiatan,' . $id,
            'id_user' => 'required|integer',
        ]);

        $agendaKegiatan = AgendaKegiatan::findOrFail($id);
        $data = $request->all();

        // Handle file upload for flyer
        if ($request->hasFile('flyer')) {
            // Delete old flyer if exists
            if ($agendaKegiatan->flyer) {
                Storage::disk('public')->delete($agendaKegiatan->flyer);
            }
            $data['flyer'] = $request->file('flyer')->store('flyers', 'public');
        }

        $agendaKegiatan->update($data);

        return redirect()->route('agenda.index')->with('success', 'Agenda Kegiatan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $agendaKegiatan = AgendaKegiatan::findOrFail($id);

        // Delete flyer file if exists
        if ($agendaKegiatan->flyer) {
            Storage::disk('public')->delete($agendaKegiatan->flyer);
        }

        $agendaKegiatan->delete();

        return redirect()->route('agenda.index')->with('success', 'Agenda Kegiatan berhasil dihapus.');
    }

    public function detail($id){
        $data=AgendaKegiatan::find($id);
        $page=$data->nama_kegiatan;
        \View::share('page', $page);
        return view('livewire.home.agenda.detail', compact(['data']));
    }

    public function detailJson($id){
        $data=AgendaKegiatan::find($id);
        $page=$data->nama_kegiatan;
        // \View::share('page', $page);
        // return view('livewire.home.agenda.detail', compact(['data']));
        return json_encode($data);
    }

    function ubahstatus($id) {
        $data=AgendaKegiatan::find($id);
        if ($data->status=='Aktif') {
            # code...
            $data->status = 'Non Aktif';
        } else {
            # code...
            $data->status = 'Aktif';
        }
        $data->save();
        
        // \View::share('page', $page);
        // return view('livewire.home.agenda.detail', compact(['data']));
        return json_encode($data);
    }
}
