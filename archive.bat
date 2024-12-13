git init
git config --local user.name "project"
git config --local user.email "project@ur.edu.pl"
git add --all
git commit -m "project languageCourses"
git archive --format=zip HEAD -o ../languageCourses_archive.zip
pause
