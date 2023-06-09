PATH="$PATH:/home/maaz/Desktop/Software/sketch-1.7.2/sketch-frontend/" &&
PATH="$PATH:/home/maaz/Desktop/Software/dafny/" &&
SKETCH_HOME="/home/maaz/Desktop/Software/sketch-1.7.2/sketch-frontend/runtime/" &&
/home/maaz/Desktop/Repos/Casper/bin/run.sh /home/maaz/Desktop/Web/casper/server/tempCode.java /home/maaz/Desktop/Web/casper/server/tempOutput.java &&
cp /home/maaz/Desktop/Web/casper/server/tempOutput.java /home/maaz/Desktop/Eclipse\ Workspace/SparkDemo/src/WordCount.java &&
cp /home/maaz/Desktop/Web/casper/server/tempCode.java /home/maaz/Desktop/Eclipse\ Workspace/SeqDemo/src/WordCount.java &&
chmod a+rwx /home/maaz/Desktop/Eclipse\ Workspace/SeqDemo/src/WordCount.java &&
chmod a+rwx /home/maaz/Desktop/Eclipse\ Workspace/SparkDemo/src/WordCount.java &&
cd /home/maaz/Desktop/Eclipse\ Workspace/SeqDemo &&
mvn package &&
cd /home/maaz/Desktop/Eclipse\ Workspace/SparkDemo &&
mvn package
