<?php
// Run this from command line: php backup-database.php

$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';  // Your MySQL password
$dbName = 'bungalow_booking';
$backupFile = 'database-backup-' . date('Y-m-d-H-i-s') . '.sql';

// Create backup directory
if (!file_exists('backups')) {
    mkdir('backups', 0777, true);
}

$command = sprintf(
    'mysqldump -h%s -u%s %s %s > backups/%s',
    $dbHost,
    $dbUser,
    $dbPass ? "-p{$dbPass}" : '',
    $dbName,
    $backupFile
);

exec($command, $output, $result);

if ($result === 0) {
    echo "✓ Database backed up successfully: backups/{$backupFile}\n";
} else {
    echo "✗ Backup failed!\n";
}