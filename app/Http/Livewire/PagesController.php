<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\ZipArchive;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\SimpleType\Jc;
use File;
use App\Models\FormData;
use DB;
class PagesController extends Component
{
    //
    public function createWordDocument(){     

        // Path ke template Word
        $templatePath = public_path('assets/template/template.docx');

        // Folder sementara untuk menyimpan dokumen
        $tempFolder = public_path('word_documents');
        if (!file_exists($tempFolder)) {
            mkdir($tempFolder, 0777, true); // Membuat folder jika tidak ada
        }

        // Buat objek PhpWord untuk file gabungan
        $phpWord = new PhpWord();
        $dataPeserta=DB::table('biodata')->where('id_kegiatan',1)->get();
        
        // Loop untuk setiap peserta dan membuat file Word terpisah
        foreach ($dataPeserta as $dataForm) {
            // dd($dataForm);
            // Inisiasi TemplateProcessor
            $template = new TemplateProcessor($templatePath);

            // Atur nilai di template
            $template->setValue('tpk',$dataForm->tpk);
            $template->setValue('nip',$dataForm->nip);
            $template->setValue('nama_kegiatan',$dataForm->nama_kegiatan);
            $template->setValue('tanggal_kegiatan',$this->formatTanggalSD($dataForm->tanggal_mulai, $dataForm->tanggal_selesai));
            $template->setValue('tanggal',$this->formatTanggal($dataForm->tanggal_mulai));
            $template->setValue('nama_lengkap',$dataForm->nama);
            $template->setValue('nip',$dataForm->nip);
            $template->setValue('surel',$dataForm->email);
            $template->setValue('jenis_kelamin',$dataForm->jenis_kelamin);
            $template->setValue('tempat_lahir',$dataForm->tempat_lahir);
            $template->setValue('tanggal_lahir',$dataForm->tanggal_lahir);
            $template->setValue('nama_instansi',$dataForm->nama_instansi);
            $template->setValue('jabatan',$dataForm->jabatan);
            $template->setValue('pangkat_golongan',$dataForm->pangkat_golongan);
            $template->setValue('pendidikan_terakhir',$dataForm->pendidikan_terakhir);
            $template->setValue('no_hp',$dataForm->no_hp);
            $template->setValue('provider',$dataForm->provider);
            $template->setValue('agama',$dataForm->agama);
            $template->setValue('kabupaten_kota',$dataForm->kabupaten_kota);
            $template->setValue('nomor_rekening',$dataForm->nomor_rekening);
            $template->setValue('nama_bank',$dataForm->nama_bank);
            $template->setValue('tanda_tangan',$dataForm->tanda_tangan_path);
            $pathGambar = public_path('storage').'/'.$dataForm->tanda_tangan_path;
            // dd($pathGambar);
            if (file_exists($pathGambar)) {
                // Menambahkan gambar sebagai placeholder dengan `<w:pict>` XML
                $template->setImageValue('ttd', [
                    'path' => $pathGambar,
                    'width' => 200,
                    'ratio' => true, // Menjaga rasio aspek
                ]);
            } else {
                $template->setValue('ttd', 'Gambar tidak ditemukan');
            }
            // --------------------------------------------------------------------------------------------------------------------------------

            // Menyimpan file Word sementara per peserta
            $fileName = 'Biodata_' . $dataForm->nama . '-'.$dataForm->nama_instansi.' _ '.$dataForm->id_anggota.'.docx';
            $filePath = $tempFolder . '/' . $fileName;
            $template->saveAs($filePath);
        }
        return $this->createZip();
        // Gabungkan dokumen
        // return $this->gabungkanDokumen($tempFolder . '/*.docx', public_path('word_documents'));
    }



    function gabungkanDokumen($files, $outputPath)
    {
        // Buat objek PhpWord baru
    $phpWord = new PhpWord();

    // Loop untuk setiap file dan menggabungkannya
    foreach (glob($files) as $file) {
        // Muat setiap file sebagai dokumen template
        $source = IOFactory::load($file);
        // Salin section dari file sumber ke file utama
        foreach ($source->getSections() as $section) {
            // Tambahkan section dari file template ke dokumen utama
            $newSection = $phpWord->addSection($section->getSettings());

            // Salin elemen dari section yang ada ke section baru
            foreach ($section->getElements() as $element) {
                $newSection->addElement($element);
            }

            // Tambahkan pemisah halaman antara dokumen (opsional)
            // $newSection->addPageBreak(); // Pemisah halaman ditambahkan di section baru
        }
    }

    // Simpan dokumen yang digabungkan
    $outputFile = $outputPath . '/gabungan.docx';
    $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
    $objWriter->save($outputFile);

    return $this->createZip();
    }


    public function createZip()
    {
        // Nama file ZIP yang akan dibuat
        $dataPeserta=DB::table('biodata')->where('id_kegiatan',1)->get();
        $zipFilePath = public_path('word_documents/').$dataPeserta[0]->nama_kegiatan.'.zip';

        // Membuat instance ZipArchive
        $zip = new \ZipArchive();

        // Membuka file ZIP untuk ditulis
        if ($zip->open($zipFilePath, \ZipArchive::CREATE) === TRUE) {
            // Misalnya menambahkan beberapa file DOCX ke dalam ZIP
            $files = File::files(public_path('word_documents'));
            
            foreach ($files as $file) {
                // Menambahkan file ke ZIP (hanya file .docx dalam contoh ini)
                if ($file->getExtension() == 'docx') {
                    $zip->addFile($file->getPathname(), $file->getFilename());
                }
            }

            // Menutup file ZIP
            $zip->close();

            $tempFolder = public_path('word_documents');
            if (!file_exists($tempFolder)) {
                mkdir($tempFolder, 0777, true); // Membuat folder jika tidak ada
            }            
                        
            // Loop untuk setiap peserta dan membuat file Word terpisah
            foreach ($dataPeserta as $dataForm) {
                // dd($dataForm);
                // Inisiasi TemplateProcessor
                // Menyimpan file Word sementara per peserta
                $fileName = 'Biodata_' . $dataForm->nama . '-'.$dataForm->nama_instansi.' _ '.$dataForm->id_anggota.'.docx';
                $filePath = $tempFolder . '/' . $fileName;
                if (File::exists($filePath)) {
                    //File::delete($filePath);
                    unlink($filePath);
                }
            }
        


            return response()->download($zipFilePath)->deleteFileAfterSend(true);;  // Memberikan file ZIP untuk diunduh
        } else {
            return response()->json(['message' => 'Gagal membuat file ZIP'], 500);
        }
    }


