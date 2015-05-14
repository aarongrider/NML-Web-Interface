<?php

namespace app\models;

use ZipArchive;

class Simulations extends \lithium\data\Model {

    public static function createSimulation($post) {
        $simulation = Simulations::create($post);
        $simulation->hrange = $post['startX'] . ' ' . $post['startY'] . ' ' . $post['startZ'] . ' ' . $post['endX'] . ' ' . $post['endY'] . ' ' . $post['endZ'] . ' ' . $post['steps'];
        $simulation->modified = date('Y-m-d H:i:s');
        $simulation->status = 1;
        $simulation->save();

        if ($simulation->run == 1) {
            Simulations::runSimulation($simulation);
        }
    }

    public static function runSimulation($simulation)
    {
        // ConnectorServer URL
        // TODO - Server list based on Simulation->run value
        $url = 'http://72.233.176.58:9000';

        // Post simulation to connector server
        //$job_url = $url . 'buildWithParameters/';
        $data = array('id' => $simulation->id);
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data),
            )
        );

        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        if ($result == $simulation->id)
        {
            echo '<div class="alert alert-success" role="alert">' . $simulation->id . ': Submitted Successfully</div>';
        }
    }

    public static function generateOutput($simulation) {

        $mif2 = Simulations::MIF2_generateModuleText($simulation);
        $omf = Omf::find('first', array('conditions' => array('id' => $simulation->omf)))->data;
        $ppm = Ppm::find('first', array('conditions' => array('id' => $simulation->ppm)))->data;

        return compact('mif2', 'omf', 'ppm');

    }

    public static function generateZip($simulation) {

        // Mif2 file
        $mif2 = Simulations::MIF2_generateModuleText($simulation);

        $newfile = './tmp/result.mif2';
        $mif_file = fopen($newfile, "w") or die("Unable to open file!");
        fwrite($mif_file, $mif2);
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

    public static function MIF2_generateModuleText($simulation) {

        // Generate Mif2 output
        $mif2 = "";
        $modules = Mif2::find('all');

        $vars = array(
            '{$hrange}' => $simulation->hrange,
            '{$stoppingtime}' => $simulation->stoppingtime,
        );

        foreach ($modules as $module) {

            $writeText = $module->text;
            $mif2 = $mif2 . strtr($writeText . "\n\n", $vars);

        }

        return $mif2;
    }

}

?>