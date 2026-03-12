@echo off
REM --- Navigate to your project folder ---
cd /d "C:\Users\USER\Documents\node practice final\validation-err-handlor"

REM --- Add all changes ---
git add .

REM --- Commit with a message ---
set /p msg="Enter commit message: "
git commit -m "updating"

REM --- Push to the feature branch ---
git push origin feature-branch

pause