<?php
require_once( 'header.inc.php' );
$osrelease = @file('/etc/os-release', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$info = [];

if ($osrelease) {
    foreach ($osrelease as $line) {
        if (strpos($line, '=') !== false) {
            list($key, $value) = explode('=', $line, 2);
            $info[$key] = trim($value, '"');
        }
    }

    if (isset($info['ID']) && isset($info['VERSION_ID'])) {
        echo strtolower($info['ID']) . $info['VERSION_ID'];
    } elseif (isset($info['PRETTY_NAME'])) {
        echo $info['PRETTY_NAME'];
    } else {
        echo "배포판 정보 확인 불가";
    }
} else {
    echo "/etc/os-release 파일 없음";
}
?>
