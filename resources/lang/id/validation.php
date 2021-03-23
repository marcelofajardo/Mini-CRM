<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute harus diterima.',
    'active_url' => ':attribute bukan URL yang valid.',
    'after' => ':attribute harus lebih dari :date.',
    'after_or_equal' => ':attribute harus sama atau lebih dari :date.',
    'alpha' => ':attribute harus mengandung huruf saja.',
    'alpha_dash' => ':attribute hanya bisa mengandung huruf, angka, tanda hubung, dan garis bawah.',
    'alpha_num' => ':attribute hanya bisa mengandung huruf dan angka.',
    'array' => ':attribute harus berbentuk array.',
    'before' => ':attribute harus kurang dari :date.',
    'before_or_equal' => ':attribute harus kurang atau sama dengan :date.',
    'between' => [
        'numeric' => ':attribute harus di antara :min dan :max.',
        'file' => ':attribute harus di antara :min dan :max kilobytes.',
        'string' => ':attribute harus di antara :min dan :max karakter.',
        'array' => ':attribute harus di antara :min dan :max item.',
    ],
    'boolean' => ':attribute harus true atau false.',
    'confirmed' => ':attribute tidak cocok dengan kolom konfirmasi.',
    'date' => ':attribute bukan tanggal yang valid.',
    'date_equals' => ':attribute harus sama dengan :date.',
    'date_format' => ':attribute tidak sesuai dengan format :format.',
    'different' => ':attribute dan :other harus berbeda.',
    'digits' => ':attribute harus berjumlah :digits digit.',
    'digits_between' => ':attribute harus berjumlah antara :min dan :max digit.',
    'dimensions' => ':attribute memiliki ukuran dimensi yang salah.',
    'distinct' => ':attribute memiliki nilai yang sama.',
    'email' => ':attribute harus email yang valid.',
    'ends_with' => ':attribute harus berakhir dengan: :values.',
    'exists' => ':attribute yang dipilih tidak valid.',
    'file' => ':attribute harus berbentuk file.',
    'filled' => ':attribute harus memiliki nilai.',
    'gt' => [
        'numeric' => ':attribute harus lebih besar dari :value.',
        'file' => ':attribute harus lebih besar dari :value kilobytes.',
        'string' => ':attribute harus lebih panjang dari :value karakter.',
        'array' => ':attribute harus memiliki item lebih banyak dari :value.',
    ],
    'gte' => [
        'numeric' => ':attribute harus lebih besar dari :value.',
        'file' => ':attribute harus lebih besar dari :value kilobytes.',
        'string' => ':attribute harus lebih panjang dari :value karakter.',
        'array' => ':attribute harus memiliki item lebih banyak dari :value.',
    ],
    'image' => ':attribute harus berbentuk gambar.',
    'in' => ':attribute yang dipilih tidak valid.',
    'in_array' => ':attribute tidak ada di :other.',
    'integer' => ':attribute harus merupakan bilangan bulat.',
    'ip' => ':attribute harus merupakan IP yang valid.',
    'ipv4' => ':attribute harus merupakan IPv4 yang valid.',
    'ipv6' => ':attribute harus merupakan IPv6 yang valid.',
    'json' => ':attribute harus merupakan JSON yang valid.',
    'lt' => [
        'numeric' => ':attribute harus lebih kecil dari :value.',
        'file' => ':attribute harus lebih kecil dari :value kilobytes.',
        'string' => ':attribute harus lebih pendek dari :value karakter.',
        'array' => ':attribute harus memiliki item lebih sedikit dari :value.',
    ],
    'lte' => [
        'numeric' => ':attribute harus kurang atau sama dengan :value.',
        'file' => ':attribute harus kurang atau sama dengan :value kilobytes.',
        'string' => ':attribute harus kurang atau sama dengan :value karakter.',
        'array' => ':attribute harus memiliki kurang atau sama dengan :value item.',
    ],
    'max' => [
        'numeric' => ':attribute harus tidak lebih besar dari :max.',
        'file' => ':attribute harus tidak lebih besar dari :max kilobytes.',
        'string' => ':attribute harus tidak lebih panjang dari :max karakter.',
        'array' => ':attribute harus memiliki item kurang dari :max.',
    ],
    'mimes' => ':attribute harus merupakan file dengan tipe: :values.',
    'mimetypes' => ':attribute harus merupakan file dengan tipe: :values.',
    'min' => [
        'numeric' => ':attribute ini harus minimal senilai :min.',
        'file' => ':attribute ini harus minimal sebesar :min kilobytes.',
        'string' => ':attribute ini harus minimal sepanjang :min karakter.',
        'array' => ':attribute ini harus memiliki item minimal :min.',
    ],
    'multiple_of' => ':attribute harus merupakan kelipatan dari :value.',
    'not_in' => ':attribute yang dipilih tidak valid.',
    'not_regex' => ':attribute tidak memiliki format yang valid.',
    'numeric' => ':attribute harus berbentuk angka.',
    'password' => 'Kata sandi salah.',
    'present' => ':attribute harus ada.',
    'regex' => ':attribute memiliki format yang salah.',
    'required' => ':attribute diperlukan.',
    'required_if' => ':attribute diperlukan jika :other bernilai :value.',
    'required_unless' => ':attribute diperlukan kecuali kalau :other memiliki :values.',
    'required_with' => ':attribute diperlukan ketika :values ada.',
    'required_with_all' => ':attribute diperlukan ketika :values ada.',
    'required_without' => ':attribute diperlukan ketika :values tidak ada.',
    'required_without_all' => ':attribute diperlukan ketika :values tidak ada.',
    'prohibited_if' => ':attribute dilarang apabila :other bernilai.',
    'prohibited_unless' => ':attribute dilarang kecuali kalau :other memiliki :values.',
    'same' => ':attribute dan :other harus sama.',
    'size' => [
        'numeric' => ':attribute harus berukuran :size.',
        'file' => ':attribute harus berukuran :size kilobytes.',
        'string' => ':attribute harus sepanjang :size karakter.',
        'array' => ':attribute harus memiliki item sebanyak :size.',
    ],
    'starts_with' => ':attribute harus dimulai dengan: :values.',
    'string' => ':attribute harus berbentuk string.',
    'timezone' => ':attribute harus merupakan zona waktu yang valid.',
    'unique' => ':attribute sudah ada.',
    'uploaded' => ':attribute gagal diunggah.',
    'url' => ':attribute memiliki format url yang salah.',
    'uuid' => ':attribute harus merupakan UUID yang valid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
