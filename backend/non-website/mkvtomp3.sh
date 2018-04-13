cd Videos_MKV
for f in *
do
	ffmpeg -i $f ../Audios_MP3/$f.mp3
done