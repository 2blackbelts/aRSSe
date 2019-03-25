#magnet:?xt=urn:btih:bc78ae1c8619f1f8ebd54e942f8c03d26493f8be&dn=Titans.2018.S01E06.WEB.SUBBED.LOWQUALITY.x264-CimaClub[TGx]&tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&tr=udp%3A%2F%2Ftracker.vanitycore.co%3A6969%2Fannounce&tr=udp%3A%2F%2Fbt.firebit.co.uk%3A6969%2Fannounce&tr=udp%3A%2F%2Ftracker.pirateparty.gr%3A6969%2Fannounce&tr=udp%3A%2F%2Ftracker.leechers-paradise.org%3A6969%2Fannounce&tr=udp%3A%2F%2Fopen.stealth.si%3A80%2Fannounce&tr=udp%3A%2F%2Finferno.demonoid.pw%3A3418%2Fannounce&tr=udp%3A%2F%2Fpublic.popcorn-tracker.org%3A6969%2Fannounce
import json

filename = 'tgx24hdump.txt'
lines = tuple(open(filename, 'r'))
multkeys = []

for line in lines:
	# print(line)
	hash,name,cat,link,cache = line.split("|")
	if cat == 'Movies' or cat == 'TV' or cat == 'Documentaries':
		# print(line)
		magnet = 'magnet:?xt=urn:btih:'+hash+"&dn="+name+"&tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&tr=udp%3A%2F%2Ftracker.vanitycore.co%3A6969%2Fannounce&tr=udp%3A%2F%2Fbt.firebit.co.uk%3A6969%2Fannounce&tr=udp%3A%2F%2Ftracker.pirateparty.gr%3A6969%2Fannounce&tr=udp%3A%2F%2Ftracker.leechers-paradise.org%3A6969%2Fannounce&tr=udp%3A%2F%2Fopen.stealth.si%3A80%2Fannounce&tr=udp%3A%2F%2Finferno.demonoid.pw%3A3418%2Fannounce&tr=udp%3A%2F%2Fpublic.popcorn-tracker.org%3A6969%2Fannounce"
		dict = {'type' : cat, 'name' : name, 'magnet' : magnet}
		multkeys.append(dict)
		# print('magnet:?xt=urn:btih:'+hash+"&dn="+name+"&tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&tr=udp%3A%2F%2Ftracker.vanitycore.co%3A6969%2Fannounce&tr=udp%3A%2F%2Fbt.firebit.co.uk%3A6969%2Fannounce&tr=udp%3A%2F%2Ftracker.pirateparty.gr%3A6969%2Fannounce&tr=udp%3A%2F%2Ftracker.leechers-paradise.org%3A6969%2Fannounce&tr=udp%3A%2F%2Fopen.stealth.si%3A80%2Fannounce&tr=udp%3A%2F%2Finferno.demonoid.pw%3A3418%2Fannounce&tr=udp%3A%2F%2Fpublic.popcorn-tracker.org%3A6969%2Fannounce")

print(json.dumps(multkeys))