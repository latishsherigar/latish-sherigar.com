---
layout: post
title: "Your Enterprise apps and RAM"
date: 2015-02-19 20:49:37 +0530
categories: [tech]
tags: [tech]
---

Image a scenario – You have a shiny new application which works super smooth on the machines you tested. When deployed on a monster core sever with equally large RAM your application performs not so good as you had expected. There are chances that it could perform more badly than your test environments. For the users of the application it would be a frustrating experience as the application performance crawls to a halt.

One of the culprits in Java enterprise applications is the amount of RAM allocated to the application. Many times the same memory configuration which were present in your low powered test environments get moved to the client’s production boxes.

It is like being in a top class restaurant but not able to order anything as the menu is in a different language. What that means is – You are left hungry.

The same goes with your application. It is left hungry for RAM as it starts processing more data or more users are connected to your application. The OS is left with too much of RAM sitting idle as your application even though hungry is not asking for it.

Please therefore give enough attention to RAM.
