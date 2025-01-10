@echo off
setlocal

REM Define database file and backup path
set DB_FILE=C:\Users\AboHadi\Desktop\Center\Center\database\database.sqlite
set BACKUP_PATH=C:\Users\AboHadi\Desktop\Center\Backup\database_backup.sqlite

REM Backup the SQLite database
echo Backing up the SQLite database...
copy "%DB_FILE%" "%BACKUP_PATH%"
if %ERRORLEVEL% neq 0 (
    echo Failed to backup the database. Exiting...
    exit /b
)