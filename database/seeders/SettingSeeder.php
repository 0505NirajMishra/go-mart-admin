<?php

namespace Database\Seeders;

use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'title' => 'site_name',
                'slug' => 'site-name',
                'value' => 'Common-Setup',
                'field_type' => 'text',
                'setting_type' => '1',
                'created_at' => Carbon::now()
            ],
            // [
            //     'title' => 'agora_server_key',
            //     'slug' => 'agora_server_key',
            //     'value' => 'AAAAk0BXOJU:APA91bF4gDE7JUV-SWpzk3Mg0YNylsFZQtqUrVlWhvg1PXDABnzRlVyfPoQYDuVqL2-xnj7iUgxPard_arh_ikAfoiSTWKBOAoTj84cnWYrau7ccviKf2bmOiq516eclGshBjm9Pbq5T',
            //     'field_type' => 'text',
            //     'setting_type' => '1',
            //     'created_at' => Carbon::now()
            // ],
            // // [
            //     'title' => 'app_key',
            //     'slug' => 'logo',
            //     'value' => 'laravel-logo.jpeg',
            //     'field_type' => 'text',
            //     'setting_type' => '1',
            //     'created_at' => Carbon::now()
            // ],
            [
                'title' => 'near_adventure',
                'slug' => 'near_adventure',
                'value' => 'da61b3fdbc86475e907b1aecb03fb418',
                'field_type' => 'text',
                'setting_type' => '1',
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'trip_radius',
                'slug' => 'trip_radius',
                'value' => '22715534870322715534870322715534',
                'field_type' => 'text',
                'setting_type' => '1',
                'created_at' => Carbon::now()
            ],
            // [
            //     'title' => 'copyright_text',
            //     'slug' => 'copyright_text',
            //     'value' => '2022©Deorwine',
            //     'field_type' => 'text',
            //     'setting_type' => '1',
            //     'created_at' => Carbon::now()
            // ],
            // [
            //     'title' => 'payment_iv',
            //     'slug' => 'payment_iv',
            //     'value' => 'PGKEYENCDECIVSPC',
            //     'field_type' => 'text',
            //     'setting_type' => '1',
            //     'created_at' => Carbon::now()
            // ],
            // [
            //     'title' => 'admin_email',
            //     'slug' => 'admin_email',
            //     'value' => 'info@cashcry.com',
            //     'field_type' => 'text',
            //     'setting_type' => '2',
            //     'created_at' => Carbon::now()
            // ],
            // [
            //     'title' => 'payment_padding',
            //     'slug' => 'payment_padding',
            //     'value' => 'PKCS7',
            //     'field_type' => 'text',
            //     'setting_type' => '1',
            //     'created_at' => Carbon::now()
            // ],

            // [
            //     'title' => 'encryption_id',
            //     'slug' => 'encryption_id',
            //     'value' => '71yMs3Wq2V0mJmV',
            //     'field_type' => 'text',
            //     'setting_type' => '1',
            //     'created_at' => Carbon::now()
            // ],

            // [
            //     'title' => 'payment_id',
            //     'slug' => 'payment_id',
            //     'value' => 'IPAYlCR6qZF7q6w',
            //     'field_type' => 'text',
            //     'setting_type' => '1',
            //     'created_at' => Carbon::now()
            // ],

            // [
            //     'title' => 'payment_password',
            //     'slug' => 'payment_password',
            //     'value' => 'isH7i87I!!iH1C!',
            //     'field_type' => 'text',
            //     'setting_type' => '1',
            //     'created_at' => Carbon::now()
            // ],
            // [
            //     'title' => 'no_reply_email',
            //     'slug' => 'no_reply_email',
            //     'value' => 'info@cashcry.com',
            //     'field_type' => 'text',
            //     'setting_type' => '2',
            //     'created_at' => Carbon::now()
            // ],
            [
                'title' => 'application_from_email_address',
                'slug' => 'application_from_email_address',
                'value' => 'info@cashcry.com',
                'field_type' => 'text',
                'setting_type' => '2',
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'enable_otp',
                'slug' => 'enable_otp',
                'value' => '1',
                'field_type' => 'text',
                'setting_type' => '4',
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'Address',
                'slug' => 'address',
                'value' => 'fdudshfihsalikfnadsf',
                'field_type' => 'text',
                'setting_type' => '1',
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'Contact Number',
                'slug' => 'contact_number',
                'value' => '4567891325',
                'field_type' => 'text',
                'setting_type' => '1',
                'created_at' => Carbon::now()
            ],
        ];

        Setting::insert($data);
    }
}
