@echo off
TITLE Teyvat - Protos
cd /d %~dp0

set PHP_BINARY=

where /q php.exe
if %ERRORLEVEL%==0 (
	set PHP_BINARY=php
)

if "%PHP_BINARY%"=="" (
	echo Couldn't find a PHP binary in system PATH or "%~dp0bin"
	pause
	exit 1
)
%PHP_BINARY% generateProtos.php %* || pause