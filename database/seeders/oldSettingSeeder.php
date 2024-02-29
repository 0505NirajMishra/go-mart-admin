<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // public function run()
    // {
    //     $query =  'INSERT INTO `settings` (`id`, `title`, `slug`, `value`, `field_type`, `setting_type`, `created_at`, `updated_at`, `deleted_at`) VALUES
    //     (1,	'site_name',	'site_name',	'Ludo',	'text',	1,	NULL,	'2022-03-03 13:02:17',	NULL),
    //     (2,	'home_page_title',	'home_page_title',	'Ludo',	'text',	1,	NULL,	'2022-03-03 13:02:17',	NULL),
    //     (3,	'logo',	'logo',	'Laravel-logo.jpg',	'text',	1,	NULL,	'2022-03-03 13:00:09',	NULL),
    //     (4,	'site_mode',	'site_mode',	'2',	'text',	1,	NULL,	'2022-03-03 13:01:58',	NULL),
    //     (5,	'site_maintenance_message',	'site_maintenance_message',	'<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\" \"http://www.w3.org/TR/REC-html40/loose.dtd\">\r\n<html><body><p>fghfghfgh<img style=\"width: 477.569px;\" data-filename=\"pexels-pixabay-461428.jpg\" src=\"/storage/files/settings/16256600900.jpeg\"></p',	'text',	1,	NULL,	'2021-07-07 17:44:50',	NULL),
    //     (6,	'copyright_text',	'copyright_text',	'2022© Freelance',	'text',	1,	NULL,	'2022-02-24 08:55:57',	NULL),
    //     (7,	'favicon',	'favicon',	'Laravel-favicon.jpg',	'text',	1,	'2021-03-08 00:10:46',	'2022-03-03 13:00:09',	NULL),
    //     (8,	'admin_email',	'admin_email',	'info@ludo.com',	'text',	2,	'2021-03-08 06:49:38',	'2021-09-14 17:17:00',	NULL),
    //     (9,	'support_email',	'support_email',	'info@ludo.com',	'text',	2,	'2021-03-08 06:49:39',	'2021-09-14 17:17:00',	NULL),
    //     (10,	'no_reply_email',	'no_reply_email',	'info@ludo.com',	'text',	2,	'2021-03-08 06:49:39',	'2021-09-14 17:17:00',	NULL),
    //     (11,	'application_from_email_address',	'application_from_email_address',	'info@ludo.com',	'text',	2,	'2021-03-08 06:49:39',	'2021-09-14 17:17:00',	NULL),
    //     (12,	'enable_otp',	'enable_otp',	'1',	'text',	4,	'2021-03-09 00:27:54',	'2021-03-09 00:28:11',	NULL),
    //     (13,	'Address',	'address',	'fdudshfihsalikfnadsf',	NULL,	1,	'2022-02-24 06:15:45',	'2022-02-24 06:23:29',	NULL),
    //     (14,	'Contact Number',	'contact_number',	'4567891325',	NULL,	1,	'2022-02-24 06:15:45',	'2022-02-24 06:23:29',	NULL)';
    //     DB::insert($query);
    // }
}