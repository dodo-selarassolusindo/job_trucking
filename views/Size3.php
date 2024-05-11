<?php

namespace PHPMaker2024\prj_job_trucking;

// Page object
$Size3 = &$Page;
?>
<?php
$Page->showMessage();
?>
<?php
$q = 'select * from size';
$r = ExecuteRows($q);
?>

<table>
<?php foreach($r as $row) { ?>
    <tr>
        <td><?= $row['Ukuran'] ?></td>
    </tr>
<?php } ?>
</table>
<?= GetDebugMessage() ?>
