<?php //echo "###<pre>";print_r($frmdata);die; ?>
<?php if (count($frmdata) > 0) { ?>
    <table class="table table-striped table-bordered table-hover">

          <tr>
                <th>S.No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Contact No</th>
                <th>Action</th>
            </tr>

        <?php
        foreach ($frmdata  as $key => $value) {
            ?>
            <tr>
                <td><?php echo $key+1; ?></td>
                <td><?php echo $value->name; ?></td>
                <td><?php echo isset($value->email) ? $value->email : 'N/A'; ?></td>
                <td><?php echo isset($value->contact_no) ? $value->contact_no : 'N/A'; ?></td>
                <td>
                        <a type="button" class="" value="view_details"  title="View Participant Goal" 
                           href="<?php echo site_url('delivery/participantGoal/' .$value->order_id.'/'.$value->delivery_id.'/'.$value->id); ?>">
                            <i class="fa fa-eye" aria-hidden="true"></i></a>

                    
                </td>
            </tr>
        <?php } //die;?>

    </table>
<?php
} else {
    echo "Order not found";
}
?>
