<?php
global $CFG;
global $PAGE;
/***
print "<script type=\"text/javascript\" src=\"".$CFG->wwwroot ."/question/type/kis_mws/jquery.sheet/jquery-1.8.3.min.js\"></script>
<script type=\"text/javascript\" src=\"".$CFG->wwwroot ."/question/type/kis_mws/jquery.sheet/jquery-ui/ui/jquery-ui.min.js\"></script>
<script type=\"text/javascript\" src=\"".$CFG->wwwroot ."/question/type/kis_mws/jquery.sheet/jquery.sheet.js\"></script>
<link rel=\"stylesheet\" type=\"text/css\" href=\"".$CFG->wwwroot ."/question/type/kis_mws/jquery.sheet/jquery-ui/theme/jquery-ui.min.css\" />
";
***/
$PAGE->requires->css('/question/type/kis_mws/jquery.sheet/jquery-ui/theme/jquery-ui.min.css',true);
$PAGE->requires->js('/question/type/kis_mws/jquery.sheet/jquery-1.8.3.min.js',true);
$PAGE->requires->js('/question/type/kis_mws/jquery.sheet/jquery-ui/ui/jquery-ui.min.js',true);
$PAGE->requires->js('/question/type/kis_mws/jquery.sheet/jquery.sheet.js',true);
