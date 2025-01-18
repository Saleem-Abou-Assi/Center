@echo off
setlocal

REM Set the static IP address of the machine running the Laravel application
set IP=192.168.1.1  

REM Set the URL of your localhost site
set URL=http://%IP%:8000/

REM Open the URL in Chrome
start chrome --new-window --app="%URL%" || start chrome --start-fullscreen "%URL%"
