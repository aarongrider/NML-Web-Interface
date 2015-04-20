<?php

namespace app\models;

use ZipArchive;

class Simulations extends \lithium\data\Model {

    public static function createSimulation($post) {
        $simulation = Simulations::create($post);
        $simulation->modified = date('Y-m-d H:i:s');
        $simulation->save();

        $zipname = Simulations::generateOutput($simulation);
        $simulation->zip = $zipname;
        $simulation->save();

        return $zipname;
    }

    public static function generateOutput($simulation) {
        $hrange = $simulation->hrange;

        $file = './source/source.mif2';
        $newfile = './tmp/result.mif2';

        if (!copy($file, $newfile)) {
            echo "failed to copy $file...\n";
        }

        $zip = new ZipArchive();
        $zipname = "/tmp/results" . $simulation->id . ".zip";

        if ($zip->open("." . $zipname, ZipArchive::CREATE)!==TRUE) {
            exit("cannot open <$zipname>\n");
        }

        $zip->addFile($newfile, 'result.mif2'); // MIF2
        $zip->addFile('./source/source.omf', 'result.omf'); // OMF
        $zip->addFile('./source/source.ppm', 'result.ppm'); // PPM

        $zip->close();

        return $zipname;
    }

}

?>