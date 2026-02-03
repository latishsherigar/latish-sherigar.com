---
layout: post
title: "Resolve Internal storage issue in Android"
date: 2015-08-11 20:54:37 +0530
categories: [tech]
tags: [tech]
---

Budget phones usually have less internal storage memory which results in “Storage space running out” error in Android Kitkat / lollipop or something similar in older phones. I had to face this issue many times as I prefer and also recommend budget phones 🙂 . I have resolved this issue using the steps explained down for the following phones -:

Moto e

Micromax A67

Lenovo A390

HTC Explorer A310 (pico)

Steps:

(Following these steps will void your warranty)

1. Install a recovery like TWRP or CWN whichever is available for your phone. Internet and

xda-developers

are your best friend. This allows you to do advanced stuff like backing up your entire ROM even if that feature was not provided by your device manufacturer.

2. Root the phone. This will give admin rights to your phone. This steps vary for every phone model. Again there is a wealth of information on xda and internet.

3. Take a backup of the entire ROM using the recovery software installed in Step 1. It is usually a one click process which saves the ROM as a file on your SD card.

4. Create an ext4 partition on your SD card. This partition is needed as there is Linux running in the internals of Android and latest version of Linux prefers ext4 file system. This can be done by a partitioning software like Gparted on your PC. I use it on my Linux machine.

5. Once rooted then install

Link2Sd

or something similar app on your android phone .This app will help you move or link (shortcut ) the applications which are present in phone storage to the new ext4 partition which was created in Step 4. Without rooting your phone, this is not possible as this step requires administrative rights. This app also allows you to remove bloatware which was installed by the device manufacturer. Almost all apps except the system apps can be moved/linked to the SD card. All apps need to be linked/moved manually. It is advised not to touch system apps.

5. Reboot the phone. Any new apps that are installed from this point will be automatically linked to the SD card.
