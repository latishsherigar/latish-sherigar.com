---
layout: post
title: "Arduino based automatic aquarium fish feeder"
date: 2017-12-24 22:10:37 +0530
categories: [tech]
tags: [tech]
---

I had setup a aquarium at home recently and realized the need to feed the fish twice a day. Since necessity is the mother of invention, I therefore decided to setup some kind of mechanism which will feed the fishes at regular intervals.

I looked at assembling something with 555 timers but found after some research on internet that they are not suitable for such long delays (twice a day). The next option was digital timer circuits and pre-assembled modules but looking at the cost factor arduino seemed a good option although using a micro controller for such a project seems to be a overkill but i think what matters is it fulfills the functional requirement with the lowest cost. I wont mind even using a RaspberryPi if its the cheapest 🙂

With an old vaseline box, few electric concealing pipes and a stepper motor I managed to setup something which did what i wanted it to do. Every 12 hours the arudino code is triggered and it signals a stepper motor to rotate 1 clockwise and 1 anticlockwise rotation. There was no particular reason for the clockwise and anticlockwise part , its just that i felt that it would be more fun that way.

The demo video shows a plate which acts as the manual override which can be used to test the system till we are confident that everything is working as expected.
