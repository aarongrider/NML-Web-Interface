<h1>Simulation Log</h1>

<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-condensed">
    <thead>
    <tr>
        <th class="column-sm">Simulation Id</th>
        <th class="column-sm">H-Range</th>
        <th class="column-sm">Stopping Time</th>
        <th class="column-sm">Modified</th>
        <th class="column-sm"></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($simulations as $simulation) { ?>

        <tr>
            <td> <?php echo $h($simulation->id); ?> </td>
            <td> <?php echo $h($simulation->hrange); ?> </td>
            <td> <?php echo $h($simulation->stoppingtime); ?> </td>
            <td> <?php echo $h($simulation->modified); ?> </td>
            <td> <a href="<?php echo $h($simulation->zip); ?>" class="btn">Download</a> </td>
        </tr>

    <?php } ?>
    </tbody>
</table>