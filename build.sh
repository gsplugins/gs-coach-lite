echo "$(tput setaf 6)" &&

echo 'Building production version...' &&

npm run production
echo -ne 'Production version created......              (30%)\r'

rm -rf build
mkdir -p build/gs-coach-coachs #multiple folder creation

echo -ne 'Cleanup and building files started........            (40%)\r'

rsync -r --exclude '.git' --exclude '.svn' --exclude 'build' --exclude 'node_modules' --exclude 'dev' --exclude '.vscode' . build/gs-coach-coachs/

echo -ne 'Files copied............        (60%)\r'

rm -rf build/gs-coach-coachs/mix-manifest.json &&
rm -rf build/gs-coach-coachs/package.json &&
rm -rf build/gs-coach-coachs/package-lock.json &&
rm -rf build/gs-coach-coachs/webpack.mix.js &&
rm -rf build/gs-coach-coachs/.babelrc &&
rm -rf build/gs-coach-coachs/.gitignore &&
find . -type f -name '*.DS_Store' -ls -delete &&
rm -rf build/gs-coach-coachs/.AppleDouble &&
rm -rf build/gs-coach-coachs/.LSOverride &&
rm -rf build/gs-coach-coachs/.Trashes &&
rm -rf build/gs-coach-coachs/.AppleDB &&
rm -rf build/gs-coach-coachs/.idea &&
rm -rf build/gs-coach-coachs/build.sh &&
rm -rf build/gs-coach-coachs/yarn.lock &&
rm -rf build/gs-coach-coachs/composer.json &&
rm -rf build/gs-coach-coachs/composer.lock &&
rm -rf build/gs-coach-coachs/task.txt &&

rm -rf build/gs-coach-coachs/includes/integrations/assets/divi/divi-builder.js &&
rm -rf build/gs-coach-coachs/includes/integrations/assets/divi/divi-frontend.js &&
rm -rf build/gs-coach-coachs/includes/integrations/assets/elementor/elementor-preview.js &&
rm -rf build/gs-coach-coachs/includes/integrations/assets/gutenberg/gutenberg-widget.js &&
rm -rf build/gs-coach-coachs/includes/gs-common-pages/assets/gs-plugins-common-pages.scss &&

find . -type f -name '*.LICENSE.txt' -ls -delete &&

echo -ne 'Creating gs-coach-coachs.zip file................    (80%)'

cd build
zip -r gs-coach-coachs.zip gs-coach-coachs/.
rm -r gs-coach-coachs

echo -ne 'Congratulations... Successfully done....................(100%)'

npm run development
echo -ne 'Development version restored....................(100%)\r'

echo "$(tput setaf 2)" &&
echo "Clean process completed!"
echo "$(tput sgr0)"