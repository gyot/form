@echo off
REM Periksa apakah parameter commit diberikan
if "%~1"=="" (
    echo Harap masukkan pesan commit sebagai parameter!
    echo Contoh: git_update.bat "Pesan commit Anda"
    pause
    exit /b
)

REM Menjalankan perintah Git
git pull origin main
git add .
git commit -m "%~1"
git push origin main

REM Selesai
echo Proses selesai.
pause
