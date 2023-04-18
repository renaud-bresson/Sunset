<?php
function prettyDump($data) {
    highlight_string("<?php\n\$data =\n" . var_export($data, true) . ";\n?>");
}
?>