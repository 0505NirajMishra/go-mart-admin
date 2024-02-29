<?php

use App\Services\ManagerLanguageService;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

$mls = new ManagerLanguageService('lang_breadcrumbs');

/*------------- Admin Dashboard (Admin Home) -------------*/
// Home
Breadcrumbs::for('admin.dashboard', function ($trail) use ($mls) {
    $trail->push($mls->messageLanguage('only_name', 'dashboard', 2), route('admin.dashboard'));
});

Breadcrumbs::for("admin.profile", function ($trail) use ($mls) {
    $trail->parent("admin.dashboard");
    $trail->push($mls->messageLanguage('only_name', 'profile', 2), route("admin.profile"));
});
Breadcrumbs::for("admin.change-password", function ($trail) use ($mls) {
    $trail->parent("admin.dashboard");
    $trail->push($mls->messageLanguage('only_name', 'change_password', 2), route("admin.change_password"));
});

// general Settings
Breadcrumbs::for('admin.settings.edit_general', function ($trail) {
    $trail->parent("admin.dashboard");
    $trail->push('Settings - General', route("admin.settings.edit_general"));
});

Breadcrumbs::macro('resource', function ($name, $title, $list = false) {
    // Home > $title
    Breadcrumbs::for("admin.$name.index", function ($trail) use ($name, $title) {
        $trail->parent("admin.dashboard");
        $trail->push($title, route("admin.$name.index"));
    });

    // Home > $title > Add New
    Breadcrumbs::for("admin.$name.create", function ($trail) use ($name, $title) {
        $trail->parent("admin.$name.index");
        $trail->push("Add New $title", route("admin.$name.create"));
    });
// My Changes
      Breadcrumbs::for("admin.$name.excel", function ($trail) use ($name, $title) {
        $trail->parent("admin.$name.index");
        $trail->push("Add New $title", route("admin.$name.excel"));
    });
//      
    // Home > $title > Edit
    Breadcrumbs::for("admin.$name.edit", function ($trail) use ($name, $title) {
        $trail->parent("admin.$name.index");
        $trail->push("Edit $title", url("admin/$name/{id}/edit"));
    });
    // Home > $title > Details
    Breadcrumbs::for("admin.$name.show", function ($trail) use ($name, $title) {
        $trail->parent("admin.$name.index");
        $trail->push(" Details", url("admin/$name/{id}"));
    });
    Breadcrumbs::for("admin.$name.rating", function ($trail) use ($name, $title) {
        $trail->parent("admin.$name.index");
        $trail->push(" Details", url("admin/$name/{id}"));
    });
     Breadcrumbs::for("admin.$name.win", function ($trail) use ($name, $title) {
        $trail->parent("admin.$name.index");
        $trail->push(" Details", url("admin/$name/{id}"));
    });
    if ($list == true) {
        Breadcrumbs::for("admin.$name.list", function ($trail) use ($name, $title) {
            $trail->parent("admin.dashboard");
            $trail->push($title, route("admin.$name.list"));
        });
    }
});

/*------------- Admin Users ------------------------*/
Breadcrumbs::resource('users', $mls->messageLanguage('only_name', 'user', 2));
/*------------- Admin Roles ------------------------*/
Breadcrumbs::resource('roles', $mls->messageLanguage('only_name', 'role', 2));
/*------------- Admin Permissions ------------------------*/
Breadcrumbs::resource('permissions', $mls->messageLanguage('only_name', 'permission', 2));
/*------------- Admin Category ------------------------*/
Breadcrumbs::resource('categorys', $mls->messageLanguage('only_name', 'category', 2));
/*------------- Admin Subcategory ------------------------*/
Breadcrumbs::resource('subcategorys', $mls->messageLanguage('only_name', 'subcategory', 2));
/*------------- Admin Item ------------------------*/
Breadcrumbs::resource('items', $mls->messageLanguage('only_name', 'item', 2));
/*------------- Admin Banner ------------------------*/
Breadcrumbs::resource('banners', $mls->messageLanguage('only_name', 'banner', 2));
/*------------- Admin Notification ------------------------*/
Breadcrumbs::resource('notifications', $mls->messageLanguage('only_name', 'notification', 2));
/*------------- Admin Order ------------------------*/
Breadcrumbs::resource('orders', $mls->messageLanguage('only_name', 'order', 2));
/*------------- Admin Order Review ------------------------*/
Breadcrumbs::resource('reviews', $mls->messageLanguage('only_name', 'review', 2));
/*------------- Admin Global Setting  ------------------------*/
Breadcrumbs::resource('globals', $mls->messageLanguage('only_name', 'global', 2));
/*------------- Admin Currency Setting  ------------------------*/
Breadcrumbs::resource('currencys', $mls->messageLanguage('only_name', 'currency', 2));
/*------------- Admin Coupan Setting  ------------------------*/
Breadcrumbs::resource('coupans', $mls->messageLanguage('only_name', 'coupan', 2));
/*------------- Admin language Setting  ------------------------*/
Breadcrumbs::resource('languages', $mls->messageLanguage('only_name', 'language', 2));
/*------------- Admin Commission Setting  ------------------------*/
Breadcrumbs::resource('commissions', $mls->messageLanguage('only_name', 'commission', 2));
/*------------- Admin Radius CONFIGURATION Setting  ------------------------*/
Breadcrumbs::resource('radiuss', $mls->messageLanguage('only_name', 'radius', 2));
/*------------- Admin Val Setting  ------------------------*/
Breadcrumbs::resource('vats', $mls->messageLanguage('only_name', 'vat', 2));
/*------------- Admin Delivery Charge Setting  ------------------------*/
Breadcrumbs::resource('deliverycharges', $mls->messageLanguage('only_name', 'deliverycharge', 2));
/*------------- Admin Special Offer Setting  ------------------------*/
Breadcrumbs::resource('specialoffers', $mls->messageLanguage('only_name', 'specialoffer', 2));
/*------------- Admin Store Payment Setting  ------------------------*/
Breadcrumbs::resource('storepayments', $mls->messageLanguage('only_name', 'storepayment', 2));
/*------------- Admin Store Payout Setting  ------------------------*/
Breadcrumbs::resource('storepayouts', $mls->messageLanguage('only_name', 'storepayout', 2));
/*------------- Admin Driver Payment Setting  ------------------------*/
Breadcrumbs::resource('driverpayments', $mls->messageLanguage('only_name', 'driverpayment', 2));
/*------------- Admin Wallet Transaction Setting  ------------------------*/
Breadcrumbs::resource('wallettransactions', $mls->messageLanguage('only_name', 'wallettransaction', 2));
/*------------- Admin Order Transaction Setting  ------------------------*/
Breadcrumbs::resource('ordertransactions', $mls->messageLanguage('only_name', 'ordertransaction', 2));
/*------------- Admin Driver Setting  ------------------------*/
Breadcrumbs::resource('drivers', $mls->messageLanguage('only_name', 'driver', 2));
/*------------- Admin Store Menu ------------------------*/
Breadcrumbs::resource('stores', $mls->messageLanguage('only_name', 'store', 2));
/*------------- Admin Payment Menu ------------------------*/
Breadcrumbs::resource('payments', $mls->messageLanguage('only_name', 'payment', 2));