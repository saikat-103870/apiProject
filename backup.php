<?php

// Step 1: Define the path where the backup will be saved
$backupDir = 'C:/xampp/htdocs/backups/'; // Replace with your desired backup directory

// Ensure the backup directory exists
if (!file_exists($backupDir) && !mkdir($backupDir, 0777, true)) {
    die('Failed to create backup directory');
}

$backupFile = $backupDir . 'all_databases_backup_' . date('Y-m-d_H-i-s') . '.sql';

// Step 2: Define MySQL credentials
$host = 'localhost';
$username = 'root'; // Replace with your MySQL username
$password = ''; // Replace with your MySQL password

// Step 3: Run the mysqldump command to back up all databases
$command = "C:/xampp/mysql/bin/mysqldump --host=$host --user=$username --password=$password --all-databases > \"$backupFile\" 2>&1";

// Execute the command and capture output
$output = null;
$returnVar = null;
exec($command, $output, $returnVar);

// Step 4: Check if the backup was successful
if ($returnVar === 0) {
    echo "Backup successful! File saved to: " . $backupFile;
} else {
    echo "Backup failed! Error details: " . implode("\n", $output);
}

?>
