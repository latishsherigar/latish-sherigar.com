---
layout: post
title: "How i built my Media Center PC (HTPC)"
date: 2017-09-24 21:59:49 +0530
categories: [tech]
tags: [tech]
---

Below is my current desktop machine (YES i still use a desktop) configuration.  I use Fedora Linux with GNOME desktop.

Listed below are very short steps which would serve just as a pointer to setup a Linux based Media Center PC aka Home Theater PC as there is a lot of information available on the internet for each pointer.

Added RPM fusion repository in software source.

Installed gstreamer multimedia codecs as by default Fedora cant play various media formats due to license restrictions.

Installed pulseaudio volume control GUI app.

Since I have a

SPDIF

connection from my desktop to my Yamaha Audio Video receiver, I selected the SPDIF option in pulse audio volume control configuration.

Configured pulseaudio to play the surround sound formats.

Installed

KODI

, the excellent media center app.

Configured Kodi to enable SPDIF Passthrough.

Made Kodi aware that my AV receiver can understand Dolby Digital AC3 and DTS surround sound format.

Enabled Dolby digital transcoding so that Kodi does the hard work of converting the new surround formats such as EAC3 to the format which my AV receiver understands.This I feel is an excellent feature as this enables me to play newer formats without the need to upgrade my AV receiver.

Get a file with surround sound format to test your setup. I used a simple but excellent one available at

http://www.lynnemusic.com/surround.html

.

Play and Enjoy surround sound music!  🙂
