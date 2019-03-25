#!/bin/sh
# grab torrent dump from torrent galaxy: 
# https://torrentgalaxy.org/cache/tgx24hdump.txt.gz

wget https://torrentgalaxy.org/cache/tgx24hdump.txt.gz
gunzip tgx24hdump.txt.gz -f
python3 tg.py > clean.json