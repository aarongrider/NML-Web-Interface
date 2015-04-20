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

        $newfile = './tmp/result.mif2';
        $mif_file = fopen($newfile, "w") or die("Unable to open file!");
        Simulations::MIF2_writeModuleText($mif_file, $simulation);
        fclose($mif_file);

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

    public static function MIF2_writeModuleText($file, $simulation) {

        $modules = Mif2::find('all');

        $vars = array(
            '{$hrange}' => $simulation->hrange,
            '{$stoppingtime}' => $simulation->stoppingtime,
        );

        foreach ($modules as $module) {

            $writeText = $module->text;
            fwrite($file, strtr($writeText . "\n\n", $vars));
        }
    }

}

?>