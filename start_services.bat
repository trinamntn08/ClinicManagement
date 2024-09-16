@echo off

REM Start MySQL
cd /d "C:\xampp\mysql\bin"
start "" mysqld --defaults-file="C:\xampp\mysql\bin\my.ini" --standalone --console

REM Start Apache
cd /d "C:\xampp\apache\bin"
start "" httpd -k start

REM Wait a bit to ensure services start
timeout /t 3 /nobreak >nul

REM Launch phpdesktop.exe
cd /d "D:\dev\projects\PatientManagementApplication"
start "" phpdesktop-chrome.exe

