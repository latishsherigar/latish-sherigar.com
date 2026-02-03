---
layout: post
title: "Root MotoE 1st gen (Lollipop 5.1)"
date: 2016-04-23 19:02:09 +0530
categories: [tech]
tags: [tech]
---

I had a MotoE 1st gen with a insufficient internal storage issue. I have been the unofficial and unpaid brand ambassador of the new Motorola brand of phones for quite some time. The only issue with this phone is that it has limited internal storage and apps like WhatsApp and Facebook which like to eat internal storage in their lunch and dinner leave no space for anything else. This is when I decided to root this phone, luckily which was out of warranty.

I first rooted a MotoE 1st generation phone  in 2015. So this time i.e. in 2016 when I got a chance to root the other MotoE , i was expecting the whole process to complete in a hour or two. To my surprise, it was a tough job when I actually started to work on it. The technique which I was using earlier in 2015 did not seem to work in 2016. Internet still showed me

KingoRoot

app as the only one way to root the phone and it was not working. Some other ways like flashing a custom recovery like TWRP was not working as well.

When I was about to lose hope, an flash of thought struck me. The only difference between the 2 techniques was the OS of the phone. During my 2015 rooting, the phone had a Kitkat OS. This phone which I was trying to root had Lollipop as a part of system upgrade. I decide to downgrade the OS which was possible as some good people at

XDA had made available the Kitkat firmware of that phone

. I downloaded the firmware, set up the phone on Kitkat and then tried rooting the KingoRoot way. As I expected, it worked 🙂  . I installed TWRP and Link2Sd and excellent app which allows you to create move all apps on SD by creating shortcuts /Linux symbolic links pointing to a Linux partition which makes your app think that it is still using internal storage. Please note that this is not the same as APP2SD feature which works only on very limited apps and in my opinion is useless most of the time. The paid version of the app also allows you to move data folder like Whats’s app video, images folder to the SD card. I manually did that part by executing unix commands using adbshell , the details of which I will write in a separate post.

Special thanks to makers of

KingoRoot

who make rooting as easy as clicking a button. I wish the app had given a helpful error message saying the OS degrade part (assuming they know about it 🙂 ) but no worries as I finally achieved what I wanted to.
