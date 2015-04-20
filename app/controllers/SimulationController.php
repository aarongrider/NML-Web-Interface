<?php

namespace app\controllers;

use app\models\Simulations;

class SimulationController extends \lithium\action\Controller {

    public function index() {

    }

    // Form submission to generate a OOMMF project file
    public function generate() {

        $success = false;

        if ($this->request->data) // If we have submitted the form
        {
            $post = $this->request->data;
            $zipname = Simulations::createSimulation($post);
            $success = true;
        }

        return compact('form', 'success', 'zipname');
    }

    // List all recently generated files
    public function log($simid = null) {

        if ($simid == null)
        {
            $simulations = Simulations::find('all', array(
                'order' => array('id' => 'DESC')
            ));
        }

        return compact('simulations');

    }
}

?>