<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines Bahasa Indonesia
    |--------------------------------------------------------------------------
    |
    | Berikut adalah beberapa pesan validasi yang digunakan oleh library validator.
    | Anda dapat mengubah atau menambahkan pesan-pesan ini sesuai kebutuhan.
    |
    */

    'accepted' => 'Kamu harus menerima syarat.',
    'accepted_if' => 'Kamu harus menerima syarat jika :other adalah :value.',
    'active_url' => 'Alamat URL tidak valid.',
    'after' => 'Tanggal yang kamu masukkan lebih besar dari :date.',
    'after_or_equal' => 'Tanggal yang kamu masukkan harus setelah atau sama dengan :date.',
    'alpha' => 'Kamu hanya bisa menggunakan huruf.',
    'alpha_dash' => 'Kamu hanya bisa menggunakan huruf, angka, tanda baca dan garis bawah.',
    'alpha_num' => 'Kamu hanya bisa menggunakan huruf dan angka.',
    'array' => 'Kamu harus memasukkan array.',
    'before' => 'Tanggal yang kamu masukkan lebih kecil dari :date.',
    'before_or_equal' => 'Tanggal yang kamu masukkan harus sebelum atau sama dengan :date.',
    'between' => [
        'numeric' => 'Nilai harus antara :min dan :max.',
        'file' => 'Berat file harus antara :min dan :max kilobytes.',
        'string' => 'Panjang string harus antara :min dan :max karakter.',
        'array' => 'Kamu harus memasukkan item minimal :min dan maksimal :max.',
    ],
    'boolean' => 'Kamu hanya bisa memilih benar atau salah.',
    'confirmed' => 'Konfirmasi tidak sesuai dengan input.',
    'current_password' => 'Sandi yang kamu masukkan tidak benar.',
    'date' => 'Tanggal yang kamu masukkan tidak valid.',
    'date_format' => 'Tanggal yang kamu masukkan harus sesuai dengan format :format.',
    'different' => 'Kamu harus memasukkan nilai yang berbeda dari :other.',
    'digits' => 'Nilai harus berupa angka :digits digit.',
    'digits_between' => 'Nilai harus antara :min dan :max digit.',
    'dimensions' => 'Dimensi gambar tidak sesuai.',
    'distinct' => 'Kamu hanya bisa memasukkan nilai yang unik.',
    'email' => 'Kamu harus memasukkan alamat email yang valid.',
    'ends_with' => 'Nilai harus berakhir dengan salah satu dari :values.',
    'enum' => 'nilai yang kamu masukkan tidak valid.',
    'exists' => 'nilai yang kamu masukkan tidak ditemukan dalam database.',
    'file' => 'Kamu harus memasukkan file.',
    'filled' => 'Kamu harus memasukkan nilai untuk attribute ini.',
    'gt' => [
        'numeric' => 'Nilai harus lebih besar dari :value.',
        'file' => 'Berat file harus lebih besar dari :value kilobytes.',
        'string' => 'Panjang string harus lebih besar dari :value karakter.',
        'array' => 'Kamu hanya bisa memasukkan item yang lebih banyak dari :value.',
    ],
    'gte' => [
        'numeric' => 'Nilai harus lebih besar atau sama dengan :value.',
        'file' => 'Berat file harus lebih besar atau sama dengan :value kilobytes.',
        'string' => 'Panjang string harus lebih besar atau sama dengan :value karakter.',
        'array' => 'Kamu hanya bisa memasukkan item yang jumlahnya sama dengan :value.',
    ],
    'image' => 'Kamu hanya bisa memasukkan file gambar.',
    'in' => 'nilai yang kamu masukkan tidak valid.',
    'in_array' => 'Nilai yang kamu masukkan tidak ditemukan dalam array :other.',
    'integer' => 'Kamu hanya bisa memasukkan nilai bilangan bulat.',
    'ip' => 'Alamat IP yang kamu masukkan tidak valid.',
    'ipv4' => 'Alamat IPv4 yang kamu masukkan tidak valid.',
    'ipv6' => 'Alamat IPv6 yang kamu masukkan tidak valid.',
    'json' => 'Nilai JSON yang kamu masukkan tidak valid.',
    'lt' => [
        'numeric' => 'Nilai harus lebih kecil dari :value.',
        'file' => 'Berat file harus lebih kecil dari :value kilobytes.',
        'string' => 'Panjang string harus lebih kecil dari :value karakter.',
        'array' => 'Kamu hanya bisa memasukkan item yang jumlahnya lebih sedikit dari :value.',
    ],
    'lte' => [
        'numeric' => 'Nilai harus tidak lebih besar atau sama dengan :value.',
        'file' => 'Berat file harus tidak lebih besar atau sama dengan :value kilobytes.',
        'string' => 'Panjang string harus tidak lebih besar atau sama dengan :value karakter.',
        'array' => 'Kamu hanya bisa memasukkan item yang jumlahnya tidak lebih banyak dari :value.',
    ],
    'mac_address' => 'Alamat MAC yang kamu masukkan tidak valid.',
    'max' => [
        'numeric' => 'Nilai harus tidak lebih besar dari :max.',
        'file' => 'Berat file harus tidak lebih besar dari :max kilobytes.',
        'string' => 'Panjang string harus tidak lebih besar dari :max karakter.',
        'array' => 'Kamu hanya bisa memasukkan item yang jumlahnya tidak melebihi :max.',
    ],
    'mimes' => 'Kamu hanya bisa memasukkan file dengan jenis :values.',
    'mimetypes' => 'Kamu hanya bisa memasukkan file dengan jenis :values.',
    'min' => [
        'numeric' => 'Nilai harus tidak kurang dari :min.',
        'file' => 'Berat file harus tidak kurang dari :min kilobytes.',
        'string' => 'Panjang string harus tidak kurang dari :min karakter.',
        'array' => 'Kamu hanya bisa memasukkan item yang jumlahnya minimal :min.',
    ],
    'multiple_of' => 'Nilai harus merupakan kelipatan dari :value.',
    'not_in' => 'nilai yang kamu masukkan tidak ditemukan dalam array :values.',
    'not_regex' => 'Format nilai yang kamu masukkan tidak sesuai.',
    'numeric' => 'Kamu hanya bisa memasukkan nilai bilangan.',
    'password' => 'Sandi yang kamu masukkan salah.',
    'present' => 'Kamu harus memasukkan nilai untuk attribute ini.',
    'prohibited' => 'Kamu tidak boleh memasukkan nilai untuk attribute ini.',
    'prohibited_if' => 'Kamu tidak boleh memasukkan nilai jika :other adalah :value.',
    'prohibited_unless' => 'Kamu hanya bisa memasukkan nilai jika :other ada dalam :values.',
    'prohibits' => 'Kamu tidak boleh memasukkan nilai untuk attribute ini karena ada konflik dengan :other.',
    'regex' => 'Format nilai yang kamu masukkan tidak sesuai.',
    'required' => 'Kamu harus memasukkan nilai untuk attribute ini.',
    'required_array_keys' => 'Kamu harus memasukkan entri untuk item-item berikut: :values.',
    'required_if' => 'Kamu harus memasukkan nilai jika :other adalah :value.',
    'required_unless' => 'Kamu hanya bisa memasukkan nilai jika :other ada dalam :values.',
    'required_with' => 'Kamu harus memasukkan nilai jika salah satu dari item-item berikut ada: :values.',
    'required_with_all' => 'Kamu harus memasukkan nilai jika semua item-item berikut ada: :values.',
    'required_without' => 'Kamu hanya bisa memasukkan nilai jika salah satu dari item-item berikut tidak ada: :values.',
    'required_without_all' => 'Kamu hanya bisa memasukkan nilai jika tidak ada item-item berikut: :values.',
    'same' => 'Nilai dan :other harus sama.',
    'size' => [
        'numeric' => 'Nilai harus memiliki ukuran :size.',
        'file' => 'Berat file harus memiliki ukuran :size kilobytes.',
        'string' => 'Panjang string harus memiliki ukuran :size karakter.',
        'array' => 'Kamu harus memasukkan item yang jumlahnya sama dengan :size.',
    ],
    'starts_with' => 'Nilai harus dimulai dengan salah satu dari :values.',
    'string' => 'Kamu hanya bisa memasukkan nilai string.',
    'timezone' => 'Kamu hanya bisa memasukkan zona waktu yang valid.',
    'unique' => 'Nilai yang kamu masukkan telah digunakan oleh lainnya.',
    'uploaded' => 'File gagal diunggah.',
    'url' => 'Alamat URL yang kamu masukkan tidak valid.',
    'uuid' => 'Kamu hanya bisa memasukkan UUID yang valid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Berikut adalah contoh pesan custom untuk attribute tertentu.
    |

    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | Berikut adalah contoh atribut yang dapat digunakan sebagai placeholder.
    |

    */

    'attributes' => [],

];
