<?php
function repeat($text, $num = 10)
{
    echo "<ol>";

    for($i = 0; $i < $num; $i++)
    {
        echo "<li>$text</li>";
    }

    echo "</ol>";
}

repeat("I'm the best", 15);
repeat("You're the man");
?>