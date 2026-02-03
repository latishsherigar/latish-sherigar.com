---
layout: post
title: "NodeMCU with buzzer"
date: 2021-05-07 22:20:10 +0530
categories: [tech]
tags: [tech]
---

If you are trying out the active buzzer module with Arduino and NodeMCU , a point to be remembered is the power consumption of the buzzer. Although the same code works for both the MCU’s , there is a difference in the runtime behavior.

In my case I noticed that I was not able to upload the code on NodeMCU as it appeared that the micro controller was kind of resetting or some internal trip switch was getting activated. I therefore removed the buzzer module and uploaded the code on NodeMCU and then reconnected the buzzer again. The GPIO pin which was connected to the buzzer module and which I had coded to be 5V started to go zero volts. These 2 points made be think that there surely was some power related issue and may be the buzzer was overloading the NodeMCU board. Just to add Arduino had worked fine with this connection and therefore i had gone ahead with the same design on NodeMCU. I therefore decided to drive the buzzer via a relay and as I had suspected the weird behavior went away. I was now able to upload the code on to NodeMCU when the buzzer was connected and also the buzzer module worked fine as expected in the code. I then did a search and found a post which confirmed by analysis. The design in the post does talk about the power consumption limit in NodeMCU and how it can be worked around.

https://techtutorialsx.com/2016/05/07/esp826-controlling-a-buzzer/
