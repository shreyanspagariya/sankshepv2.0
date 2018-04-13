import os

os.environ["GOOGLE_APPLICATION_CREDENTIALS"] = "key.json"

for filename in os.listdir("Audios_FLAC"):
	if os.path.isfile('Text/'+filename+'.txt') == False:
		f1=open('Text/'+filename+'.txt', 'w+')
		print 'gs://bamboo-foundation-6245/Audios_FLAC/'+filename
		from google.cloud import speech
		client = speech.SpeechClient()
		operation = client.long_running_recognize(
			audio=speech.types.RecognitionAudio(
				uri='gs://bamboo-foundation-6245/Audios_FLAC/'+filename,
				),
			config=speech.types.RecognitionConfig(
					language_code='en-US',
				),
			)
		op_result = operation.result()
		for result in op_result.results:
			for alternative in result.alternatives:
				f1.write(alternative.transcript)
		f1.close()