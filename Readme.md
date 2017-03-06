#About
aRSSe is an RSS feed of the latest torrents compiled into one simple web page. Simply select the ones you want and click download. 

##Setup

###Set permissions on all files and folders
```
cd aRSSe
sudo find . -type f -exec chmod 644 {} \;
sudo find . -type d -exec chmod 755 {} \;
sudo chmod 777 torrents
```

###Setup torrent directory
Point your Torrent client's listening directory to /aRSSe/torrents
