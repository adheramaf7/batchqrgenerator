<?php

namespace App\Http\Controllers;

use ZipArchive;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use App\Imports\DataQrImport;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class GenerateQrController extends Controller
{

    public function __invoke(Request $request)
    {
        $data = (new DataQrImport)->toArray($request->file('upload'));

        $time = time();
        $folder = "generated/$time/";

        $zip = new ZipArchive;
        $zip->open("generated-$time.zip", ZipArchive::CREATE | ZipArchive::OVERWRITE);
        foreach ($data[0] as $key => $item) {
            $image = QrCode::format('png')->size(400)->errorCorrection('H')->generate($item['value']);

            $filePath = $folder . $item['title'] . '.png';
            Storage::disk('local')->put($filePath, $image);

            $zip->addFile(storage_path('app/' . $filePath), $item['title'] . '.png');
        }
        $zip->close();

        Storage::deleteDirectory($folder);

        return response()->download("generated-$time.zip");
    }
}
