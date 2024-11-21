@echo off
setlocal

REM Get the IPv4 address
for /f "tokens=2 delims=:" %%a in ('ipconfig ^| findstr /i "IPv4"') do (
    for /f "tokens=1 delims= " %%b in ("%%a") do (
        set IP=%%b
    )
)

REM Remove any leading/trailing spaces
set IP=%IP: =%

REM Check if the IP address was set correctly
if not defined IP (
    echo Could not find the IPv4 address. Please check your network configuration.
    exit /b
)

echo Starting PHP server on %IP%:8000...

REM Start the PHP server in a new command window
start cmd /k "php artisan serve --host=%IP% --port=8000"

REM Set the URL of your localhost site
set URL=http://%IP%:8000/

REM Allow some time for the server to start
timeout /t 5 /nobreak > NUL

REM Check if the URL is already open in Chrome
start chrome --new-window --app="%URL%" || start chrome --start-fullscreen "%URL%"