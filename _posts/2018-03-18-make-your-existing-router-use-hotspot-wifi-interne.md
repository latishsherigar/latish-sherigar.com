---
layout: post
title: "Make your existing router use hotspot wifi internet"
date: 2018-03-18 22:51:20 +0530
categories: [tech]
tags: [tech]
---

UPDATE (5-SEP-2019) –

There is something called

WISP

(Wireless ISP) mode in almost all new routers in market now. This mode solves the exact problem which I was trying to solve back then. I upgraded to a TPLINK router which has this mode and it works beautifully. You can still go ahead and read the below post for academic purpose or just to know some ways I keep on wasting my time 🙂

——–ORIGINAL POST BELOW————–

I have a NETGEAR WNR612 router which is simple no frills device and does the job its made for. It connects to a modem with Ethernet output for Internet and connects its wired and wireless clients to Internet. Recently i decided to drop my wired broadband and go for JIOFI device which uses the Reliance Jio network and has really attractive prices.

Problem:

How to connect my existing router to use the internet from the Jio hotspot device

JioFI and other hotspot variants are technically 2 devices combined into 1 . There is a modem which takes your SIM and connects to the network for internet . There is another piece of hardware which takes this internet and creates a wifi network. The usual routers available in market assume that there will always be a wired internet available at an RJ45 Ethernet WAN port for which they have to create the wifi network. Technically if you are using a hotspot device there is no need for another router which also does the same job. Well in my case my router is responsible for creating my home LAN network and also has a much larger range than the hotspot device. I have a wireless printer which connects to my home network for print jobs. There are other devices which use the router WIFI for internet. The problem statement here was to somehow add the functionality in my router so that it can get the internet from the hotspot and beam it own Wifi network so that the other clients are not disturbed. They get the same internet as always and are unaware that anything has changed, which is how it should be.

A google search revealed several posts and videos which recommend to use

WDS ie Wireless Distribution System

. My router did not support this mode. Also WDS is a variant of repeater mode which means your hotspot would be responsible for creating and maintaining the LAN using DHCP.  Your older router would act as a subordinate which is what i did not want as the hotspot did not offer much customization.

Solution:

I put my R&D hat on. I had an old Linksys router lying around on which I had installed DDWRT the powerful firmware sometime back but was not using it.

DDWRT

is a beautiful and powerful piece of software which turbo chargers your routers with features which the manufactures never intended to built into the product. I had written about it in the past

here

. There are modes in which the router can be configured.

Access point is the mode in which we expect our routers to operate in which it converts wired to wifi. ‘Client’ mode is what would solve my problem. In this mode the devices acts as a client and connects to the hotspot wifi and provides the internet in to the router LAN ports. This LAN port of the intermediate router needs to be connected to the WAN port of the main router. This is all that is needed.

My main router now connects to the Linksys router with DDWRT which in turn connects to the wifi hotspot for internet. Another day , new learning!
