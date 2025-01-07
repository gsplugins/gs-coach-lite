echo "$(tput setaf 6)" &&

echo 'Building production version...' &&

npm run production
echo -ne 'Production version created......              (30%)\r'

rm -rf build
mkdir -p build/gs-coach-members #multiple folder creation

echo -ne 'Cleanup and building files started........            (40%)\r'

rsync -r --exclude '.git' --exclude '.svn' --exclude 'build' --exclude 'node_modules' --exclude 'dev' --exclude '.vscode' . build/gs-coach-members/

echo -ne 'Files copied............        (60%)\r'

rm -rf build/gs-coach-members/mix-manifest.json &&
rm -rf build/gs-coach-members/package.json &&
rm -rf build/gs-coach-members/package-lock.json &&
rm -rf build/gs-coach-members/webpack.mix.js &&
rm -rf build/gs-coach-members/.babelrc &&
rm -rf build/gs-coach-members/.gitignore &&
find . -type f -name '*.DS_Store' -ls -delete &&
rm -rf build/gs-coach-members/.AppleDouble &&
rm -rf build/gs-coach-members/.LSOverride &&
rm -rf build/gs-coach-members/.Trashes &&
rm -rf build/gs-coach-members/.AppleDB &&
rm -rf build/gs-coach-members/.idea &&
rm -rf build/gs-coach-members/build.sh &&
rm -rf build/gs-coach-members/yarn.lock &&
rm -rf build/gs-coach-members/composer.json &&
rm -rf build/gs-coach-members/composer.lock &&
rm -rf build/gs-coach-members/task.txt &&

rm -rf build/gs-coach-members/includes/integrations/assets/divi/divi-builder.js &&
rm -rf build/gs-coach-members/includes/integrations/assets/divi/divi-frontend.js &&
rm -rf build/gs-coach-members/includes/integrations/assets/elementor/elementor-preview.js &&
rm -rf build/gs-coach-members/includes/integrations/assets/gutenberg/gutenberg-widget.js &&
rm -rf build/gs-coach-members/includes/gs-common-pages/assets/gs-plugins-common-pages.scss &&

find . -type f -name '*.LICENSE.txt' -ls -delete &&

echo -ne 'Creating gs-coach-members.zip file................    (80%)'

cd build
zip -r gs-coach-members.zip gs-coach-members/.
rm -r gs-coach-members

echo -ne 'Congratulations... Successfully done....................(100%)'

npm run development
echo -ne 'Development version restored....................(100%)\r'

echo "$(tput setaf 2)" &&
echo "Clean process completed!"
echo "$(tput sgr0)"