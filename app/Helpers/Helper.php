<?php

use Carbon\Carbon;
use App\Models\Page;
use Efectn\Menu\Models\Menus;
use App\Services\DeepLService;

function buildIsUserBadge($isUser)
{
    $result = "";
    $text = $isUser == 1 ? __("As a User") : __("Not As a User");
    switch ($isUser) {
        case 1:
            $result = "bg-success";
            break;
        default:
            $result = "bg-danger";
            break;
    }
    return "<span class='badge $result rounded-pill p-2'>$text</span>";
}
function buildCheckbox($row)
{

    return "<input type='checkbox' class='form-check-input checkbox' name='id[]' style='--bs-form-check-bg:#b3b3b3 !important' value='{$row->id}' />";
}
function buildActionTrash($restore, $delete, $row)
{
    return " <div class='btn-group' role='group'>
                    <form action='{$restore}' method='POST' style='display:inline-block;' class='restore-form'>
                        <input type='hidden' name='id' value='{$row->id}'>
                        <button type='submit' class='btn btn-sm btn-success me-2 restore' data-bs-toggle='tooltip' data-bs-placement='bottom' title='" . __("Restore") . "'>
                            <i class='mdi mdi-reload'></i>
                        </button>
                    </form>
                   <form action='{$delete}' method='POST' style='display:inline-block;' class='delete-form'>
                        <input type='hidden' name='id' value='{$row->id}'>
                        <button type='submit' class='btn btn-sm btn-danger me-2 delete' data-bs-toggle='tooltip' data-bs-placement='bottom' title='" . __("Delete") . "'>
                            <i class='mdi mdi-delete'></i>
                        </button>
                    </form>
                </div>";
}

function buildBadge($color, $text)
{
    $result = "";
    switch ($color) {
        case 1:
            $result = "bg-primary";
            break;
        case 2:
            $result = "bg-secondary";
            break;
        case 3:
            $result = "bg-warning";
            break;
        case 4:
            $result = "bg-dark";
            break;
        case 5:
            $result = "bg-danger";
            break;
        default:
            $result = "bg-info";
            break;
    }
    return "<span class='badge $result rounded-pill me-1'>$text</span>";
}
function toDateIndo($tgl, $tampil_hari = true, $with_menit = true)
{
    if ($tgl != null ||  $tgl != "") {
        $nama_hari    =   array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu");
        $nama_bulan   =   array(
            1 => "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember"
        );
        $tahun        =   substr($tgl, 0, 4);
        $bulan        =   $nama_bulan[(int)substr($tgl, 5, 2)];
        $tanggal      =   substr($tgl, 8, 2);

        $text         =   "";

        if ($tampil_hari) {

            $urutan_hari  =   date('w', mktime(0, 0, 0, substr($tgl, 5, 2), $tanggal, $tahun));
            $hari         =   $nama_hari[$urutan_hari];
            $text         .=  $hari . ", ";
        }

        $text         .= $tanggal . " " . $bulan . " " . $tahun;

        if ($with_menit) {

            $jam    =   substr($tgl, 11, 2);
            $menit  =   substr($tgl, 14, 2);

            $text   .=  ", " . $jam . ":" . $menit;
        }
    } else {

        $text = "-";
    }
    return $text;
}
function formatLocalizedDate($tgl, $format = 'l, d F Y')
{
    if ($tgl) {
        $date = Carbon::parse($tgl);
        Carbon::setLocale(config("app.locale"));
        return $date->translatedFormat($format);
    }

    return '-';
}

function whatsappFormat($phone = null)
{
    $phone = str_replace([' ', '-'], '', $phone);

    // Memeriksa jika diawali dengan +62
    if (strpos($phone, '+62') === 0) {
        // Menghapus + dan mengganti dengan 62
        $phone = '62' . substr($phone, 3);
    } elseif (strpos($phone, '+') === 0) {
        // Mengizinkan tanda + jika kode negara lain
        // Hanya menghapus tanda hubung
        $phone = str_replace('-', '', $phone);
    }

    return $phone;
}
function getMenu()
{
    $menu = Menus::where('name', "Landing Page")->with('items')->first();
    return $menu->items->toArray();
}
function getPage()
{
    $page = Page::orderBy('title')->get(['title', 'slug']);
    $page->push((object)["title" => "URL Custom", "slug" => "url-custom"]);
    return $page;
}
function formatSizeUnits($bytes, $precision = 2)
{
    $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

    $power = $bytes > 0 ? floor(log($bytes, 1024)) : 0;

    $formattedSize = number_format($bytes / pow(1024, $power), $precision, '.', ',');

    return $formattedSize . ' ' . $units[$power];
}

function translate($text, $locale)
{
    return $text;
    $deepl = new DeepLService();
    $result =  $locale == "id" ? $text : $deepl->translate($text, $locale);
    return $result;
}

function convertYoutubeUrlToEmbed($url)
{
    $urlParts = parse_url($url);   
    if (isset($urlParts['host']) && strpos($urlParts['host'], 'youtube.com') !== false) {
        if (isset($urlParts['query'])) {
            parse_str($urlParts['query'], $queryParams);
            
            // If the 'v' parameter exists, construct the embed URL
            if (isset($queryParams['v'])) {
                return 'https://www.youtube.com/embed/' . $queryParams['v'];
            }
        }
    }
    return $url;
}
