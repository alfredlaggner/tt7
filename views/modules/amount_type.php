<?php
if ($amount_type == 'P') echo 'Percent';
elseif ($amount_type == 'G') echo 'Fixed';
elseif ($amount_type == 'D') echo 'Fixed per day';
elseif ($amount_type == 'R') echo 'Reduced amount';
elseif ($amount_type == 'F') echo 'Fixed amount off';
else echo 'Noting defined';