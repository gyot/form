<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\AgendaKegiatan;
use Illuminate\Http\Request;

class AgendaKegiatanController extends Component
{
    public function index()
    {
        $agendaKegiatan = AgendaKegiatan::all();
        return view('livewire.home.kegiatan', compact('agendaKegiatan'));
    }

    public function create()
    {
        return view('agenda.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $pulsa=$request->pulsa == 1 ? 1 : 0;
        $rekening=$request->rekening == 1 ? 1 : 0;
        $kodeKegiatan=$this->generateRandomString();
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
            'kode_kegiatan' => 'required|string|max:20',
            'pulsa' => 'nullable|boolean',
            'rekening' => 'nullable|boolean',
            'id_user' => 'required|exists:users,id',
        ]);
        $data=array($request->all());
        // kode_kegiatan
        dd($data);
        // $data = $request->all();

        // // Handle file upload for flyer
        // if ($request->hasFile('flyer')) {
        //     $data['flyer'] = $request->file('flyer')->store('flyers', 'public');
        // }

        // AgendaKegiatan::create($data);

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
}
