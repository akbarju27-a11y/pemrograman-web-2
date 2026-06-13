<?php

if (isset($_GET['test']))
{
    if ($_GET['test'] == 0)
    {
        echo "Test";
    }
}
else
{
    echo "Parameter test belum dikirim";
}

?>