    private function formatTanggalSD($tanggalMulai, $tanggalSelesai)
    {
        $bulan = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        $dateMulai = date_create($tanggalMulai);
        $dateSelesai = date_create($tanggalSelesai);

        $dMulai = date_format($dateMulai, "d");
        $mMulai = date_format($dateMulai, "m") - 1;
        $yMulai = date_format($dateMulai, "Y");

        $dSelesai = date_format($dateSelesai, "d");
        $mSelesai = date_format($dateSelesai, "m") - 1;
        $ySelesai = date_format($dateSelesai, "Y");

        if ($tanggalMulai === $tanggalSelesai) {
            return "{$dMulai} {$bulan[$mMulai]} {$yMulai}";
        } elseif ($mMulai === $mSelesai && $yMulai === $ySelesai) {
            return "{$dMulai} s.d. {$dSelesai} {$bulan[$mMulai]} {$yMulai}";
        } else {
            return "{$dMulai} {$bulan[$mMulai]} {$yMulai} s.d. {$dSelesai} {$bulan[$mSelesai]} {$ySelesai}";
        }
    }

    private function formatTanggal($tanggal)
    {
        $bulan = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        $dateTanggal = date_create($tanggal);

        $dTanggal = date_format($dateTanggal, "d");
        $mTanggal = date_format($dateTanggal, "m") - 1;
        $yTanggal = date_format($dateTanggal, "Y");
        
        return "{$dTanggal} {$bulan[$mTanggal]} {$yTanggal}";
    }

    function kegiatan(){
        return view('layouts.kegiatan.index');
    }

    public function tes_tabel()
    {
        $dataPeserta = DB::table('biodata')->where('id_kegiatan', 1)->get();
        // Membuat instance PHPWord
        $phpWord = new PhpWord();

        // Menambahkan section pertama
        $section1 = $phpWord->addSection();
        $section1->addText('PRESENSI PESERTA', ['bold' => true, 'size' => 14,'alignment' => Jc::CENTER]);
        // $section1->addText('Nama Kegiatan : '.$dataPeserta[0]->nama_kegiatan, ['bold' => true, 'size' => 12]);
        // $section1->addText('Tanggal : '.$dataPeserta[0]->tanggal_kegiatan, ['bold' => true, 'size' => 12]);
        // Membuat tabel di halaman pertama
        $table = $section1->addTable();
        $table->addRow();
        $table->addCell(1500)->addText('Nama Kegiatan');
        $table->addCell(200)->addText(':');
        $table->addCell(7000)->addText($dataPeserta[0]->nama_kegiatan);
        $table->addRow();
        $table->addCell(1500)->addText('Nama Kegiatan');
        $table->addCell(200)->addText(':');
        $table->addCell(7000)->addText($dataPeserta[0]->tpk);
        $table->addRow();
        $table->addCell(1500)->addText('Tanggal');
        $table->addCell(200)->addText(':');
        $table->addCell(7000)->addText($this->formatTanggalSD($dataPeserta[0]->tanggal_mulai, $dataPeserta[0]->tanggal_selesai));
        $section1->addText('', ['bold' => true, 'size' => 14]);

        $tableStyle = array(
            'borderColor' => '000000',
            'borderSize'  => 6,
        );
        $firstRowStyle = array('bgColor' => '000000');
        $phpWord->addTableStyle('myTable', $tableStyle, $firstRowStyle);
        $table1 = $section1->addTable('myTable');
        $table1->addRow();
        $table1->addCell(500)->addText('No');
        $table1->addCell(3000)->addText('Nama');
        $table1->addCell(3000)->addText('Instansi');
        $table1->addCell(3000)->addText('Jabatan');
        $table1->addCell(3000)->addText('TTD');

        foreach ($dataPeserta as $index=>$row) {
            $table1->addRow();
            $table1->addCell(500)->addText((int)$index+1);
            $table1->addCell(3000)->addText($row->nama);
            $table1->addCell(3000)->addText($row->nama_instansi);
            $table1->addCell(3000)->addText($row->jabatan);
            $pathGambar = public_path('storage').'/'.$row->tanda_tangan_path;
            if (file_exists($pathGambar)) {
                // Tambahkan gambar jika file ada
                $table1->addCell(3000)->addImage($pathGambar, [
                    'width' => 50,  // Lebar gambar
                    'align' => 'center', // Penyelarasan
                ]);
            } else {
                // Tambahkan teks jika gambar tidak ditemukan
                $table1->addCell(5000)->addText('Tanda tangan tidak tersedia');
            }
        }

        

        // Menyimpan file DOCX
        $fileName = 'tabel_data_2_halaman.docx';
        $filePath = storage_path($fileName);

        $writer = IOFactory::createWriter($phpWord, 'Word2007');
        $writer->save($filePath);

        // Mengunduh file ke browser
        return response()->download($filePath)->deleteFileAfterSend(true);
    }


}
