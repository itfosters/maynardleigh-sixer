<?php //echo "###<pre>";print_r($frmdata);die; ?>
<?php if (count($frmdata) > 0) { ?>
    <table class="table table-striped table-bordered table-hover">

          <tr>
                <th>S.No</th>
                <th>Participant Goal</th>
                <th>Action</th>
            </tr>

        <?php
        foreach ($frmdata  as $key => $value) {
            ?>
            <tr>
                <td><?php echo $key+1; ?></td>
                <td><?php echo $value->goal; ?></td>
                <td>
                        <a type="button" class="" value="view_details"  title="Add To Do" 
                           href="<?php echo site_url('delivery/toDoList/' . $value->id); ?>">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i></a>

                    
                </td>
            </tr>
        <?php } //die;?>

    </table>
<?php
} else {
    echo "Goal not found";
}
?>
