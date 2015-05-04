<SCRIPT LANGUAGE="javascript">
    function changePicture()
    {
        var selection = document.document.getElementsById('ppm').selectedIndex; //grabs what user selected
        //document.pic.src = document.DropPicture.Picture.options[selection].value; //adds 'selection' to grab 'value'
        // <img src="../source/source_1.jpg" name="pic" border="0">
        document.pic.src = selection;
    }
</SCRIPT>

<h1>Generate Simulation</h1>

    <?=$this->form->create(); ?>

    <div class="form-inline">

        <br><h3>H-range</h3>
        <table cellpadding="0" cellspacing="0" border="0" class="table text-left">
            <tbody>
                <tr>
                    <td><div class="input-group"><div class="input-group-addon">Start X</div><input type="text" class="form-control" name="startX" value="0.008"></div></td>
                    <td><div class="input-group"><div class="input-group-addon">Start Y</div><input type="text" class="form-control" name="startY" value="0"></div></td>
                    <td><div class="input-group"><div class="input-group-addon">Start Z</div><input type="text" class="form-control" name="startZ" value="0"></div></td>

                </tr>

                <tr>
                    <td><div class="input-group"><div class="input-group-addon">End X</div><input type="text" class="form-control" name="endX" value="0"></div></td>
                    <td><div class="input-group"><div class="input-group-addon">End Y</div><input type="text" class="form-control" name="endY" value="0"></div></td>
                    <td><div class="input-group"><div class="input-group-addon">End Z</div><input type="text" class="form-control" name="endZ" value="0"></div></td>
                </tr>

                <tr>
                    <td><td><div class="input-group"><div class="input-group-addon">Steps</div><input type="text" class="form-control" name="steps" value="1"></div></td></td>
                </tr>
            </tbody>
         </table>

        <br><h3>Misc</h3>
        <table cellpadding="0" cellspacing="0" border="0" class="table text-left">
            <tbody>

            <tr>
                <td><div class="input-group"><div class="input-group-addon">Stopping Time</div><input type="text" class="form-control" name="stoppingtime" value="1e-9"></div></td>
                <td></td>
            </tr>

            <tr>
                <td>
                    <label>OMF</label>
                    <select class="form-control" id="omf" name="omf">
                        <option value="1">OMF 1</option>
                    </select>
                </td>

                <td>
                    <label>PPM</label>
                    <select class="form-control" id="ppm" name="ppm" onchange="changePicture()">
                        <option value="1">PPM 1</option>
                        <option value="2">PPM 2</option>
                    </select>
                </td>

                <td>
                    <label>Simulation Node</label>
                    <select class="form-control" id="run" name="run">
                        <option value="1">Local</option>
                        <option value="0">No Simulaton</option>
                    </select>
                </td>
            </tr>
            </tbody>
        </table>

    <br>

    <hr>
    <?=$this->form->submit('Submit', array('class' => 'btn btn-primary btn-block')); ?>

    <?=$this->form->end(); ?>

<?php if ($success): ?>
    <p><span class="label label-success"> Generated Successfully </span></p>
<?php endif; ?>