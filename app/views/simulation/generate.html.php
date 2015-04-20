<h1>Generate Simulation</h1>

<div class="add-job-wrap">
    <?=$this->form->create(); ?>

    <div class="form-group">
        <?=$this->form->field('hrange', array('value' => '0.008 0 0 0 0 0 1', 'class' => 'form-control')); ?>
    </div>

    <div class="form-group">
        <?=$this->form->field('stoppingtime', array('value' => '1e-9', 'class' => 'form-control')); ?>
    </div>

    <?=$this->form->submit('Submit', array('class' => 'btn')); ?>

    <?=$this->form->end(); ?>
</div>


<?php if ($success): ?>
    <p><span class="label label-success"> Generated Successfully </span></p>
    <a href="<?=$zipname;?>" class="btn">Download Files</a>
<?php endif; ?>