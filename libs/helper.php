<?php
function diePage($msg)
{
    echo "<div style='color: #ff1100; font-size: 25px; font-weigh: bold; margin: 120px auto;text-align:center; background-color: #ff3a6b66; border-radius: 25px; padding: 20px 10px; line-height: 60px; font-family: sans-serif; width: 90%;'>$msg</div>";
    die();
}

function dump($variable)
{
    echo "<pre>";
    print_r($variable);
    echo "</pre>";
    die();
}
