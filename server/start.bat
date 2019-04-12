@echo off
for /f "tokens=4" %%a in ('route print^|findstr 0.0.0.0.*0.0.0.0') do (
 set IP=%%a
 echo %%a
 call :first
)
:first
cd ./public
@echo on
php -S %IP%:8089