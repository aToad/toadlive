<?php

ob_start();

echo "123";

$a = ob_get_contents();

// ob_end_clean();

echo $a;

?>
