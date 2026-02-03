---
layout: post
title: "Help! My C Drive is missing in Linux.."
date: 2007-05-06 16:53:00 +0530
categories: [tech]
tags: [tech]
---

This is a common scenario….u have installed Linux. u r really excited about it and  immediately start checking out the software, games and other cool things already present in the package. After a certain amount of time (which is directly proportional  to the level of u r excitement) u realise that u r not able to find u r games , pictures, documents etc which was present on u r Windows system. You start looking for the panic button.

Relax! U r data is most probably safe , depending upon which options u chose  on the partition screen during install time.

For accessing other filesystems u need to “

mount

” that filesystem in Linux.

Windows uses 2 types of file systems FAT32 and NTFS . If ur Windows data is on a FAT32 partition u needn’t worry much as almost all of the popular  Linux distributions have FAT32 support enabled. If u Windows system uses NTFS as its file system then a little bit of extra work is needed.

Read the following info on

http://www.tuxfiles.org/linuxhelp/mounting.html

for some information regarding mounting.

For those with NTFS system ,head on to

http://www.linux-ntfs.org/

and download the required packages for u r system.

Follow the documentation and if everything goes well , u will be having access to u r documents,pictures etc  in Linux also.
