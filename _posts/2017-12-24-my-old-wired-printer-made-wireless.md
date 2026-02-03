---
layout: post
title: "My old wired printer made wireless"
date: 2017-12-24 23:04:28 +0530
categories: [tech]
tags: [tech]
---

I have a wired HP printer which is quite old but in working condition. It was from the pre -mobile era so it assumed that it would always be sitting next to a desktop machine. Times change and we now have WIFI, mobile and everyone expects everything to be wireless and from a mobile. Being the resident IT support guy i decide to do something about it. I actually worked on it twice.

The first version was few years back before the RaspberryPi came. It was setup using a ASUS router which had a USB port and tomato usb third party firmware similar to DD_WRT which magically adds features to your router which the manufacturer never intended to.I wont explain this much now as I think it wont benefit anyone  NOW (and i am too lazy to type 🙂  ).

The 2nd version which I setup few months back is when the 1st version hardware stopped working and when the RaspberryPi ZeroW was launched. So I decided to go for a Pi based network print server. Its a very powerful piece of hardware and is well worth the money for the form factor. It is a full fledged Linux machine with USB and WIFI ! .This is a ideal machine to be used in kiosk type hardware. I hope they make it lot cheaper so that it becomes a no-brainer choice for such projects.

Hardware:

Raspberry Pi ZeroW.

I had to buy a OTG cable  to connect my USB printer to the pi as the pi zerow comes in with microusb only to save space.

It is powered by the commonly available 5v mobile chargers.

Software:

Installed raspbian OS which is tailor made for Pi.

Setup pi to work in headless mode (no display) as it required a micro HDMI connector and i did not wanted to spend on one. This involves giving a static IP to the Pi and enabling SSH so that you can remotely log in from other machines through SSH and do whatver you want.

Installed CUPS the powerful print server software which converts the innocent pi to a Network enabled printer.

Linux

– I tested this setup on Fedora. Almost all linux OS’s have built in support of CUPS based printer and their configuration utilities will auto detect once you provide the IP of the pi.

Windows

– I currently dont have a windows machine but I am pretty sure this should also work on Windows out of the box.

Android

– There is a app available on android called LetsPrintDroid which easily setups CUPS enabled print server found on the network and allows you to print documents directly from the mobile without requiring any desktop/laptop. This is slowly becoming my preferred mode when all i want is a quick print without waiting for my desktop to be UP and running.

Whenever the printer is powered ON, the pi also boots up and within a minute connects to the WIFI and is ready to serve print requests from my home network.
