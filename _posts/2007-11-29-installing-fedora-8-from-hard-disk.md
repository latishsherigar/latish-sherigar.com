---
layout: post
title: "Installing Fedora 8 from hard disk"
date: 2007-11-29 03:20:00 +0530
categories: [tech]
tags: [tech]
---

As many might be aware it is possible to install Fedora and many other Linux distributions from media other than CD/DVD’s.

I installed Fedora 8 from my hard disk . My machine is quite old with just a CD writer in it ( am a poor guy after all) . I did have a Broadband connection using which i had downloaded the DVD iso of fedora 8. I had the option of creating and burning 5 CD’s but installation from hard disk had the advantage of speed over regular CD’s. Also my installation would be faster coz i don’t have to keep putting in cd’s during the installation. The only CD i had created was the boot CD which was used to start the Installtion process (although it was not necessary as i later came to know).

Here are the steps which need to be followed for installing Fedora DVD version from the hard disk.

Step1 : Download the DVD iso from the Fedora project website at http://fedoraproject.org/.

You can also copy it to your disk from your friends hard disk who already has the iso.

Step2: Check if a FAT32 partition is available on your hard disk which can accommodate the DVD iso.  ( i did try installing with other Linux file systems such as ext2, ext3 but was not successful. Still am not sure  whether i did try all combinations) . Save the iso file in the root of the partition and not inside any folder (still not sure why it never worked for me when i placed the iso in folders). I created a partition and formated it with the FAT32 filesystem.

In my case the partition name was /dev/sda9 . I mounted it and copied the DVD iso in the root of the partition.

Step3: Thats it! we are now ready for installation.

Step4: Once the installation starts it would ask for the media you want the installation to start. Select the media as had disk and then in the next screen put in the path eg. /dev/sda9. It would let you choose the iso file and from that point the magic begins.

The installation speed is also much higher compared to a regular CD/DVD installation .These steps are distribution dependent and can be applied for other distributions also.
