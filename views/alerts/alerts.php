<?php

foreach ($alerts as $key => $alert) :
?>
    <p class="alert alert-<?php echo $key ?>"><?php echo $alert[0]; ?></p>
<?php
endforeach;
?>