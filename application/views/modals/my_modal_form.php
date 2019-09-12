  <?php echo $this->load->view('modals/my_modal_form'); ?>

    <tr>
    <td>
      <a class="galName" href="#myModal" data-toggle="modal" >
        <?php echo $gal['name']; ?>
      </a>
    </td>
    <td>
      <?php echo $gal['clientName']; ?>
    </td>
</tr> 
<div class="modal fade hide modal-creator" id="myModal" style="display: none;" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>Edit Gallery</h3>
    </div>
    <div class="modal-body"><?php echo form_open('url'); ?>

    <div class="row">
        <div class="span5">
            <?php print_r($galleryName); ?>
            <div class="control-group">
                <?php
                    $galleryName = array(
                        'id'            => 'galleryName',
                        'name'          => 'galleryName',
                        'placeholder'   => 'Gallery Name',
                        'required'      => 'required',
                    );
                    echo form_label('Gallery Name:', 'galleryName');
                    echo form_input($galleryName);
                ?>
            </div><!-- /control-group -->
       </div><!--/span5-->
   </div><!--/row-->
</div><!-- /modal-body -->

<div class="modal-footer">
    <!-- <p class="span3 resize">The following images are sized incorrectly. Click to edit</p> -->
    <a href="javascript:;" class="btn" data-dismiss="modal">Close</a>
    <a href="javascript:;" class="btn btn-primary">Next</a>
</div> 