<h1>Generate Simulation</h1>

<div class="add-job-wrap">
    <?php echo $this->form->create(); ?>

    <div class="form-group">
        <?php echo $this->form->field('hrange', array('value' => '1.7', 'class' => 'form-control')); ?>
    </div>

    <div class="form-group">
        <?php echo $this->form->field('stoppingtime', array('value' => '1', 'class' => 'form-control')); ?>
    </div>

    <?php echo $this->form->submit('Submit', array('class' => 'btn')); ?>

    <?php echo $this->form->end(); ?>
</div>


<?php if ($success): ?>
    <p><span class="label label-success"> Generated Successfully </span></p>
    <a href="<?php echo $h($zipname); ?>" class="btn">Download Files</a>
<?php endif; ?>