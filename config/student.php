<?php
// config/student.php

return [

    
    'genders' => [
        1 => 'Male',
        2 => 'Female',
        3 => 'Transgender',
    ],



    'social_categories' => [
    1 => 'GENERAL',
    2 => 'SC',
    3 => 'ST',
    4 => 'OBC',
    5 => 'OTHERS',
    6 => 'NOT APPLICABLE',
    ],


    // 'accademic' => [
    // 1 => '',
    // 2 => 'SC',
    // 3 => 'ST',
    // 4 => 'OBC',
    // 5 => 'OTHERS',
    // 6 => 'NOT APPLICABLE',
    // ],

'prev_class_appeared_exam' => [
        1 => 'Appeared',
        0 => 'Not Appeared',
    ],
'accademic_year' => [
        2025 => '2025',
        2026 => '2026',
    ],


    'religions' => [
        12 => 'CWSN',
        0  => 'HINDU',
        5  => 'MUSLIM',
        6  => 'CHRISTIAN',
        7  => 'SIKH',
        8  => 'BUDDHIST',
        9  => 'PARSI',
        10 => 'JAIN',
        11 => 'OTHERS',
    ],

    'yes_no' => [
        1 => 'Yes',
        2 => 'No',
    ],

    'relationship_with_guardian' => [
        1 => 'FATHER',
        2 => 'MOTHER',
        3  => 'OTHER',
    ],

  

        'blood_groups' => [
        1 => 'A+',
        2 => 'A-',
        3 => 'B+',
        4 => 'B-',
        5 => 'AB+',
        6 => 'AB-',
        7 => 'O+',
        8 => 'O-',
    ],


   

    'family_annual_incomes' => [
        1 => '0-50,000',
        2 => '50,001-1,20,000',
        3 => '1,20,001-2,50,000',
        4 => '2,50,000-5,00,00',   // Keeping your original value (looks like 5,00,000 missing one zero)
        5 => 'Above 5,00,000',
    ],


   

    'guardian_qualifications' => [
    1 => 'GRADUATE',
    2 => 'BELOW GRADUATE',
    3 => 'POST GRADUATE',
],



    'nationalities' => [
        1 => 'Indian',
        2  => 'Other',
    ],


 'mother_tongues' => [
        30 => 'SANTHALI',
        99 => 'OTHER LANGUAGES',
        18 => 'URDU',
        53 => 'ORIYA(LOWER)',
        11 => 'NEPALI',
        14 => 'SANSKRIT',
        10 => 'MARATHI',
        7  => 'KONKANI',
        44 => 'BHOTI',
        47 => 'KAKBARAK',
        48 => 'KONYAK',
        5  => 'KANNADA',
        8  => 'MALAYALAM',
        58 => 'SEMA',
        25 => 'MIZO',
        29 => 'FRENCH',
        60 => 'TIBETA',
        49 => 'LADDAKHI',
        61 => 'ZELIANG',
        21 => 'MISING',
        17 => 'TELUGU',
        55 => 'PORTUGUESE',
        23 => 'KHASI',
        4  => 'HINDI',
        6  => 'KASHMIRI',
        13 => 'PUNJABI',
        45 => 'BODHI',
        27 => 'LEPCHA',
        9  => 'MANIPURI',
        50 => 'LOTHA',
        42 => 'AO',
        51 => 'MAITHILI',   // id 51
        3  => 'GUJARATI',
        40 => 'MAITHILI',   // id 40 (duplicate label, different id)
        52 => 'NICOBAREE',
        43 => 'ARABIC',
        46 => 'GERMA',
        15 => 'SINDHI',
        54 => 'PERSIA',
        22 => 'DOGRI',
        28 => 'LIMBOO',
        16 => 'TAMIL',
        24 => 'GARO',
        59 => 'SPANISH',
        41 => 'ANGAMI',
        12 => 'ORIYA',
        20 => 'BODO',
        56 => 'RAJASTHANI',
        26 => 'BHUTIA',
        19 => 'ENGLISH',
        57 => 'RUSSIA',
        2  => 'ASSAMESE',
        1  => 'BENGALI',
    ],
    // Add any other dropdown groups you need...
];
