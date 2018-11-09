
<div id="page-inner">
<div class="row">
<?php echo form_open_multipart();?>
<div class="col-md-12 text-center jumbotron "> 
<div class="col-md-4"><b>Please Import your excel...</b></div>
    <div id="brw" class="col-md-4">
          <div>
             <input id="file_browse1" name="tmpdocuments" type="file">
          </div>
      </div>

          <div id="brw" class="col-md-4">
          <div>
             <input class="btn btn-primary" style=" float:right;" name='submit' value="Submit" type="submit">
          </div>
      </div>

    </div>
     <?php echo form_close();?>
    </div>
              

<div class="row">
<div class="col-md-4">
    <a href="<?php echo site_url().'assests/itf_public/sampleexcels/product_import_sample_sheet.xls' ?>">Download Sample Excel for import</a>
</div>

</div>


</div>