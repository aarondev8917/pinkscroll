
<?php
        if(is_array($nodes)){
            foreach($nodes as $value){
?>
    <div class="card">
        <div class="row no-gutters">
            <div class="col-auto">
                <img src="<?php echo $value['field_photo_image_section']; ?>" class="img-fluid" alt="">
            </div>
            <div class="col">
                <div class="card-block px-2">
                    <h4 class="card-title"><?php echo $value['title']; ?></h4>
                    <p class="card-text"> 12 Hours ago</p>
                </div>
            </div>
        </div>
    </div>
    <br>
<?php
            }
      }else{
?>
<div class="alert alert-danger" role="alert">
   There seems to be a problem! Please visit later
</div>
<?php
      }
?>

<div class="d-flex justify-content-center">
    <div class="spinner-border" role="status">
        <span class="sr-only">Loading...</span>
     </div>
</div>
