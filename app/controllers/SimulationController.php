<?php

namespace app\controllers;

use app\models\Mif2;
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
            Simulations::createSimulation($post);
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

    public function zip($sim_id = null) {

        if ($sim_id) {
            $simulation = Simulations::find('first', array('conditions' => array('id' => $sim_id)));
            $zip = Simulations::generateZip($simulation);

            return $this->redirect($zip);
        }
    }

    public function api($sim_id = null)
    {
        if ($sim_id) {

            $simulation = Simulations::find('first', array('conditions' => array('id' => $sim_id)));

            $outputs = Simulations::generateOutput($simulation);

            return compact('simulation', 'outputs');
        }
    }
}

?>