---
layout: post
title: "Building remote for my media center PC"
date: 2019-01-19 19:17:27 +0530
categories: [tech]
tags: [tech]
---

Around a year back I had

posted

on how I built my media center PC aka HTPC (Home Theater Personal Computer) . I had been operating that using my wireless keyboard and mouse which satisfied all my functional requirements. To work as a true media center though i felt it had to work with a standard television remote.

I had therefore thought of adding a Infrared receiver (IR) connected to my media center PC which would allow me to use a regular TV/ DVD remote control to operate it. I looked around for some ready made IR receivers but the only one i found decent enough was

Flirc

. The price was on higher side though which was around 20 USD in addition to availability only in US. This meant that I had to wait for someone coming back to India from US in addition to paying a good amount of money. I therefore decided to go ahead and build my own.

Requirement:

A micro controller based circuit which will accept commands from any existing remote control and pass these as keyboard commands.

Components required -:

Pro

Micro

5V 16M Mini Leonardo

Micro

-controller Development Board For Arduino

TSOP1738 Infrared receiver.

Details-:

The Pro micro Arduino board has a great feature that it can act as standard USB keyboard to your PC with the help of a library. This made the work a lot easier as I then only had to read the IR remote commands and then convert them into equivalent USB keys and send them to PC. For the PC , it appears like it is just a standard keyboard and therefore no special driver or any software is required to be installed on the PC. Every IR remote sends a different set of commands for every key and after some debugging, I had the list of commands which my DVD remote was using. After coding that into the arduino code and writing some new code to map it to PC keys, the thing was working as expected. I then used a old Nokia charger which I had lying around to place the arduino and the IR receiver. Below is the working video and some pics of the board and the final product.

[embedyt] https://www.youtube.com/watch?v=OQekaL9HOUY[/embedyt].
