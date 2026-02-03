---
layout: post
title: "XMMS song names in Pidgin Status."
date: 2007-09-22 18:19:00 +0530
categories: [tech]
tags: [tech]
---

I was wondering on how to display my song title as the status for Pidgin much like provided by 3rd party tools for yahoo messenger or for Gtalk when i came across this piece of info.

xmms has a built in plugin called ‘Song Change’ which allows one to execute any command when a song changes or when the play list ends.

Pidgin also has a command line tool called ‘purple-remote’ where in one can send commands to Pidgin.

This is all the information you will need.Put the following command to the xmms plugin configuration box

purple-remote “setstatus?message=%s”

xmms would replace the %s with the song title.

Now start a song and Voila! the song title appears in Pidgin status.
