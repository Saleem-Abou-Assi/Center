@echo off  
setlocal  

REM Get the IPv4 address  
for /f "tokens=2 delims=: " %%a in ('ipconfig ^| findstr /i "IPv4"') do (  
    set IP=%%a  
)  

REM Check if the IP address was set correctly  
if not defined IP (  
    echo Could not find the IPv4 address. Please check your network configuration.  
    exit /b  
)  

echo Starting PHP server on %IP%:8000...  

REM Start the PHP server in a new command window  
start cmd /k "php artisan serve --host=%IP% --port=8000"  

REM Set the URL of your localhost site  
set URL=http://%IP%:8000/  REM Adjust '8000' to your actual port if necessary.  

REM Allow some time for the server to start  
timeout /t 5 /nobreak > NUL  

REM Open Chrome in fullscreen mode  
start chrome --start-fullscreen "%URL%"  