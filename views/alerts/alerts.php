<?php

foreach ($errors as $key => $error) :
?>
    <p class="alert alert-<?php echo $key ?>"><?php echo $error[0]; ?></p>
<?php
endforeach;
?>