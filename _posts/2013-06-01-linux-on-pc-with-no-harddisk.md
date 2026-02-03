---
layout: post
title: "Linux on PC with no harddisk"
date: 2013-06-01 20:43:18 +0530
categories: [tech]
tags: [tech]
---

Yes, its possible to run a perfectly non live cd system without a hard disk. All you need to have is a substitute for the hard disk . A usb pen drive is a  good replacement. Anything greater than 4GB should work fine. The Fedora installation process detects the pen drive and offers to install the OS on it. There is no special configuration that needs to be done. All you need to do is change the order of boot devices in your BIOS so that it boots from the USB HDD. Your Linux Desktop should now run completely fine even without an hard disk.
