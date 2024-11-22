<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\ZipArchive;
use PhpOffice\PhpWord\TemplateProcessor;
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
                    'height' => 150,
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

        // $this->gabungkanDokumen($tempFolder . '/*.docx', public_path('word_documents'));
        // Gabungkan dokumen
        return $this->gabungkanDokumen($tempFolder . '/*.docx', public_path('word_documents'));
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
}
