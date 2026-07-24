@echo off

title Bot Telegram Reportes

echo =====================================
echo    BOT TELEGRAM REPORTES INICIANDO
echo =====================================

:inicio

echo.
echo Iniciando bot...
echo Fecha: %date% Hora: %time%

cd /d C:\xampp\htdocs\reportes_ordenes/reporteador


C:\xampp\php\php.exe bot_listener.php


echo.
echo El bot se detuvo.
echo Reiniciando en 5 segundos...


timeout /t 5 /nobreak > nul


goto inicio