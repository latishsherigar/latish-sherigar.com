---
layout: post
title: "Slow updates with DNF in Fedora"
date: 2019-01-14 21:17:41 +0530
categories: [tech]
tags: [tech]
---

The DNF utility in my Fedora 28 system had been running slow recently. For quite some i had ignored it assuming it to be a bandwidth issue at my end or at their end. Since this happened for quite some time, i had to look for some help and i did find it. Apparently there is a config “

fastestmirror=true

” which needs to be done in

/etc/dnf/dnf.conf

. Post this the system was back to its blazing fast mode 🙂 .
