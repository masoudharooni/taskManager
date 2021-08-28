<?php
function diePage($msg)
{
    echo "<div style='color: #ff1100; font-size: 25px; font-weigh: bold; margin: 120px auto;text-align:center; background-color: #ff3a6b66; border-radius: 25px; padding: 20px 10px; line-height: 60px; font-family: sans-serif; width: 90%;'>$msg</div>";
    die();
}

function massage($msg)
{
    echo "<div style='color: #fff;
    font-size: 25px; 
    font-weigh: bold; 
    margin: 0 auto;
    text-align:center;  
    font-family: sans-serif;
    position: absolute;
    top: 700px; 
    left:10%;
    z-index:9999;
    width: 80%;'> $msg </div>";
}

function dump($variable)
{
    echo "<pre>";
    print_r($variable);
    echo "</pre>";
    die();
}

function isRequestAjax(): bool
{
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) and strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        return true;
    }
    return false;
}

function inportantText(string $string = null)
{
    echo "<span style='color:red;font-size:22px;'>";
    echo $string;
    echo "</span>";
}

function siteUrl($uri = "")
{
    return  BASE_URL . $uri;
}
