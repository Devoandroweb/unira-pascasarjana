<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Factory;
use ZipArchive;

class UpdaterController extends Controller
{
    public function index()
    {
        $title = __("About");
        return view('pages.dashboard.about.index', compact('title'));
    }
    function update()
    {
        try {
            $firebase = App::make('firebase');
            $version = $firebase->getReference('web_version')->getValue();
            $versionNumber = $firebase->getReference('web_version_number')->getValue();

            $localVersion = settings()->get('web_version');
            $localVersionNumber = settings()->get('web_version_number');
            if ((int)$localVersionNumber < (int)$versionNumber) {

                $this->download();
                settings()->set('web_version', $version);
                settings()->set('web_version_number', $versionNumber);

                return response()->json(["status" => true, "message" => __("Updated Successfully"), "version" => $version]);
            }
            return response()->json(["status" => true, "message" => __("Already Updated"), "version" => $localVersion]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json(["status" => false, "message" => __("Update Failed")]);
            //throw $th;

        }
    }
    public function download()
    {
        $firebase = (new Factory)
            ->withServiceAccount(config('firebase.credentials'))
            ->createStorage();

        $firebaseFilePath = "updater.zip";

        $fileName = "updater.zip";
        // Tentukan bucket (opsional jika default)
        $bucket = $firebase->getBucket();

        // Lokasi file di Firebase Storage
        $fileReference = $bucket->object($firebaseFilePath);

        // Tentukan path untuk menyimpan file yang diunduh
        $localFilePath = public_path("app/" . $fileName);

        // Download file
        $fileReference->downloadToFile($localFilePath);

        $zipPath = public_path('app/updater.zip'); // Path ZIP file
        $fileNameToExtract = 'updater.json'; // Nama file yang ingin diekstrak
        $destinationPath = public_path('app'); // Path tujuan

        $this->extractSingleFile($zipPath, $fileNameToExtract, $destinationPath);

        $this->exctractZip();
        // etract
    }
    function exctractZip()
    {
        // Baca isi file JSON
        $fileMappings = json_decode(file_get_contents(public_path("app/updater.json")), true)['files'];

        $zipPath = public_path("app/updater.zip");
        // Ekstrak file ZIP
        $zip = new ZipArchive;

        if ($zip->open($zipPath) === TRUE) {
            // Loop melalui file mappings
            foreach ($fileMappings as $fileMapping) {
                $sourceFile = $fileMapping['source'];
                $destinationPath = base_path($fileMapping['destination']);

                // Buat folder jika belum ada
                $destinationDir = dirname($destinationPath);
                if (!file_exists($destinationDir)) {
                    mkdir($destinationDir, 0755, true);
                }

                // Cek apakah file ada dalam ZIP dan pindahkan ke folder yang sesuai
                if ($zip->locateName($sourceFile) !== false) {
                    $stream = $zip->getStream($sourceFile);
                    if ($stream) {
                        // Tulis ke file tujuan
                        file_put_contents($destinationPath, stream_get_contents($stream));
                        fclose($stream);
                    }
                }
            }
            $zip->close();
        }
    }
    function extractSingleFile($zipPath, $fileNameToExtract, $destinationPath)
    {
        $zip = new ZipArchive;

        if ($zip->open($zipPath) === TRUE) {
            // Cek apakah file yang ingin diekstrak ada di dalam ZIP
            if ($zip->locateName($fileNameToExtract) !== false) {
                // Ekstrak file ke tujuan
                $zip->extractTo($destinationPath, $fileNameToExtract);
                $zip->close();
            } else {
                $zip->close();
            }
        } else {
            return false;
        }
    }
}
