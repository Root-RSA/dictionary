<?php if(isset($result) AND $result != false):
    include "components/positive_result.php";
    else: echo "<p class='nothing_found'>". _("Ничего не найдено по вашему запросу")."</p>";
    endif;
