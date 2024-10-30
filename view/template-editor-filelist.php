<?php foreach($filelist as $file) : ?>
<?php if($file == $current_file) : ?>
<strong><?php echo $file ?></strong><br />
<?php else : ?>
<a href="#" 
   onclick="javascript:mediaembedder_change_file('<?php echo $file ?>')"
   ><?php echo $file ?></a><br />
<?php endif; ?>
<?php endforeach;
